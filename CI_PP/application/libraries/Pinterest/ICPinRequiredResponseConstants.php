<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author PC
 */
interface ICPinRequiredResponseConstants {
    
    //url (required)
    //String, canonical URL for the page (for example 
    //"http://www.etsy.com/listing/83934917/chocolate-raspberry-drizzle-body-lotion")
    const PRC_URL = 'url';

    //title (required)
    //String, product name. 
    //May be truncated, all formatting and HTML tags will be removed.
    const PRC_TITLE = 'title';
    
    //price (required)
    //Number (float), 
    //product price (without currency sign, for example "6.50").
    const PRC_PRICE = 'price';    

    //currency code (required)
    //String, currency code as defined 
    //in http://www.xe.com/iso4217.php (for example "USD").
    const PRC_CURRENCY_CODE = 'currency_code';   
    
    
}

?>
