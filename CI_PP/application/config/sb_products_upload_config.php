<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Settings for  products upload.
 */
$config['product_upload_path']      = './assets/images/products/finals/';
$config['product_allowed_types']    = 'gif|jpg|png';
$config['product_max_size']         = '100';
$config['product_max_width']        = '1024';
$config['product_max_height']       = '1024';

/*
 * Settings for basic products upload.
 */
$config['basic_product_upload_path']      = 'assets/images/products/basic/';
$config['basic_product_allowed_types']    = 'gif|jpg|png';
$config['basic_product_max_size']         = '100';
$config['basic_product_max_width']        = '2048'; //TODO
$config['basic_product_max_height']       = '2048'; //TODO

/*
 * Settings for components upload.
 */
$config['component_upload_path']      = 'assets/images/products/components/';
$config['component_allowed_types']    = 'gif|jpg|png';
$config['component_max_size']         = '100';
$config['component_max_width']        = '2048'; //TODO
$config['component_max_height']       = '2048'; //TODO

/*
 * Settings for category icons upload.
 */
$config['category_icon_upload_path']      = 'assets/images/icons/categories/';
$config['category_icon_allowed_types']    = 'svg';
$config['category_icon_max_size']         = '100';
$config['category_icon_max_width']        = '2048'; //TODO
$config['category_icon_max_height']       = '2048'; //TODO

/*
 * Settings for subcategory icons upload.
 */
$config['subcategory_icon_upload_path']      = 'assets/images/icons/subcategories/';
$config['subcategory_icon_allowed_types']    = 'svg';
$config['subcategory_icon_max_size']         = '100';
$config['subcategory_icon_max_width']        = '2048'; //TODO
$config['subcategory_icon_max_height']       = '2048'; //TODO

/* End of file pp_products_upload_config.php */
/* Location: ./application/config/pp_products_upload_config.php */