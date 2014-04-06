<?php

/*
 * The resource type. 
 * Valid values, along with value-specific parameters, are described below:
 * - type photo : This type is used for representing static photos.
 * - type video : This type is used for representing playable videos.
 * - type link  : 
 *          Responses of this type allow a provider to return any 
 *          generic embed data (such as title and author_name), 
 *          without providing either the url or html parameters. 
 *          The consumer may then link to the resource, 
 *          using the URL specified in the original request.
 * - type rich  : 
 *          This type is used for rich HTML content that
 *          does not fall under one of the other categories.
 */

/**
 *
 * @author PC
 */
interface ICOEmbedTypeValueConstants {

    //type photo
    const COETVC_PHOTO = 'photo';  

    //type video
    const COETVC_VIDEO = 'video';  
    
    //type link
    const COETVC_LINK = 'link';  

    //type rich
    const COETVC_RICH = 'rich';      
}

?>
