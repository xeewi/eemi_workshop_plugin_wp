<?php

/*	
	Direct messages (im) module
	wpSlackManager
*/

require_once(WP_PLUGIN_DIR . '/wpSlackManager/services/wpSM_im.service.php');
require_once(WP_PLUGIN_DIR . '/wpSlackManager/services/wpSM_im.service.php');

class wpSM_im extends wpSM_im_service {

	public function __construct(){
		parent::__construct();
	}

	public function get_list( $token ){
		$list = parent::get_list( $token );
		return $list;
	}

	public function is_unread( $token, $im ){
		$history = parent::history( $token, $im->id, false, false, false, false, true );
		$im->unread = $history->unread_count_display;
		return $im;
	}

	public function get_menu_list( $token ){
		$list = $this->get_list( $token );
		foreach ($list as $key => $im) {
			$im = $this->is_unread( $token, $im );
		}
		return $list;
	}

}