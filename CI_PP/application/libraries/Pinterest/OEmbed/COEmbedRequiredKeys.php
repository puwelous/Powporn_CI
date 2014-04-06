<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of COEmbedBasicKeys
 *
 * @author PC
 */
require_once('enumhelper/CAbstractEnum.php');

require_once('ICOEmbedRequiredResponseConstants.php');


abstract class COEmbedRequiredKeys extends CAbstractEnum implements ICOEmbedRequiredResponseConstants {
    
    const OEMBED_TYPE_KEY = ICOEmbedRequiredResponseConstants::OERC_TYPE;
    const OEMBED_TYPE_VERSION = ICOEmbedRequiredResponseConstants::OERC_VERSION;
}

?>
