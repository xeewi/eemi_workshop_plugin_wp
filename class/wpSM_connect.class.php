<?php

class wpSM_connect extends wpSM_common {
	
	function __construct(){
		parent::__construct();
		add_action( 'admin_menu', array( $this, 'add_page' ) );
	}

	public function controller(){
		$this->view_disconnect();
	}

	public function view_disconnect(){
		$redirect_uri = parent::get_SITE_URL() . '/wp-admin/admin.php?page=slack_manager.connect';
		$connect = __( 'Click to authorize wpSlackManager to manage your Slack team !', parent::get_NAME() );
		require_once( parent::get_PLUGIN_PATH() . 'views/connect.php' );
	}

	public function add_page(){
		add_menu_page( 'Slack Manager Disconnected', 
			'Slack Manager',
			'administrator',
			'slack_manager.connect',
			[ $this, 'controller' ],
			parent::get_PLUGIN_URL() . '/asset/img/icon-menu.svg' );
	}
}