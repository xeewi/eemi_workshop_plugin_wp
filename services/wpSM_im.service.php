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

	public function history( $token, $channel, $lastest = false, $oldest = false, $inclusive = false, $count = false, $unreads = false ){
		if ( get_class( $token ) != "wpSM_token_object" ){ return false; }
		if ( !$token->access_token() ){ return false; }

		$params = Array( 'channel' => $channel );

		if ( $lastest && is_string( $lastest ) ) { $params['lastest'] = $lastest; }
		if ( $oldest && is_string( $oldest ) ) { $params['oldest'] = $oldest; }
		if ( $inclusive ) { $params['inclusive'] = 1; }
		if ( $count && is_int( $count ) ) { $params['count'] = $count; }
		if ( $unreads ) { $params['unreads'] = 1; }

		$params = http_build_query($params);

		$url = parent::$slack_uri . "im.history?token=" . $token->access_token() . '&' .$params;

		$response = wp_remote_get( $url );
		$json = json_decode( $response['body'] );

		if ( !$json->ok ) { return false; }

		return $json;		
	}

}