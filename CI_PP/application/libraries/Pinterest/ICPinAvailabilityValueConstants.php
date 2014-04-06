<?php

/*
 * Case-insensitive string, possible values: "in stock", "preorder", "backorder" 
 * (will be back in stock soon), 
 * “out of stock” (may be back in stock some time), 
 * “discontinued.” 
 * Discontinued items won’t be part of a daily scrape 
 * and marking them will decrease the load on your servers.
 */

/**
 *
 * @author PC
 */
interface ICPinAvailabilityValueConstants {

    //in stock
    const PAVC_IN_STOCK = 'in stock';  
    
    //preorder
    const PAVC_PREORDER = 'preorder';  
    
    //backorder
    const PAVC_BACKORDER = 'backorder';     
    
    //out of stock
    const PAVC_OUT_OF_STOCK = 'out of stock';   
    
    //discontinued
    const PAVC_DISCONTINUED = 'discontinued'; 
}

?>
