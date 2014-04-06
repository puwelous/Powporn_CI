<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author PC
 */
interface ICOEmbedBasicErrorResponseGenerator {
    
    public function generate_404_not_found( $url  );
    public function generate_501_not_implemented( $url );
    public function generate_401_unauthorized(  $url );
    public function generate_500_server_issues(  $url );
}

?>
