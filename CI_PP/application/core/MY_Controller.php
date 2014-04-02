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

    protected function redirectToHomePage() {
        redirect('c_welcome/index', 'refresh');
    }
    
    protected function get_session_data(){
        $session_data = $this->session->all_userdata();
        if ( is_null($session_data) || empty($session_data)  )
            return NULL;
        else return $session_data;
    }
    
    protected function get_user_nick(){
        $session_data = $this->get_session_data();
        
        if( is_null($session_data) ){
            return NULL;
        }
        else {
            return $session_data['user_nick'];
        }
    }
    
    protected function get_user_id(){
        $session_data = $this->get_session_data();
        
        if( is_null($session_data['user_id']) || empty($session_data['user_id']) ){
            return NULL;
        }
        else {
            return $session_data['user_id'];
        }
    }    

    protected function authentify() {
        // this is from c_user login():
//        $new_session_data = array(
//            'user_id' => $loaded_user_info_result->u_id,
//            'user_nick' => $loaded_user_info_result->u_nick,
//            'user_email' => $loaded_user_info_result->u_email_address,
//            'user_is_admin' => ($loaded_user_info_result->u_is_admin == 1 ? TRUE : FALSE),
//            'logged_in' => TRUE,
//        );
        // if session then ok
        if ($this->session->userdata('user_nick') != NULL && $this->session->userdata('logged_in') == 1) {

            return TRUE;
        }
//
//        //If no session, redirect to login page
//        redirect('c_welcome/index', 'refresh');

        return FALSE;
    }

    protected function authentify_admin() {

        if (!$this->authentify()) {
            return FALSE;
        }

        // session ok, check if it's admin
        if ($this->session->userdata('user_is_admin') != NULL && $this->session->userdata('user_is_admin') == 1) {

            return TRUE;
        }

//        //If no session, redirect to login page
//        redirect('c_welcome/index', 'refresh');

        return FALSE;
    }

    protected function set_title(&$template_data, $title = "PowPorn") {
        $template_data['title'] = $title;
    }

    protected function load_header_templates(&$template_data) {
        $this->load_log_in_or_out_template($template_data);
        $this->load_admin_template($template_data);
    }

    private function load_log_in_or_out_template(&$template_data) {

        $user_id = $this->session->userdata('user_id');

        if (is_null($user_id) || !isset($user_id) || $user_id == NULL) {
            // login <li></li> loaded
            $template_data['login_or_logout_template'] = $this->parser->parse(constant('MY_Controller::' . 'LOGIN_TEMPLATE_PATH'), array(), TRUE);
        } else {
            // logout <li></li> loaded
            $template_data['login_or_logout_template'] = $this->parser->parse(constant('MY_Controller::' . 'LOGOUT_TEMPLATE_PATH'), array(), TRUE);
        }
    }

    private function load_admin_template(&$template_data) {

//        $user_id = $this->session->userdata('user_id');
//
//        if (!is_null($user_id) && isset($user_id) && $user_id != NULL) {
//
//            $thisUser = $this->user_model->get_user_by('u_id', $user_id);
//            if ($thisUser->u_is_admin == 1) {
//                // load elements to header for admin
//                $template_data['admin_template'] = $this->parser->parse(constant('MY_Controller::' . 'ADMIN_TEMPLATE_PATH'), array(), TRUE);
//            }
//        }

        if ($this->authentify_admin()) {
            // load elements to header for admin
            $template_data['admin_template'] = $this->parser->parse(constant('MY_Controller::' . 'ADMIN_TEMPLATE_PATH'), array(), TRUE);
        }
    }

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
