<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author PC
 */
interface ICPinterest {

    public function add_pinterest_required_response_items($response_array, $key_value_items_array);

    public function add_pinterest_optional_response_items($response_array, $key_value_items_array);

    public function add_pinterest_any_response_items($response_array, $key_value_items_array);
}

?>
