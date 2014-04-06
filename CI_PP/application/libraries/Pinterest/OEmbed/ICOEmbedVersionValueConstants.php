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
interface ICOEmbedVersionValueConstants {

    //in stock
    const COEVVC_FIRST = '1.0';  

}

?>
