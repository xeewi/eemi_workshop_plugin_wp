<?php 

/*	
	Direct message (im) service
	wpSlackManager
*/

require_once( 'wpSM.service.php' );

class wpSM_im_service extends wpSM_service {

	private $_slack_uri;

	public function __construct() {	
		$this->_slack_uri = parent::$slack_uri . 'users.'; 
	}

	public function get_list( $token ){
		if ( get_class( $token ) != "wpSM_token_object" ){ return false; }
		if ( !$token->access_token() ){ return false; }

		$url = parent::$slack_uri . "im.list?token=" . $token->access_token();

		$response = wp_remote_get( $url );
		$json = json_decode( $response['body'] );

		if ( !$json->ok ) { return false; }

		return $json->ims;
	}

}