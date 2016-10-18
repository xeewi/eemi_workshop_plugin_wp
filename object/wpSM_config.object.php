<?php

class wpSM_config {

	private $_client_id;
	private $_client_secret;

	public function __construct(){}

	public function client_id(){
		return $this->_client_id;
	}
	public function client_secret(){
		return $this->_client_secret;
	}
}