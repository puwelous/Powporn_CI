<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    const LOGIN_TEMPLATE_PATH = 'templates/login';
    const LOGOUT_TEMPLATE_PATH = 'templates/logout';
    
    public function __construct() {
        parent::__construct();
    }

    public function set_title(&$template_data, $title = "PowPorn") {
        $template_data['title'] = $title;
    }

    public function load_log_in_or_out_template(&$template_data) {

        $user_id = $this->session->userdata('user_id');

        if (is_null($user_id) || !isset($user_id) || $user_id == NULL) {
            // login <li></li> loaded
            $template_data['login_or_logout_template'] = $this->parser->parse( constant('MY_Controller::'. 'LOGIN_TEMPLATE_PATH') , array(), TRUE);
        } else {
            // logout <li></li> loaded
            $template_data['login_or_logout_template'] = $this->parser->parse( constant('MY_Controller::'. 'LOGOUT_TEMPLATE_PATH'), array(), TRUE);
        }
    }

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
