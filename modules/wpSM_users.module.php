<?php

/*	
	Users module
	wpSlackManager
*/

require_once(WP_PLUGIN_DIR . '/wpSlackManager/services/wpSM_users.service.php');

class wpSM_users {

	private $_service;

	public function __construct(){
		// Init service
		$this->_service = new wpSM_users_service;
	}

/*	List users
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function get_list( $token, $presence = false, $order = false){
		$members = $this->_service->get_list( $token, $presence );
		return $members;
	}

/*	Get a user
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/

}