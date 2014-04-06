<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//log_message('debug', APPPATH . 'libraries/Pinterest/COEmbedImpl.php');
//
//if (file_exists(APPPATH . 'libraries/Pinterest/OEmbed/COEmbedImpl.php')) {
//    log_message('debug', "The file filename exists");
//} else {
//    log_message('debug', "The file filename NOT exists");
//}
//require_once( APPPATH . '/libraries/Pinterest/OEmbed/COEmbedImpl.php');
//
// include helping library
require_once( APPPATH . '/libraries/Pinterest/CPinterestImpl.php');

class C_services extends MY_Controller {

    const ALLOWED_URL_SCHEMA = 'http://puwel.sk/products/';
    const URI_SEGMENT_TO_PRODUCTS_PREVIEW = '/preview/show/';
    const CACHE_AGE = 21600;
    const PP_PROVIDER_NAME = 'PowPorn';
    const PP_STORE_NAME = 'PowPornStore';
    const PP_CATEGORY = 'products';

    public function __construct() {
        parent::__construct();
    }

    // URL scheme - accepted url in our case is:http://www.puwel.sk/products/*
    // and API endpoint:http://www.puwel.sk/services/eombed/
    public function oembed() {

        // load OEmbed library
        $oembedParams = array(COEmbedImpl::ACCEPTED_URL_SCHEME_KEY_VALUE => self::ALLOWED_URL_SCHEMA);
        $this->load->library('Pinterest/CPinterestImpl', $oembedParams);

        $input_format = $this->input->get('format');
        if ( !isset($input_format) ){
            // set explicitly
            $content_type = 'application/json';
        }else if( $input_format == 'json' ){
            $content_type = 'application/json';
        }else{
            //TODO: XML not supported yet!
            //$content_type = 'application/json';
            $content_type = 'text/xml';
        }
        
        // setting content type
        $this->output->set_content_type($content_type);

        // parsing URL scheme from GET parameters
        $input_url = $this->input->get('url');

        log_message('debug', 'URL as parameter from input is:"' . $input_url . '"');

        try {
            // checking input
            if (!$this->cpinterestimpl->check_url_from_get($input_url)) {
                log_message('debug', 'URL from GET has been NOT accepted.');
                $response = $this->cpinterestimpl->generate_404_not_found(self::ALLOWED_URL_SCHEMA);
                $this->output->set_output(json_encode($response));
                return;
            }
        } catch (AcceptedUrlNotDefinedException $e) {        // Skipped
            log_message('error', 'AcceptedUrlNotDefinedException caught!');
            log_message('error', $e);
            $response = $this->cpinterestimpl->generate_500_server_issues(self::ALLOWED_URL_SCHEMA);
            $this->output->set_output(json_encode($response));
            return;
        }


        try {
            $url_without_expected_part = $this->cpinterestimpl->remove_expected_part($input_url);
        } catch (AcceptedUrlNotDefinedException $ee) {        // Skipped
            log_message('error', 'AcceptedUrlNotDefinedException caught!');
            log_message('error', $ee);
            $response = $this->cpinterestimpl->generate_500_server_issues(self::ALLOWED_URL_SCHEMA);
            $this->output->set_output(json_encode($response));
            return;
        }

        log_message('debug', 'Trimmed url:' . print_r($url_without_expected_part, TRUE));

        $slash_position = strpos($url_without_expected_part, "/");


        if ($slash_position === false) {
            log_message('debug', 'No slash at the rest of the trimmed URL. Expected ID');
        } else {
            log_message('debug', 'Slash found at position:' . $slash_position);

            $url_without_expected_part = substr($url_without_expected_part, 0, $slash_position);
            log_message('debug', 'Parsed part before slash:' . $url_without_expected_part);
        }

        if (!is_numeric($url_without_expected_part)) {
            log_message('debug', 'Expected numeric product ID but not-numeric value found!');
            $response = $this->cpinterestimpl->generate_404_not_found(self::ALLOWED_URL_SCHEMA);
            $this->output->set_output(json_encode($response));
            return;
        }

        $product_id = $url_without_expected_part;

        log_message('info', 'Loading data for product with ID:' . $product_id);

        // fetching the data
        $product_def_inst = $this->product_definition_model->get($product_id);

        if (!isset($product_def_inst) || empty($product_def_inst)) {
            $response = $this->cpinterestimpl->generate_404_not_found(self::ALLOWED_URL_SCHEMA);
            $this->output->set_output(json_encode($response));
            return;
        }

        // setting up data through the helper
        try {
            $json_data = $this->_prepare_data($product_def_inst);
        } catch (CNotObligatoryOEmbedKeyException $noeke) {
            log_message('error', 'Data preparation failed:' . $noeke);
            $response = $this->cpinterestimpl->generate_500_server_issues(self::ALLOWED_URL_SCHEMA);
            $this->output->set_output(json_encode($response));
            return;
        } catch(CInvalidRequiredPinKeyException $irpke){
            log_message('error', 'Data preparation failed:' . $irpke);
            $response = $this->cpinterestimpl->generate_500_server_issues(self::ALLOWED_URL_SCHEMA);
            $this->output->set_output(json_encode($response));
            return;
        } catch(OEmbedException $oee ){
            log_message('error', 'General wrapper exception caught:' . $oee);
            $response = $this->cpinterestimpl->generate_500_server_issues(self::ALLOWED_URL_SCHEMA);
            $this->output->set_output(json_encode($response));
            return;            
        }

        // preparing the data to be encoded
        $encoded_response = json_encode($json_data);

        // sending the response
        $this->output->set_output($encoded_response);
    }

