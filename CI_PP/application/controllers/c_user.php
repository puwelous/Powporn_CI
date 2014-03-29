<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class C_user extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

//    public function index() {
//        
//	$this->load->view('templates/header');
//	$this->load->view('registration');
//	$this->load->view('templates/footer');
//    }

    public function register() {

        // field name, error message, validation rules
        $this->form_validation->set_rules('tf_nick', 'User Name', 'trim|required|min_length[4]|max_length[32]|xss_clean|callback_nick_check');
        $this->form_validation->set_rules('tf_first_name', 'First name', 'trim|required|min_length[4]|max_length[32]|xss_clean');
        $this->form_validation->set_rules('tf_last_name', 'Last name', 'trim|required|min_length[4]|max_length[32]|xss_clean');
        $this->form_validation->set_rules('tf_email_address', 'Your Email', 'trim|required|valid_email|max_length[64]|callback_email_check');
        $this->form_validation->set_rules('tf_password_base', 'Password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('tf_password_confirm', 'Password Confirmation', 'trim|required|matches[tf_password_base]|max_length[32]');
        $this->form_validation->set_rules('tf_delivery_addres', 'Delivery address', 'trim|max_length[256]|xss_clean');
        $this->form_validation->set_rules('tf_address', 'Address', 'trim|required|max_length[256]|xss_clean');
        $this->form_validation->set_rules('tf_city', 'City', 'trim|required|max_length[64]|xss_clean');
        $this->form_validation->set_rules('tf_zip', 'ZIP', 'trim|required|max_length[16]|xss_clean');
        $this->form_validation->set_rules('tf_country', 'Country', 'trim|required|max_length[64]|xss_clean');

        if ($this->form_validation->run() == FALSE) {

            // print out validation errors
            $template_data = array();

            $this->set_title($template_data, 'Registration');
            $this->load_log_in_or_out_template($template_data);

            $this->load->view('templates/header', $template_data);
            $this->load->view('v_registration');
            $this->load->view('templates/footer');
        } else {

            $nick = $this->input->post('tf_nick');
            $firstname = $this->input->post('tf_first_name');
            $lastname = $this->input->post('tf_last_name');
            $emailAddress = $this->input->post('tf_email_address');
            $password = $this->input->post('tf_password_base');
            $gender = $this->input->post('tf_gender');
            $address = $this->input->post('tf_address');
            $deliveryAddress = $this->input->post('tf_delivery_addres');
            $city = $this->input->post('tf_city');
            $zip = $this->input->post('tf_zip');
            $country = $this->input->post('tf_country');
            $isAdmin = FALSE;

            $user_instance = new User_model();
            $user_instance->setAll($nick, $firstname, $lastname, $emailAddress, $password, $gender, $address, $deliveryAddress, $city, $zip, $country, $isAdmin);

            log_message('debug', 'Saving user into database as: \n' . print_r($user_instance, TRUE));

            $this->user_model->add_user($user_instance);

            log_message('debug', 'After user save. Setting user_data');

            $loaded_user_info_result = $this->user_model->get_by_email_or_nick_and_password($emailAddress, $password);

            $new_session_data = array(
                'user_id' => $loaded_user_info_result->u_id,
                'user_nick' => $loaded_user_info_result->u_nick,
                'user_email' => $loaded_user_info_result->u_email_address,
                'logged_in' => TRUE,
            );

            $this->session->set_userdata($new_session_data);

            redirect('/c_welcome/index', 'refresh');
        }
    }

    public function logout() {

        $new_session_data = array(
            'user_id' => '',
            'user_nick' => '',
            'user_email' => '',
            'logged_in' => FALSE,
        );

        $this->session->unset_userdata($new_session_data);
        $this->session->sess_destroy();

        redirect('/c_welcome/index', 'refresh');
    }

    function login() {
        if ($this->input->post('ajax') == '1') {

            log_message('debug', $this->input->post('login_nick_or_email') . ' is trying to log in.');

            //validation
            $this->form_validation->set_rules('login_nick_or_email', 'Nick or email', 'trim|required|xss_clean');
            $this->form_validation->set_rules('login_password', 'Password', 'trim|required|xss_clean');
            $this->form_validation->set_message('required', 'Please fill in the fields');

            if ($this->form_validation->run() == FALSE) {
                log_message('debug', 'validation unsuccessful');
                echo validation_errors();
            } else {
                log_message('debug', 'validation successful');

                $loaded_user_info_result = $this->user_model->get_by_email_or_nick_and_password(
                        $this->input->post('login_nick_or_email'), $this->input->post('login_password')
                );

                if ($loaded_user_info_result == NULL) {
                    echo '0';
                    return;
                };

                $new_session_data = array(
                    'user_id' => $loaded_user_info_result->u_id,
                    'user_nick' => $loaded_user_info_result->u_nick,
                    'user_email' => $loaded_user_info_result->u_email_address,
                    'logged_in' => TRUE,
                );

                $this->session->set_userdata($new_session_data);

                echo '1';
            }
        }
    }

    function is_user_present() {
        if ($this->input->post('ajax') == '2') {

            log_message('debug', 'Nick: ' . $this->input->post('login_nick') . ' checked for DB presence.');

            $user_presence_result = $this->user_model->is_present_by(
                    'u_nick', $this->input->post('login_nick')
            );

            log_message('debug', print_r($user_presence_result, TRUE));

            if ( is_null($user_presence_result) || empty($user_presence_result) ) {
                echo '0';
            } else {
                echo '1';
            }
        } else if ($this->input->post('ajax') == '3') {

            log_message('debug', 'Email: ' . $this->input->post('login_email') . ' checked for DB presence.');

            $user_presence_result = $this->user_model->is_present_by(
                    'u_email_address', $this->input->post('login_email')
            );

            log_message('debug', print_r($user_presence_result, TRUE));

            if ( is_null($user_presence_result) || empty($user_presence_result) ) {
                echo '0';
            } else {
                echo '1';
            }
        }
    }

    public function nick_check($nick) {

        $user_presence_result = $this->user_model->is_present_by(
                'u_nick', $nick
        );

        log_message('debug', 'nick_check:' . print_r($user_presence_result, TRUE));

        //  such a user not found
        if ( is_null($user_presence_result) || empty($user_presence_result)) {
            return TRUE;
        } else {
        // such a user found
            $this->form_validation->set_message('nick_check', 'User \"' . $nick . '\" already exists!');
            return FALSE;            
        }
    }

    public function email_check($email) {

        $user_presence_result = $this->user_model->is_present_by(
                'u_email_address', $email
        );

        log_message('debug', 'email_check:' . print_r($user_presence_result, TRUE));
        
        //  such a user not found
        if ( is_null($user_presence_result) || empty($user_presence_result) ) {
            return TRUE;
        } else {
            $this->form_validation->set_message('email_check', 'Email \"' . $email . '\" already exists!');
            return FALSE;
        }
    }

}

/* End of file c_user.php */
/* Location: ./application/controllers/c_user.php */