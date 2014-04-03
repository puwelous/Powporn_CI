<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class C_shopping_cart extends MY_Controller {

    public function index() {
        $template_data = array();

        $this->set_title($template_data, 'Shopping cart');
        $this->load_header_templates($template_data);

        $actual_user_id = $this->get_user_id();

        // check if user logged in
        if (is_null($actual_user_id) || $actual_user_id === NULL) {
            log_message('debug', 'Attempt to check shopping cart for unlogged user. Redirect!');
            redirect('/c_registration/index', 'refresh');
        }

        // get shopping cart from DB
        $shopping_cart_of_user = $this->cart_model->get_open_cart_by_owner_id($actual_user_id, TRUE);

        // redirect to 'shopping cart is empty' screen
        if (is_null($shopping_cart_of_user) || $shopping_cart_of_user === NULL || empty($shopping_cart_of_user)) {
            $this->set_title($template_data, 'Empty shopping cart');
            $this->load->view('templates/header', $template_data);
            $this->load->view('v_shopping_cart_empty');
            $this->load->view('templates/footer');
            return;
        }

        log_message('debug', 'Shopping cart: ' . print_r($shopping_cart_of_user, TRUE));

        $db_odered_products_full_info = $this->ordered_product_model->get_ordered_product_full_info_by_cart_id($shopping_cart_of_user->c_id);

        if (is_null($db_odered_products_full_info) || empty($db_odered_products_full_info)) {
            log_message('error', 'Shopping cart with ID: ' . $shopping_cart_of_user->c_id . ' was initialized but seems to be empty.');
            redirect('/c_finalproducts/index', 'refresh');
            return;
        }
        log_message('debug', print_r($db_odered_products_full_info, TRUE));
        
        $all_shipping_methods = $this->shipping_method_model->get_all();
        $all_payment_methods = $this->payment_method_model->get_all();

        //*** setting view data for rendering shopping cart screen
        // setting sum of cart
        $data['shopping_cart_sum'] = $shopping_cart_of_user->c_sum;
        // setting ordered product details
        $data['ordered_products'] = $db_odered_products_full_info;
        // set shipping methods
        $data['shipping_methods'] = $all_shipping_methods;
        // set payment methods
        $data['payment_methods'] = $all_payment_methods;
        // set II. section subtotal as subtotal from I.section + first shipping method 
        $data['second_section_subtotal'] = $shopping_cart_of_user->c_sum + $all_shipping_methods[0]->sm_price;
        // fetch this user data
        $data['user_data'] = $this->user_model->get( $actual_user_id );

        $this->load->view('templates/header', $template_data);
        $this->load->view('v_shopping_cart', $data);
        $this->load->view('templates/footer');
    }

}

/* End of file c_shopping_cart.php */
/* Location: ./application/controllers/c_shopping_cart.php */