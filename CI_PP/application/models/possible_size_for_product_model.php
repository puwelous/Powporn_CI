<?php

class Possible_size_for_product_model extends MY_Model {

    public $_table = 'pp_possible_size_for_product';
    public $primary_key = 'psfp_id';

    public $product_definition;//refers to product_definition model by id or not????
    public $name;
    public $amount;
    
    public $protected_attributes = array('psfp_id');
    
    /* basic constructor */
    public function __construct() {
        parent::__construct();
    }

    /* instance "constructor" */

    public function instantiate(Product_definition_model $product_definition, $name, $amount) {

        $this->product_definition   = $product_definition;
        $this->name                 = $name;
        $this->amount               = $amount;
    }

    /*     * * database operations ** */
    
    public function insert_possible_size_for_product(Possible_size_for_product_model $possible_size_for_product_instance) {

        $this->possible_size_for_product_model->insert(
                array(
                    'pd_id'         => $possible_size_for_product_instance->product_definition,
                    'psfp_name'     => $possible_size_for_product_instance->name,
                    'psfp_amount'   => $possible_size_for_product_instance->amount
        ));
    }

    /*     * ********* setters *********** */
    public function setProductDefinition($newProductDefinition) {
        $this->product_definition = $newProductDefinition;
    }
    
    public function setName($newName) {
        $this->name = $newName;
    }
    
    public function setAmount($newAmount) {
        $this->amount = $newAmount;
    }    

    /*     * ********* getters *********** */

    public function getProductDefinition() {
        return $this->product_definition;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getAmount() {
        return $this->amount;
    }     
}

/* End of file possible_size_for_product_model.php */
/* Location: ./application/models/possible_size_for_product_model.php */
