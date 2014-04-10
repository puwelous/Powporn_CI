<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class C_order extends MY_Controller {

    /*
     * TODO: show order
     */
    public function index() {
        echo 'Showing order not supported yet ;) TODO!';
//        $template_data = array();
//
//        $this->set_title($template_data, 'Order');
//        $this->load_header_templates($template_data);
//
//        $actual_user_id = $this->get_user_id();
//
//        // check if user logged in
//        if (is_null($actual_user_id) || $actual_user_id === NULL) {
//            log_message('debug', 'Attempt to check shopping cart for unlogged user. Redirect!');
//            redirect('/c_registration/index', 'refresh');
//        }
//
//        // get shopping cart from DB
//        $shopping_cart_of_user = $this->cart_model->get_open_cart_by_owner_id($actual_user_id, TRUE);
//
//        // redirect to 'shopping cart is empty' screen
//        if (is_null($shopping_cart_of_user) || $shopping_cart_of_user === NULL || empty($shopping_cart_of_user)) {
//            $this->set_title($template_data, 'Empty shopping cart');
//            $this->load->view('templates/header', $template_data);
//            $this->load->view('v_shopping_cart_empty');
//            $this->load->view('templates/footer');
//            return;
//        }
//
//        log_message('debug', 'Shopping cart: ' . print_r($shopping_cart_of_user, TRUE));
//
//        $db_odered_products_full_info = $this->ordered_product_model->get_ordered_product_full_info_by_cart_id($shopping_cart_of_user->c_id);
//
//        if (is_null($db_odered_products_full_info) || empty($db_odered_products_full_info)) {
//            log_message('error', 'Shopping cart with ID: ' . $shopping_cart_of_user->c_id . ' was initialized but seems to be empty.');
//            redirect('/c_finalproducts/index', 'refresh');
//            return;
//        }
//        log_message('debug', print_r($db_odered_products_full_info, TRUE));
//
//        $all_shipping_methods = $this->shipping_method_model->get_all();
//        $all_payment_methods = $this->payment_method_model->get_all();
//
//        //*** setting view data for rendering shopping cart screen
//        // setting id of cart
//        $data['shopping_cart_id'] = $shopping_cart_of_user->c_id; //
//        // setting sum of cart
//        $data['shopping_cart_sum'] = $shopping_cart_of_user->c_sum;
//        // setting ordered product details
//        $data['ordered_products'] = $db_odered_products_full_info;
//        // set shipping methods
//        $data['shipping_methods'] = $all_shipping_methods;
//        // set payment methods
//        $data['payment_methods'] = $all_payment_methods;
//        // set II. section subtotal as subtotal from I.section + first shipping method 
//        $data['second_section_subtotal'] = $shopping_cart_of_user->c_sum + $all_shipping_methods[0]->sm_price;
//        // fetch this user data
//        $data['user_data'] = $this->user_model->get($actual_user_id);
//
//        $this->load->view('templates/header', $template_data);
//        $this->load->view('v_shopping_cart', $data);
//        $this->load->view('templates/footer');
    }

    public function create_order() {

        $actual_user_id = $this->get_user_id();

        // check if user logged in
        if ( is_null($actual_user_id) || $actual_user_id === NULL ) {
            log_message('debug', 'Attempt to check shopping cart for unlogged user. Redirect!');
            redirect('/c_registration/index', 'refresh');
            return;
        }
        
        $template_data = array();
        $this->set_title($template_data, 'Thank you!');
        $this->load_header_templates($template_data);        
        
        
        /*         * * start TRANSACTION ** */
        $this->db->trans_begin();
        {
            // create and store order_address if necessary
            $is_order_address_set = $this->session->userdata('is_order_address_set');
            log_message('debug', 'is_order_address_set = ' .  $is_order_address_set );
            
            if ( $is_order_address_set == true ){
                $new_order_address = new Order_address_model();
                
                // read from cookies
                $new_order_address->instantiate( 
                        $this->session->userdata('oa_name'), 
                        $this->session->userdata('oa_address'),
                        $this->session->userdata('oa_city'), 
                        $this->session->userdata('oa_zip'),
                        $this->session->userdata('oa_country'),
                        $this->session->userdata('oa_phone_number'),
                        $this->session->userdata('oa_email_address')
                        );
                
                $new_order_address_id = $new_order_address->insert_order_address();
                
                log_message('debug', 'new_order_address_id = ' .  $new_order_address_id );
            }else{
                $new_order_address_id = NULL;
            }
            // create order
            $newOrder = new Order_model();
            $newOrder->instantiate(
                    $this->input->post('cart_id'), 
                    $this->input->post('shipping_method_id'), 
                    $this->input->post('payment_method_id'),
                    ($is_order_address_set ? '1' : '0'), 
                    'OPEN', 
                    $this->input->post('total_sum'), 
                    $new_order_address_id);
            log_message('debug', 'New order: ' . print_r($newOrder, true));
            
            $new_order_id = $newOrder->insert_order();
            log_message('debug', '$new_order_id :' . print_r($new_order_id, TRUE));

            if (is_null($new_order_id) || $new_order_id == NULL || empty($new_order_id)) {
                log_message('debug', 'Creation of order failed!. Redirect!');
                log_message('debug', 'Rolling the transaction back!');
                $this->db->trans_rollback();
                redirect('/c_shopping_cart/index', 'refresh');
            }
            
            // edit cart info -> setting order for a cart
            $updated_cart_result = $this->cart_model->update(  $this->input->post('cart_id') , array('o_id' => $new_order_id, 'c_status' => 'closed' ) );

            if ($updated_cart_result < 0) {
                log_message('debug', 'Update of cart failed!. Redirect!');
                log_message('debug', 'Rolling the transaction back!');
                $this->db->trans_rollback();
                redirect('/c_shopping_cart/index', 'refresh');
            }           
        }

        if ($this->db->trans_status() === FALSE) {
            log_message('debug', 'Transaction status is FALSE! Rolling the transaction back!');
            $this->db->trans_rollback();
            redirect('/c_shopping_cart/index', 'refresh');
            return;
        } else {
            log_message('debug', '... commiting transaction ...!');
            $this->db->trans_commit();
        }
        
        $data['invoice_id'] = $new_order_id;
        $data['total'] = $this->input->post('total_sum');
        
        //$data for e-banking !
        
        $this->load->view('templates/header', $template_data);
        $this->load->view('v_payment', $data);
        $this->load->view('templates/footer');
 }

}

/* End of file c_shopping_cart.php */
/* Location: ./application/controllers/c_shopping_cart.php */