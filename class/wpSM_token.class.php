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

	public function edit_access_info($token, $access_token, $scope, $team_id){
		if ( get_class($token) != "wpSM_token_object" ||
			!$object->client_id() || // Require a client_id to be set
			!is_string($access_token) ||
			!is_string($scope) ||
			!is_string($team_id)
		) { return false; }

		$token->set_access_token($access_token);
		$token->set_scope($scope);
		$token->set_team_id($team_id);
		$this->_service->edit($token);
	}

}