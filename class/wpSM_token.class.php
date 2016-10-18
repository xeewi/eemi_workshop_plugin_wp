<?php
require_once(WP_PLUGIN_DIR . '/wpSlackManager/object/wpSM_token.object.php');
require_once(WP_PLUGIN_DIR . '/wpSlackManager/service/wpSM_token.service.php');

class wpSM_token {

	private $_service;

	public function __construct(){
		$this->_service = new wpSM_token_service;
	}

	public function get(){
		$token = new wpSM_token_object;
		$this->_service->get( $token );
		if ( !$token->id() ) {
			$this->_service->add($token);
		}
		return $token;
	}

	public function add_clients($token, $client_id, $client_secret){
		if ( get_class($token) != "wpSM_token_object" ){ return false; }
		if ( $token->access_token() ) { return false; } // Must revock access of current client before change client
		
	}	
}