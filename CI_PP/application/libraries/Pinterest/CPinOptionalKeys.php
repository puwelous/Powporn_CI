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

require_once('ICPinOptionalResponseConstants.php');

abstract class CPinOptionalKeys extends CAbstractEnum implements ICPinOptionalResponseConstants {

    const PIN_TYPE_PROVIDER_NAME = ICPinOptionalResponseConstants::POC_PROVIDER_NAME;
    const PIN_TYPE_DESCRIPTION = ICPinOptionalResponseConstants::POC_DESCRIPTION;
    const PIN_TYPE_BRAND = ICPinOptionalResponseConstants::POC_BRAND;
    const PIN_TYPE_PRODUCT_ID = ICPinOptionalResponseConstants::POC_PRODUCT_ID;
    const PIN_TYPE_AVAILABILITY = ICPinOptionalResponseConstants::POC_AVAILABILITY;
    const PIN_TYPE_QUANTITY = ICPinOptionalResponseConstants::POC_QUANTITY;
    const PIN_TYPE_STANDARD_PRICE = ICPinOptionalResponseConstants::POC_STANDARD_PRICE;
    const PIN_TYPE_SALES_START_DATE = ICPinOptionalResponseConstants::POC_SALES_START_DATE;
    const PIN_TYPE_SALES_END_DATE = ICPinOptionalResponseConstants::POC_SALES_END_DATE;
    const PIN_TYPE_PRODUCT_EXPIRATION = ICPinOptionalResponseConstants::POC_PRODUCT_EXPIRATION;
    const PIN_TYPE_GENDER = ICPinOptionalResponseConstants::POC_GENDER;
    const PIN_TYPE_GEO_AVAILABILITY = ICPinOptionalResponseConstants::POC_GEO_AVAILABILITY;
    const PIN_TYPE_COLOR = ICPinOptionalResponseConstants::POC_COLOR;
    const PIN_TYPE_IMAGES = ICPinOptionalResponseConstants::POC_IMAGES;
    const PIN_TYPE_RELATED_ITEMS = ICPinOptionalResponseConstants::POC_RELATED_ITEMS;
    const PIN_TYPE_REFERENCED_ITEMS = ICPinOptionalResponseConstants::POC_REFERENCED_ITEMS;
    const PIN_TYPE_RATING = ICPinOptionalResponseConstants::POC_RATING;
    const PIN_TYPE_RATING_SCALE = ICPinOptionalResponseConstants::POC_RATING_SCALE;
    const PIN_TYPE_RATING_COUNT = ICPinOptionalResponseConstants::POC_RATING_COUNT;

}

?>
