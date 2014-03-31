<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class C_admin extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        if( !$this->authentify_admin()){
            $this->redirectToHomePage();
            return;
        }        
        
        //login or logout in menu
        $template_data = array();
        $this->set_title($template_data, 'Admin interface');
        $this->load_header_templates($template_data);

        $this->load->view('templates/header', $template_data);
        $this->load->view('v_admin');
        $this->load->view('templates/footer');
    }

    public function products() {
        
        if( !$this->authentify_admin()){
            $this->redirectToHomePage();
            return;
        }              

        //login or logout in menu
        $template_data = array();
        $this->set_title($template_data, 'Contact');
        $this->load_header_templates($template_data);

        $this->load->view('templates/header', $template_data);
        $this->load->view('v_admin');
        $this->load->view('templates/footer');
    }

    public function about_us() {
        
        if( !$this->authentify_admin()){
            $this->redirectToHomePage();
            return;
        }      

        //login or logout in menu
        $template_data = array();
        $this->set_title($template_data, 'About us administration');
        $this->load_header_templates($template_data);

        $data['isFirstTimeRendered'] = TRUE;
        $data['company'] = $this->company_model->get_company();
        
        $this->load->view('templates/header', $template_data);
        $this->load->view('admin/v_admin_about_us', $data);
        $this->load->view('templates/footer');
        
        $data['isFirstTimeRendered'] = FALSE;
    }
    
    public function update_about_us(){

        // field name, error message, validation rules
        $this->form_validation->set_rules('cmpnf_provider_firstname', 'User Name', 'trim|required|min_length[1]|max_length[32]|xss_clean|callback_nick_check');
        $this->form_validation->set_rules('cmpnf_provider_lastname', 'First name', 'trim|required|min_length[1]|max_length[32]|xss_clean');
        $this->form_validation->set_rules('cmpnf_provider_street', 'Last name', 'trim|required|min_length[1]|max_length[32]|xss_clean');
        $this->form_validation->set_rules('cmpnf_provider_email', 'Email', 'trim|required|valid_email|min_length[1]|max_length[64]');
        $this->form_validation->set_rules('cmpnf_provider_street_number', 'Street number', 'trim|required|min_length[1]|max_length[8]');
        $this->form_validation->set_rules('cmpnf_provider_phone_number', 'Phone number', 'trim|required|min_length[10]|max_length[32]');
        $this->form_validation->set_rules('cmpnf_provider_city', 'City', 'trim|required|min_length[2]|max_length[64]|xss_clean');
        $this->form_validation->set_rules('cmpnf_provider_country', 'Country', 'trim|required|min_length[2]|max_length[64]|xss_clean');

        if ($this->form_validation->run() == FALSE) {

            // print out validation errors
            $template_data = array();

            $this->set_title($template_data, 'About us administration');
            $this->load_header_templates( $template_data );

            $this->load->view('templates/header', $template_data);
            $this->load->view('admin/v_admin_about_us');
            $this->load->view('templates/footer');
            return;
        } else {

            $p_first_name = $this->input->post('cmpnf_provider_firstname');
            $p_last_name = $this->input->post('cmpnf_provider_lastname');
            $p_street = $this->input->post('cmpnf_provider_street');
            $p_email = $this->input->post('cmpnf_provider_email');
            $p_street_number = $this->input->post('cmpnf_provider_street_number');
            $p_phone_number = $this->input->post('cmpnf_provider_phone_number');
            $p_city = $this->input->post('cmpnf_provider_city');
            $p_country = $this->input->post('cmpnf_provider_country');

            // no need to update rules, copy from previous version of company stored in DB now
            $currentCompany = $this->company_model->get_company_as_object();
            
            $company_instance = new Company_model();
            $company_instance->instantiate($p_first_name, $p_last_name, $p_street, $p_street_number, $p_city, $p_country, $p_email, $p_phone_number, $currentCompany->provider_rules);
            $company_instance->primary_key = $currentCompany->primary_key;
            
            log_message('debug', 'Updating company:' . print_r($currentCompany, TRUE));
            log_message('debug', 'To company:' . print_r($company_instance, TRUE));

            $currentCompany->update_company_by_company($company_instance);

            redirect('/c_admin/about_us', 'refresh');
        }
    }

    public function rules() {
        
        if( !$this->authentify_admin()){
            $this->redirectToHomePage();
            return;
        }      

        //login or logout in menu
        $template_data = array();
        $this->set_title($template_data, 'Rules administration');
        $this->load_header_templates($template_data);

        //loading company info
        $data['company_rules'] = $this->company_model->get_company()->cmpn_rules;

        $this->load->view('templates/header', $template_data);
        $this->load->view('admin/v_admin_rules', $data);
        $this->load->view('templates/footer');
    }

    public function update_rules() {
        if ($this->input->post('ajax') == '4') {

            log_message('debug', 'Attempt to change rules in the admin interface.');
            
            $new_rules = $this->input->post('new_rules');
            
            $company = $this->company_model->get_company();
            
            if( !isset($company) ){
                log_message('debug', 'Company not found in DB.');
                
                echo '-1';
                return;
            }
            
            if(  $company->cmpn_rules ==  $new_rules ){
                log_message('debug', 'Rules to be changed are the same as current rules. No need to change anything.');
   
                echo '0';
                return;
            }
            
            $this->company_model->update(
                    $company->cmpn_id, 
                    array( 'cmpn_rules' => $new_rules ));

            log_message('debug', 'Company rules successfully updated.');
            
            // send successful
            echo '1';
            return;
        }
    }
}

    /* End of file c_admin.php */
    /* Location: ./application/controllers/c_admin.php */