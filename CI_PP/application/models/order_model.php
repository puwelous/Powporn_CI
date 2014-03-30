<?php

class Order_model extends MY_Model {

    public $_table = 'pp_order';
    public $primary_key = 'o_id';

    public $cart;
    public $shipping_method;
    public $payment_method;
    public $is_shipping_address_regist_address;
    public $status;
    public $final_sum;
    
    public $protected_attributes = array('o_id');

    /* basic constructor */
    public function __construct() {
        parent::__construct();
    }

    /* instance "constructor" */

    public function instantiate($cart, $shipping_method,$payment_method, $is_shipping_address_regist_address, $status, $final_sum) {

    $this->cart = $cart;
    $this->shipping_method = $shipping_method;
    $this->payment_method = $payment_method;
    $this->is_shipping_address_regist_address = $is_shipping_address_regist_address;
    $this->status = $status;
    $this->final_sum = $final_sum;
    }

    /*     * * database operations ** */
    
    public function insert_order(Order_model $order) {

        $this->order_model->insert(
                array(
                    'o_cart' => $order->cart,
                    'o_shipping_method' => $order->shipping_method,
                    'o_payment_method' => $order->payment_method,
                    'o_is_shipping_address_registration_addres' => $order->is_shipping_address_regist_address,
                    'o_status' => $order->status,
                    'o_final_sum' => $order->final_sum
        ));
    }

    /*     * ********* setters *********** */

    public function setCart($newCart) {
        $this->cart = $newCart;
    }

    public function setShippingMethod($newShippingMethod) {
        $this->shipping_method = $newShippingMethod;
    }

    public function setPaymentMethod($newPaymentMethod) {
        $this->payment_method = $newPaymentMethod;
    }

    public function setIsShippingAddressRegistrationAddress($newIsShippAddRegAddr) {
        $this->is_shipping_address_regist_address = $newIsShippAddRegAddr;
    }
    
    public function setStatus($newStatus) {
        $this->status = $newStatus;
    }
    
    public function setFinalSum($newFinalSum) {
        $this->final_sum = $newFinalSum;
    }    

    /*     * ********* getters *********** */

    public function getCart() {
        return $this->cart;
    }

    public function getShippingMethod() {
        return $this->shipping_method;
    }

    public function getPaymentMethod() {
        return $this->payment_method;
    }

    public function getIsShippingAddressRegistrationAddress() {
        return $this->is_shipping_address_regist_address;
    }
    
    public function getStatus() {
        return $this->status;
    } 
    
    public function getFinalSum() {
        return $this->final_sum;
    }      

}

/* End of file order_model.php */
/* Location: ./application/models/order_model.php */
