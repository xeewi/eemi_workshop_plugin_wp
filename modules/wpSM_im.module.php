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

}