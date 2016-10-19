<?php 

/*	
	Users service
	wpSlackManager
*/

require_once( 'wpSM.service.php' );

class wpSM_users_service extends wpSM_service {

	private $_slack_uri;

	public function __construct() {	
		$this->_slack_uri = parent::$slack_uri . 'users.'; 
	}

/*	List users
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function get_list( $token, $presence = false ){
		if ( get_class( $token ) != "wpSM_token_object" ){ return false; }
		if ( !$token->access_token() ){ return false; }

		$url = $this->_slack_uri . "list?token=" . $token->access_token();
		if ( $presence ) { $url .= "&presence=" . $presence; }

		$response = wp_remote_get( $url );
		$json = json_decode( $response['body'] );

		if ( !$json->ok ) { return false; }

		return $json->members;
	}

}