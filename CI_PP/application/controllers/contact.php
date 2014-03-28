<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function index() {

        $this->load->model('company_model');
        $result = $this->company_model->get_all();
        $data['company'] = $result[0];
        
        $this->load->view('contact', $data);
    }

}

/* End of file contact.php */
/* Location: ./application/controllers/contact.php */