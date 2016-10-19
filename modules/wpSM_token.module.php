<?php

/*	
	Token module
	wpSlackManager
*/

require_once(WP_PLUGIN_DIR . '/wpSlackManager/objects/wpSM_token.object.php');
require_once(WP_PLUGIN_DIR . '/wpSlackManager/services/wpSM_token.service.php');

class wpSM_token {

	private $_service;

	public function __construct(){
		// Init service
		$this->_service = new wpSM_token_service;
	}

/*	Get a token
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function get(){
		$token = new wpSM_token_object;
		$this->_service->get( $token );
		if ( !$token->id() ) {
			$this->_service->add($token);
		}
		return $token;
	}

/*	Edit token clients
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function edit_clients($token, $client_id, $client_secret){
		if ( get_class($token) != "wpSM_token_object" ||
			$token->access_token() || // Must revock access of current client
			!is_string($client_id) || 
			!is_string($client_secret)
		){ return false; }

		$token->set_client_id($client_id);
		$token->set_client_secret($client_secret);
		$this->_service->edit($token);
	}

/*	Get access from Slack
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function edit_access( $token, $code ){
		if ( get_class($token) != "wpSM_token_object" ||
			!$token->client_id() || // Require a client_id to be set
			!$token->client_secret() || // Require a client_secret to be set
			!is_string($code)
		) { return false; }

		$token->set_code($code);
		$this->_service->get_access($token);
		$this->_service->edit($token);
	}

}