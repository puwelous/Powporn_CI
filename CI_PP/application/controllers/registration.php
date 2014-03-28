<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Registration extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('parser');
        $this->load->library('session');
    }

    public function index() {
        
        
        $data['title'] = 'Registration';
        
        $user_id = $this->session->userdata('user_id');
        
        if( is_null($user_id) || !isset($user_id) || $user_id == NULL){
            // login <li></li> loaded
            $data['login_or_logout_template'] = $this->parser->parse('templates/login', array(), TRUE);
        }else{
            // logout <li></li> loaded
            $data['login_or_logout_template'] = $this->parser->parse('templates/logout', array(), TRUE);
        }
        
	$this->load->view('templates/header', $data);
	$this->load->view('registration');
	$this->load->view('templates/footer');
    }

//    public function register() {
//
//        // field name, error message, validation rules
//        $this->form_validation->set_rules('tf_nick', 'User Name', 'trim|required|min_length[4]|max_length[32]|xss_clean');
//        $this->form_validation->set_rules('tf_first_name', 'First name', 'trim|required|min_length[4]|max_length[32]|xss_clean');
//        $this->form_validation->set_rules('tf_last_name', 'Last name', 'trim|required|min_length[4]|max_length[32]|xss_clean');
//        $this->form_validation->set_rules('tf_email_address', 'Your Email', 'trim|required|valid_email|max_length[64]|');
//        $this->form_validation->set_rules('tf_password_base', 'Password', 'trim|required|min_length[4]|max_length[32]');
//        $this->form_validation->set_rules('tf_password_confirm', 'Password Confirmation', 'trim|required|matches[tf_password_base]|max_length[32]');
//        $this->form_validation->set_rules('tf_delivery_addres', 'Delivery address', 'trim|max_length[256]|xss_clean');
//        $this->form_validation->set_rules('tf_address', 'Address', 'trim|required|max_length[256]|xss_clean');
//        $this->form_validation->set_rules('tf_city', 'City', 'trim|required|max_length[64]|xss_clean');
//        $this->form_validation->set_rules('tf_zip', 'ZIP', 'trim|required|max_length[16]|xss_clean');
//        $this->form_validation->set_rules('tf_country', 'Country', 'trim|required|max_length[64]|xss_clean');
//
//        if ($this->form_validation->run() == FALSE) {
//            $this->index();
//        } else {
//
//            $nick = $this->input->post('tf_nick');
//            $firstname = $this->input->post('tf_first_name');
//            $lastname = $this->input->post('tf_last_name');
//            $emailAddress = $this->input->post('tf_email_address');
//            $password = $this->input->post('tf_password_base');
//            $gender = $this->input->post('tf_gender');
//            $address = $this->input->post('tf_address');
//            $deliveryAddress = $this->input->post('tf_delivery_addres');
//            $city = $this->input->post('tf_city');
//            $zip = $this->input->post('tf_zip');
//            $country = $this->input->post('tf_country');
//            $isAdmin = FALSE;
//
//
//            $user_instance = new User_model();
//            $user_instance->setAll($nick, $firstname, $lastname, $emailAddress, $password, $gender, $address, $deliveryAddress, $city, $zip, $country, $isAdmin);
//
//            log_message('debug', print_r($user_instance, TRUE));
//
//            $this->user_model->add_user($user_instance);
//
//            log_message('debug', 'probably ok !');
//
//            $this->index();
//        }
//    }
//
//    public function logout() {
//
//        $new_session_data = array(
//            'user_id' => '',
//            'user_nick' => '',
//            'user_email' => '',
//            'logged_in' => FALSE,
//        );
//
//        $this->session->unset_userdata($new_session_data);
//        $this->session->sess_destroy();
//
//        $this->index();
//    }
//
//    public function login() {
//
////        $login_result = NULL;
////
////        $login_nick_or_email = '';
////        $login_password = '';
////
////        $login_result = $this->user_model->get_by_email_or_nick_and_password($login_nick_or_email, $login_password);
////
////        $this->session->set_userdata($newdata);
//    }
//
//    function ajax_check() {
//        if ($this->input->post('ajax') == '1') {
//
//            log_message('debug', 'is trying to log in.');
//
//            //validation
//            $this->form_validation->set_rules('login_nick_or_email', 'Nick or email', 'trim|required|xss_clean');
//            $this->form_validation->set_rules('login_password', 'Password', 'trim|required|xss_clean');
//            $this->form_validation->set_message('required', 'Please fill in the fields');
//
//            if ($this->form_validation->run() == FALSE) {
//                log_message('debug', 'validation unsuccessful');
//                echo validation_errors();
//            } else {
//                log_message('debug', 'validation successful');
//
//                $loaded_user_info_result = $this->user_model->get_by_email_or_nick_and_password(
//                        $this->input->post('login_nick_or_email'), $this->input->post('login_password')
//                );
//
//                if ($loaded_user_info_result == NULL) {
//                    echo '0';
//                    return;
//                };
//
//                $new_session_data = array(
//                    'user_id' => $loaded_user_info_result->u_id,
//                    'user_nick' => $loaded_user_info_result->u_nick,
//                    'user_email' => $loaded_user_info_result->u_email_address,
//                    'logged_in' => TRUE,
//                );
//
//                $this->session->set_userdata($new_session_data);
//
//                //echo 'login successful';
//                echo '1';
//            }
//        }
//    }

}

/* End of file registration.php */
/* Location: ./application/controllers/registration.php */