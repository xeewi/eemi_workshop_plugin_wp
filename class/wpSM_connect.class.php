<?php

class wpSM_connect extends wpSM_common {
	
	function __construct(){
		parent::__construct();
	}

	public function hook_add_connect(){
		add_action( 'admin_menu', array( $this, 'add_connect' ) );
	}

	public function controller_connect(){
		$this->view_connect();
	}

	public function view_connect(){
		
		$connect = __( 'Click to connect your Slack account !', parent::get_NAME() );
		require_once( parent::get_PLUGIN_PATH() . 'views/connect.php' );
	}

	public function add_connect(){
		add_menu_page( 'Slack Manager connection', 
			'Slack Manager',
			'administrator',
			'slack_manager.connect',
			[ $this, 'controller_connect' ],
			parent::get_PLUGIN_URL() . '/asset/img/icon-menu.svg' );
	}
}