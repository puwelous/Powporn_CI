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

require_once('ICOEmbedOptionalResponseConstants.php');

abstract class COEmbedOptionalKeys extends CAbstractEnum implements ICOEmbedOptionalResponseConstants{

    const OEMBED_TYPE_TITLE = ICOEmbedOptionalResponseConstants::OERC_TITLE;
    const OEMBED_TYPE_AUTHOR_NAME = ICOEmbedOptionalResponseConstants::OERC_AUTHOR_NAME;
    const OEMBED_TYPE_AUTHOR_URL = ICOEmbedOptionalResponseConstants::OERC_AUTHOR_URL;
    const OEMBED_TYPE_PROVIDER_NAME = ICOEmbedOptionalResponseConstants::OERC_PROVIDER_NAME;
    const OEMBED_TYPE_PROVIDER_URL = ICOEmbedOptionalResponseConstants::OERC_PROVIDER_URL;
    const OEMBED_TYPE_CACHE_AGE = ICOEmbedOptionalResponseConstants::OERC_CACHE_AGE;
    const OEMBED_TYPE_THUMBNAIL_URL = ICOEmbedOptionalResponseConstants::OERC_THUMBNAIL_URL;
    const OEMBED_TYPE_THUMBNAIL_WIDTH = ICOEmbedOptionalResponseConstants::OERC_THUMBNAIL_WIDTH;
    const OEMBED_TYPE_THUMBNAIL_HEIGHT = ICOEmbedOptionalResponseConstants::OERC_THUMBNAIL_HEIGHT;
}

?>
