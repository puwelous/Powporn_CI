<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author PC
 */
interface ICOEmbedErrorConstants {
    
    const OEEC_404_ERROR_CODE = '404';
    const OEEC_501_ERROR_CODE = '501';
    const OEEC_401_ERROR_CODE = '401';
    const OEEC_500_ERROR_CODE = '500';
    
    const OEEC_404_ERROR_MESSAGE = 'HTTP 404: Not Found';
    const OEEC_501_ERROR_MESSAGE = 'HTTP 501: Not Implemented';
    const OEEC_401_ERROR_MESSAGE = 'HTTP 401: Unauthorized';
    const OEEC_500_ERROR_MESSAGE = 'HTTP 500: Server issues';
    
    const OEEC_KEY_URL = 'url';
    const OEEC_KEY_ERROR_CODE = 'error_code';
    const OEEC_KEY_ERROR_MESSAGE = 'error_message';
    const OEEC_KEY_TYPE = 'type';
    
    const OEEC_VALUE_OF_ERROR_TYPE = 'error';
}

?>
