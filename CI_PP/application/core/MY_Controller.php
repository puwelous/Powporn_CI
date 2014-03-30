<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    const LOGIN_TEMPLATE_PATH = 'templates/login';
    const LOGOUT_TEMPLATE_PATH = 'templates/logout';
    const ADMIN_TEMPLATE_PATH = 'templates/admin';
    
    public function __construct() {
        parent::__construct();
    }

    public function set_title(&$template_data, $title = "PowPorn") {
        $template_data['title'] = $title;
    }

    public function load_header_templates( &$template_data ){
        $this->load_log_in_or_out_template( $template_data);
        $this->load_admin_template( $template_data);
    }
    
    private function load_log_in_or_out_template(&$template_data) {

        $user_id = $this->session->userdata('user_id');

        if (is_null($user_id) || !isset($user_id) || $user_id == NULL) {
            // login <li></li> loaded
            $template_data['login_or_logout_template'] = $this->parser->parse( constant('MY_Controller::'. 'LOGIN_TEMPLATE_PATH') , array(), TRUE);
        } else {
            // logout <li></li> loaded
            $template_data['login_or_logout_template'] = $this->parser->parse( constant('MY_Controller::'. 'LOGOUT_TEMPLATE_PATH'), array(), TRUE);
        }
    }
    
    private function load_admin_template(&$template_data) {

        $user_id = $this->session->userdata('user_id');

        if ( !is_null($user_id) && isset($user_id) && $user_id != NULL) {
            
            $thisUser = $this->user_model->get_user_by('u_id', $user_id);
            if( $thisUser->u_is_admin == 1 ){
                // load elements to header for admin
                $template_data['admin_template'] = $this->parser->parse( constant('MY_Controller::'. 'ADMIN_TEMPLATE_PATH'), array(), TRUE);
            }
        }
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
