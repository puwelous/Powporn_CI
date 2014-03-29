<?php

class Cart_model extends MY_Model {

    public $_table = 'pp_cart';
    public $primary_key = 'c_id';

    public $sum;
    public $status;
    public $order;
    public $ordering_person;


    public $protected_attributes = array( 'c_id' );
    
    public function __construct() {
        parent::__construct();
    }

    public function setAll($sum, $status, $order, $ordering_person ) {

        $this->sum              = $sum;
        $this->status           = $status;
        $this->order            = $order;
        $this->ordering_person  = $ordering_person;
    }

    public function add_cart(Cart_model $cart) {

        $this->cart_model->insert(
                array(
                    'c_sum'                 => $cart->sum,
                    'c_status'              => $cart->status,
                    'o_id'                  => $cart->order,
                    'u_ordering_person_id'  => $cart->ordering_person
        ));
    }

//    public function get_by_email_or_nick_and_password($email_or_nick, $password) {
//
//        $this->db->where("u_email_address", $email_or_nick);
//        $this->db->or_where('u_nick', $email_or_nick);
//        $this->db->where("u_password", md5($password));
//        $this->db->limit(1);
//
//        $query = $this->db->get($this->_table);
//
//        //$str = $this->db->last_query();
//        //log_message('debug', print_r($str, TRUE));
//
//        if ($query->num_rows() > 0) {
//            $row = $query->row();
//
//            return $row;
//        } else {
//            return NULL;
//        }
//    }
//    
//    public function is_present_by( $column, $value){
//        $row = $this->user_model->get_by( $column, $value );
//        
//        return $row;
//    }

}

/* End of file cart_model.php */
/* Location: ./application/models/cart_model.php */
