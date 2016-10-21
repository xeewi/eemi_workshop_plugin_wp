<?php

/*	
	Direct messages (im) module
	wpSlackManager
*/

require_once(WP_PLUGIN_DIR . '/wpSlackManager/services/wpSM_im.service.php');

class wpSM_im extends wpSM_im_service {

	public function __construct(){
		parent::__construct();
	}

	public function get_list( $token ){
		$list = parent::get_list( $token );
		return $list;
	}

	public function get_messages( $token, $im_id ){
		$history = parent::history( $token, $im_id, false, false, false, false, true );
		return array_reverse( $history->messages );
	}

	public function is_unread( $token, $im_id ){
		$history = parent::history( $token, $im_id, false, false, false, false, true );
		$unred = $history->unread_count_display;
		return $unred;
	}

	public function get_menu_list( $token ){
		$list = $this->get_list( $token );
		foreach ($list as $key => $im) {
			$im->unred = $this->is_unread( $token, $im->id );
		}
		return $list;
	}

}