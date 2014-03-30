<?php

class Product_definition_model extends MY_Model {

    public $_table = 'pp_product_definition';
    public $primary_key = 'pd_id';

    public $product_name;
    public $photo_url;
    public $product_creator;
    public $type;
    public $price;
    public $sex;
    
    public $protected_attributes = array('pd_id');

    
    /* basic constructor */
    public function __construct() {
        parent::__construct();
    }

    /* instance "constructor" */

    public function instantiate($product_name, $photo_url, $product_creator, $type, $price, $sex) {

        $this->product_name = $product_name;
        $this->photo_url = $photo_url;
        $this->product_creator = $product_creator;
        $this->type = $type;
        $this->price = $price;
        $this->sex = $sex;
    }

    /*     * * database operations ** */
    
    public function insert_product_definition(Product_definition_model $product_definition_instance) {

        $this->product_definition_model->insert(
                array(
                    'pd_product_name' => $product_definition_instance->product_name,
                    'pd_photo_url' => $product_definition_instance->photo_url,
                    'pd_product_creator' => $product_definition_instance->product_creator,
                    'pd_type' => $product_definition_instance->type,
                    'pd_price' => $product_definition_instance->price,
                    'pd_sex' => $product_definition_instance->sex
        ));
    }

    /*     * ********* setters *********** */

    public function setProductName($newProductName) {
        $this->product_name = $newProductName;
    }

    public function setPhotoUrl($newPhotoUrl) {
        $this->photo_url = $newPhotoUrl;
    }

    public function setProductCreator($newProductCreator) {
        $this->product_creator = $newProductCreator;
    }

    public function setType($newType) {
        $this->type = $newType;
    }
    
    public function setPrice($newPrice) {
        $this->price = $newPrice;
    }
    
    public function setSex($newSex){
        $this->sex = $newSex;
    }

    /*     * ********* getters *********** */

    public function getProductName() {
        return $this->product_name;
    }

    public function getPhotoUrl() {
        return $this->photo_url;
    }

    public function getProductCreator() {
        return $this->product_creator;
    }

    public function getType() {
        return $this->type;
    }
    
    public function getPrice() {
        return $this->price;
    }
    
    public function getSex() {
        return $this->sex;
    }    

}

/* End of file product_definition_model.php */
/* Location: ./application/models/product_definition_model.php */
