<?php 

/*	
	Direct message (im) service
	wpSlackManager
*/

require_once( 'wpSM.service.php' );

class wpSM_users_service extends wpSM_service {

	private $_slack_uri;

	public function __construct() {	
		$this->_slack_uri = parent::$slack_uri . 'users.'; 
	}

}