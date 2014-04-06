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
require_once('OEmbed/enumhelper/CAbstractEnum.php');

require_once('ICPinRequiredResponseConstants.php');


abstract class CPinRequiredKeys extends CAbstractEnum implements ICPinRequiredResponseConstants {
    
    const PIN_TYPE_URL = ICPinRequiredResponseConstants::PRC_URL;
    const PIN_TYPE_TITLE = ICPinRequiredResponseConstants::PRC_TITLE;
    const PIN_TYPE_PRICE = ICPinRequiredResponseConstants::PRC_PRICE;
    const PIN_TYPE_CURRENCY_CODE = ICPinRequiredResponseConstants::PRC_CURRENCY_CODE;
}

?>
