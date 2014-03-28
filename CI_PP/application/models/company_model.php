<?php

class Company_model extends MY_Model {

    public $_table = 'pp_company';
    public $primary_key = 'cmpn_id';

    public function __construct() {
        parent::__construct();
    }
    
    public function get_company() {

        $this->db->limit(1);
        $query = $this->db->get($this->_table);

        if ($query->num_rows() > 0) {
            $row = $query->row();

            return $row;
        } else {
            return NULL;
        }
    }    
}

/* End of file company_model.php */
/* Location: ./application/models/company_model.php */
