<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class C_admin extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        //login or logout in menu
        $template_data = array();
        $this->set_title($template_data, 'Admin interface');
        $this->load_header_templates($template_data);

        $this->load->view('templates/header', $template_data);
        $this->load->view('v_admin');
        $this->load->view('templates/footer');
    }

    public function products() {

        //login or logout in menu
        $template_data = array();
        $this->set_title($template_data, 'Contact');
        $this->load_header_templates($template_data);

        $this->load->view('templates/header', $template_data);
        $this->load->view('v_admin');
        $this->load->view('templates/footer');
    }

    public function aboutus() {

        //login or logout in menu
        $template_data = array();
        $this->set_title($template_data, 'Contact');
        $this->load_header_templates($template_data);

        $this->load->view('templates/header', $template_data);
        $this->load->view('v_admin');
        $this->load->view('templates/footer');
    }

    public function rules() {

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