<?php

/**
 * Interface holding basic required oEmbed constants with values 
 * defining JSON keys or XML elements' names.
 * @link http://oembed.com/#section2
 * 
 * @see ICOEmbedOptionalResponseConstants
 * 
 * @author Pavol Daňo
 * @version 1.0
 * @file
 */
interface ICOEmbedRequiredResponseConstants {
    

    /**
     * type (required)
     * The resource type. Valid values, along with value-specific parameters, are described below.
     */
    const OERC_TYPE = 'type';

    /**
     * version (required)
     * The oEmbed version number. This must be 1.0.
     */
    const OERC_VERSION = 'version';

}

?>
