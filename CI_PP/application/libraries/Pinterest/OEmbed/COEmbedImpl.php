<?php

/**
 * Description of OEmbedImpl
 *
 * @author Pavol Daňo
 */
require_once('ICOEmbed.php');

require_once('ICOEmbedErrorKeyConstants.php');
require_once('ICOEmbedErrorValueConstants.php');

require_once('ICOEmbedVersionValueConstants.php');
require_once('ICOEmbedTypeValueConstants.php');

require_once('COEmbedBasicErrorResponseGeneratorImpl.php');

require_once('COEmbedRequiredKeys.php');
require_once('COEmbedOptionalKeys.php');

require_once('CNotObligatoryOEmbedKeyException.php');
require_once('CNotOptionalOEmbedKeyException.php');

class COEmbedImpl extends COEmbedBasicErrorResponseGeneratorImpl implements ICOEmbed, ICOEmbedErrorKeyConstants, ICOEmbedErrorValueConstants {

    
    const ACCEPTED_URL_SCHEME_KEY_VALUE = 'accepted_url_scheme';
    
    private $_acceptedUrlScheme = '';

    public function __construct($params) {
        parent::__construct();
        $this->_acceptedUrlScheme = $params[self::ACCEPTED_URL_SCHEME_KEY_VALUE];
    }

    /**
     * 
     * @param type $acceptedURLScheme
     */
    public function set_accepted_url_scheme($acceptedURLScheme) {
        $this->_acceptedUrlScheme = $acceptedURLScheme;
    }

    public function get_accepted_url_scheme() {
        return $this->_acceptedUrlScheme;
    }

    public function check_url_from_get($urlToBeChecked) {
        if (!isset($this->_acceptedUrlScheme)) {
            throw new CAcceptedUrlNotInitializedException("Accepted URL has been not defined yet! Usage before appropriate initialization.", -1, NULL);
        }

        if (substr($urlToBeChecked, 0, strlen($this->_acceptedUrlScheme)) === $this->_acceptedUrlScheme) {

            return TRUE;
        }

        // someone tries to reach not allowed URL
        return FALSE;
    }
    
    public function remove_expected_part($full_url) {
        if (!isset($this->_acceptedUrlScheme)) {
            throw new CAcceptedUrlNotInitializedException("Accepted URL has been not defined yet! Usage before appropriate initialization.", -1, NULL);
        }

        $url_without_prefix = str_replace($this->_acceptedUrlScheme, "", $full_url);

        return $url_without_prefix;
    }

    public function add_oembed_required_response_items($response_array, $key_value_items_array) {

        foreach ($key_value_items_array as $key => $value) {
            if ( !COEmbedRequiredKeys::isValidValue('COEmbedRequiredKeys',$key) ) {
                throw new CNotObligatoryOEmbedKeyException('Key "' . $key . '" does not belong to required keys.');
            }
            
            $response_array[$key] = $value;
        }

        return $response_array;
    }
    

    public function add_oembed_optional_response_items($response_array, $key_value_items_array) {

        foreach ($key_value_items_array as $key => $value) {
            if ( !COEmbedOptionalKeys::isValidValue( 'COEmbedOptionalKeys',$key) ) {
                throw new CNotOptionalOEmbedKeyException('Key "' . $key . '" does not belong to obligatory keys.');
            }
            
            $response_array[$key] = $value;
        }

        return $response_array;
    }    

    public function add_oembed_any_response_items($response_array, $key_value_items_array) {

        foreach ($key_value_items_array as $key => $value) {           
            $response_array[$key] = $value;
        }

        return $response_array;
    }    
}
?>
