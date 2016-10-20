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
	public function get_list( $token, $presence = false, $by_presence = false){
		$members = $this->_service->get_list( $token, $presence );
		if ( $by_presence ) {
			$presence = Array();
			foreach ($members as $key => $member) {
				if ( isset( $member->presence ) ) {
					$presence[$key] = $member->presence;
				} else {
					$presence[$key] = "away";
				}
			}
			array_multisort($presence, SORT_DESC, $members);
		}
		return $members;
	}

/*	Get an user
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function get( $token, $user_id, $presence = false ){
		$user = $this->_service->get( $token, $user_id );
		if ( $presence ) {
			$user->presence = $this->_service->get_presence( $token, $user_id );
		}
		return $user;
	}

/*	Edit an user profile
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function set_profile( $token, $user_id, $profile ){
		$profile = $this->_service->set_profile( $token, $user_id, $profile );
		return $profile;
	}

}