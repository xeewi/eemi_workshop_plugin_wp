<?php

/*	
	Users module
	wpSlackManager
*/

require_once(WP_PLUGIN_DIR . '/wpSlackManager/services/wpSM_users.service.php');

class wpSM_users extends wpSM_users_service {

	public function __construct(){
		parent::__construct();
	}

/*	List users
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function get_list( $token, $presence = false, $by_presence = false){
		$members = parent::get_list( $token, $presence );
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
		$user = parent::get( $token, $user_id );
		if ( $presence ) {
			$user->presence = parent::get_presence( $token, $user_id );
		}
		return $user;
	}

/*	Edit an user profile
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function set_profile( $token, $user_id, $profile ){
		$profile = parent::set_profile( $token, $user_id, $profile );
		return $profile;
	}


}