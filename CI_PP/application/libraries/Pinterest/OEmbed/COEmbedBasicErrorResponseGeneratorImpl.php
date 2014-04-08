<?php

/**
 * Description of OEmbedImpl
 *
 * @author Pavol Daňo
 */
require_once('ICOEmbedBasicErrorResponseGenerator.php');

class COEmbedBasicErrorResponseGeneratorImpl implements ICOEmbedBasicErrorResponseGenerator {

    public function __construct() {
    }    
    
    // 404 Not Found
    // The provider has no response for the requested url parameter. 
    // This allows providers to be broad in their URL scheme, 
    // and then determine at call time if they have a representation to return.
    // Example of an error:
    //  {
    //      'url": "http://flickr.com/embedly", 
    //      "error_code": 404, 
    //      "error_message": "HTTP 404: Not Found", 
    //      "type": "error"
    //  }    
    public function generate_404_not_found($url) {
        return array(
            ICOEmbedErrorKeyConstants::OEEKC_URL => $url,
            ICOEmbedErrorKeyConstants::OEEKC_ERROR_CODE => ICOEmbedErrorValueConstants::OEEVC_ERROR_CODE_404,
            ICOEmbedErrorKeyConstants::OEEKC_ERROR_MESSAGE => ICOEmbedErrorValueConstants::OEEVC_ERROR_MESSAGE_404,
            ICOEmbedErrorKeyConstants::OEEKC_ERROR_TYPE => ICOEmbedErrorValueConstants::OEEC_ERROR_TYPE_VALUE
        );
    }

    // 501 Not Implemented
    // The provider cannot return a response in the requested format. 
    // This should be sent when (for example) the request includes 
    // format=xml and the provider doesn't support XML responses.
    // However, providers are encouraged to support both JSON and XML.
    // Example of an error:
    //  {
    //      "url": "http://flickr.com/embedly", 
    //      "error_code": 501, 
    //      "error_message": "HTTP 501: Not Implemented", 
    //      "type": "error"
    //  }    
    public function generate_501_not_implemented($url) {
        return array(
            ICOEmbedErrorKeyConstants::OEEKC_URL => $url,
            ICOEmbedErrorKeyConstants::OEEKC_ERROR_CODE => ICOEmbedErrorValueConstants::OEEVC_ERROR_CODE_501,
            ICOEmbedErrorKeyConstants::OEEKC_ERROR_MESSAGE =>  ICOEmbedErrorValueConstants::OEEVC_ERROR_MESSAGE_501,
            ICOEmbedErrorKeyConstants::OEEKC_ERROR_TYPE =>  ICOEmbedErrorValueConstants::OEEC_ERROR_TYPE_VALUE
        );
    }

    // 401 Unauthorized
    // The specified URL contains a private (non-public) resource. 
    // The consumer should provide a link directly to the resource 
    // instead of any embedding any extra information, 
    // and rely on the provider to provide access control.
    // Example of an error:
    //  {
    //      "url": "http://flickr.com/embedly", 
    //      "error_code": 401, 
    //      "error_message": "HTTP 401: Unauthorized", 
    //      "type": "error"
    //  }    
    public function generate_401_unauthorized($url) {
        return array(
            ICOEmbedErrorKeyConstants::OEEKC_URL => $url,
            ICOEmbedErrorKeyConstants::OEEKC_ERROR_CODE => ICOEmbedErrorValueConstants::OEEVC_ERROR_CODE_401,
            ICOEmbedErrorKeyConstants::OEEKC_ERROR_MESSAGE => ICOEmbedErrorValueConstants::OEEVC_ERROR_MESSAGE_404,
            ICOEmbedErrorKeyConstants::OEEKC_ERROR_TYPE => ICOEmbedErrorValueConstants::OEEC_ERROR_TYPE_VALUE
        );
    }

    // 500 Server Issues
    // If a server error occurs. 
    // Example of an error:
    //  {
    //      "url": "http://flickr.com/embedly", 
    //      "error_code": 500, 
    //      "error_message": "HTTP 500: Server Issues", 
    //      "type": "error"
    //  }      
    public function generate_500_server_issues($url) {
        return array(
            ICOEmbedErrorKeyConstants::OEEKC_URL => $url,
            ICOEmbedErrorKeyConstants::OEEKC_ERROR_CODE => ICOEmbedErrorValueConstants::OEEVC_ERROR_CODE_500,
            ICOEmbedErrorKeyConstants::OEEKC_ERROR_MESSAGE => ICOEmbedErrorValueConstants::OEEVC_ERROR_MESSAGE_500,
            ICOEmbedErrorKeyConstants::OEEKC_ERROR_TYPE => ICOEmbedErrorValueConstants::OEEC_ERROR_TYPE_VALUE
        );
    }

}

?>
