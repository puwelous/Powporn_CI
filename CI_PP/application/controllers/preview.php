<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Preview extends CI_Controller {

    
	public function __construct()
	{
		parent::__construct();
		
                //log_message('debug', phpinfo());
               //log_message('debug', $this->load->database() );
		//$this->load->model('company_model');
	}    
    
	public function index()
	{
                log_message('debug', 'test message');
                //$this->load->database();
//                $this->load->model('company_model');
//                
//                $result = $this->company_model->get_all();
//                
//                log_message('debug', print_r($result,TRUE));
                
                
                
                $this->load->model('company_model');
                $result = $this->company_model->get_all();
                
                log_message('debug', print_r($result,TRUE));
                
                
                
		$this->load->view('preview');
	}
}

/* End of file preview.php */
/* Location: ./application/controllers/preview.php */