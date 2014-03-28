<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class C_ucreate extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
        //login or logout in menu
        $template_data = array();
        $this->set_title( $template_data, 'u create');
        $this->load_log_in_or_out_template( $template_data );
        

        $this->load->view('templates/header', $template_data);
        $this->load->view('v_ucreate');
        $this->load->view('templates/footer');
    }
}

/* End of file c_ucreate.php */
/* Location: ./application/controllers/c_ucreate.php */