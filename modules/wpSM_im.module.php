<?php

/*	
	Direct messages (im) module
	wpSlackManager
*/

class wpSM_im {

	private $_service;

	public function __construct(){
		// Init service
		$this->_service = new wpSM_users_service;
	}

}