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
		$this->_service->get($token);
		return $token;
	}

	public function add($values){

	}	
}