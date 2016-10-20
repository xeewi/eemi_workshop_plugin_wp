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
	public function get_list( $token, $presence = false ){
		$members = $this->_service->get_list( $token, $presence );
		$users   = Array();

		foreach ($members as $key => $member) {
			$member = (array) $member;
			$user = new wpSM_users_object( $member );
			$user->set_profile( (array) $member['profile'] );
			array_push($users, $user);
		}

		var_dump($users[1]);

		return $users;
	} 

/*	Get a user
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/

}