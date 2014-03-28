<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class C_welcome extends MY_Controller {

    public function index() {

        $template_data = array();
        
        $this->set_title( $template_data, 'Welcome');
        $this->load_log_in_or_out_template( $template_data );

        $this->load->view('templates/header', $template_data);
        $this->load->view('v_welcome');
        $this->load->view('templates/footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/c_welcome.php */