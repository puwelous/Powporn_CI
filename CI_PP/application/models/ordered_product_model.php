<?php

class Ordered_product_model extends MY_Model {

    public $_table = 'pp_ordered_product';
    public $primary_key = 'op_id';

    public $product_definition;
    public $amount;
    public $size_name;//refers to possible_size_for_product's name
    public $cart;
    public $orderer;//refers to user's u_id
    
    public $protected_attributes = array('op_id');

    
    /* basic constructor */
    public function __construct() {
        parent::__construct();
    }

    /* instance "constructor" */

    public function instantiate($product_definition, $amount,$size_name, $cart, $orderer) {

        $this->product_definition = $product_definition;
        $this->amount = $amount;
        $this->size_name = $size_name ;
        $this->cart = $cart;
        $this->orderer = $orderer;
    }

    /*     * * database operations ** */
    
    public function insert_ordered_product() {

        return $this->ordered_product_model->insert(
                array(
                    'pd_id' => $this->product_definition,
                    'op_amount' => $this->amount,
                    'psfp_name' => $this->size_name,
                    'c_id' => $this->cart,
                    'u_id' => $this->orderer
        ));
    }

    /*     * ********* setters *********** */

    public function setProductDefinition($newProductDefinition) {
        $this->product_definition = $newProductDefinition;
    }

    public function setAmount($newAmount) {
        $this->amount = $newAmount;
    }

    public function setSizeName($newSizeName) {
        $this->size_name = $newSizeName;
    }

    public function setCart($newCart) {
        $this->cart = $newCart;
    }
    
    public function setOrderer($newOrderer) {
        $this->orderer = $newOrderer;
    }

    /*     * ********* getters *********** */

    public function getProductDefinition() {
        return $this->product_definition ;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getSizeName() {
        return $this->size_name;
    }

    public function getCart() {
        return $this->cart;
    }
    
    public function getOrderer() {
        return $this->orderer;
    } 

}

/* End of file product_definition_model.php */
/* Location: ./application/models/product_definition_model.php */