    private function _prepare_data($product_definition) {

        $rsp = array();
        
        // adding obligatory (required) keys and values
        try {
            $rsp = $this->cpinterestimpl->add_oembed_required_response_items(
                    $rsp, array(
                ICOEmbedRequiredResponseConstants::OERC_TYPE => ICOEmbedTypeValueConstants::COETVC_LINK, // required
                ICOEmbedRequiredResponseConstants::OERC_VERSION => ICOEmbedVersionValueConstants::COEVVC_FIRST // required
                    ));
        } catch (CNotObligatoryOEmbedKeyException $noeke) {
            // throw because we cannot follow the API rules
            throw $noeke;
        }

        // adding optional (defined as optional in OEmbed specification) keys and values        
        try {
            $rsp = $this->cpinterestimpl->add_oembed_optional_response_items(
                    $rsp, array(
                ICOEmbedOptionalResponseConstants::OERC_PROVIDER_NAME => self::PP_PROVIDER_NAME, // optional
                ICOEmbedOptionalResponseConstants::OERC_PROVIDER_URL => site_url(), // optional
                ICOEmbedOptionalResponseConstants::OERC_CACHE_AGE => self::CACHE_AGE, // optional
                ICOEmbedOptionalResponseConstants::OERC_TITLE => "In The Powporn Store: " . $product_definition->pd_product_name, // optional
                ICOEmbedOptionalResponseConstants::OERC_AUTHOR_NAME => self::PP_STORE_NAME, // optional 
                ICOEmbedOptionalResponseConstants::OERC_AUTHOR_URL => site_url("welcome"), // optional
                ICOEmbedOptionalResponseConstants::OERC_THUMBNAIL_URL => base_url($product_definition->pd_photo_url), // optional
                ICOEmbedOptionalResponseConstants::OERC_THUMBNAIL_WIDTH => 195, // optional
                ICOEmbedOptionalResponseConstants::OERC_THUMBNAIL_HEIGHT => "*" // optional
                    ));
        } catch (CNotOptionalOEmbedKeyException $noeke) {
            // do NOT throw because we can follow the API rules
            log_message('error', 'Exception caught setting optional keys and values for OEmbed:' . $noeke);
        }

        // adding pinterest required keys and values
        try {
            $rsp = $this->cpinterestimpl->add_pinterest_required_response_items(
                    $rsp, array(
                ICPinRequiredResponseConstants::PRC_URL => site_url(self::URI_SEGMENT_TO_PRODUCTS_PREVIEW . $product_definition->pd_id),
                ICPinRequiredResponseConstants::PRC_TITLE => "In The Powporn Store: " . $product_definition->pd_product_name, // optional                    
                ICPinRequiredResponseConstants::PRC_PRICE => $product_definition->pd_price,
                ICPinRequiredResponseConstants::PRC_CURRENCY_CODE => "EUR"
                    ));
        } catch (CInvalidRequiredPinKeyException $irpke) {
            log_message('error', 'Exception caught setting optional keys and values for OEmbed:' . $noeke);
            // throw because we cannot follow the API rules
            throw $irpke;
        }

        if ($product_definition->pd_sex == 'female') {
            $product_for_gender = ICPinGenderValueConstants::PGVC_FEMALE;
        } else if ($product_definition->pd_sex == 'male') {
            $product_for_gender = ICPinGenderValueConstants::PGVC_MALE;
        } else {
            $product_for_gender = ICPinGenderValueConstants::PGVC_UNISEX;
        }


        // adding own keys and values  
        try{
        $this->cpinterestimpl->add_pinterest_optional_response_items(
                $rsp, array(
            ICPinOptionalResponseConstants::POC_DESCRIPTION => $product_definition->pd_type,
            ICPinOptionalResponseConstants::POC_PRODUCT_ID => $product_definition->pd_id,
            ICPinOptionalResponseConstants::POC_AVAILABILITY => ICPinAvailabilityValueConstants::PAVC_PREORDER,
            ICPinOptionalResponseConstants::POC_STANDARD_PRICE => $product_definition->pd_price,
            ICPinOptionalResponseConstants::POC_GENDER => $product_for_gender,
            ICPinOptionalResponseConstants::POC_IMAGES => base_url($product_definition->pd_photo_url)
                )
        );
        } catch (CInvalidOptionalPinKeyException $noeke) {
            // do NOT throw because we can follow the API rules            
            log_message('error', 'Exception caught setting optional keys and values for OEmbed:' . $noeke);
        }
        
        // 
        $rsp = $this->cpinterestimpl->add_pinterest_any_response_items(
                $rsp, array(
            //"quantity" => 1,
            "category" => self::PP_CATEGORY
                //"tags" => array("powporn", "hoodie"),
                //"materials" => "cotton"
                ));

        return $rsp;
    }

}

/* End of file c_services.php */
/* Location: ./application/controllers/c_services.php */