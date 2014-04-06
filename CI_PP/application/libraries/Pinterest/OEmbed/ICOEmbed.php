<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author PC
 */
interface ICOEmbed {

    public function check_url_from_get($urlToBeChecked);

    public function remove_expected_part($url);

    public function set_accepted_url_scheme($acceptedURLScheme);

    public function get_accepted_url_scheme();

    public function add_oembed_required_response_items($response_array, $key_value_items_array);

    public function add_oembed_optional_response_items($response_array, $key_value_items_array);

    public function add_oembed_any_response_items($response_array, $key_value_items_array);
}

?>
