<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author PC
 */
interface ICOEmbedErrorValueConstants {
    
    const OEEVC_ERROR_CODE_404 = '404';
    const OEEVC_ERROR_CODE_501 = '501';
    const OEEVC_ERROR_CODE_401 = '401';
    const OEEVC_ERROR_CODE_500 = '500';
    
    const OEEVC_ERROR_MESSAGE_404 = 'HTTP 404: Not Found';
    const OEEVC_ERROR_MESSAGE_501 = 'HTTP 501: Not Implemented';
    const OEEVC_ERROR_MESSAGE_401 = 'HTTP 401: Unauthorized';
    const OEEVC_ERROR_MESSAGE_500 = 'HTTP 500: Server issues';
    
    const OEEC_ERROR_TYPE_VALUE = 'error';
}

?>
