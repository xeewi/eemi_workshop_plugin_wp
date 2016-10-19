<?php

/*	
	Users module
	wpSlackManager
*/

require_once(WP_PLUGIN_DIR . '/wpSlackManager/objects/wpSM_users.object.php');
require_once(WP_PLUGIN_DIR . '/wpSlackManager/services/wpSM_users.service.php');

class wpSM_users {

	private $_service;

	public function __construct(){
		// Init service
		$this->_service = new wpSM_users_service;
	}

/*	List users
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/

/*	Get a user
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/

}