<?php

class wpSlackManagerViews extends wpSlackManagerCommon {
	
	function __construct(){
		parent::__construct();
	}

	public function home_admin_disconnected(){
		$redirect_uri = parent::get_SITE_URL() . '/wp-admin/admin.php?page=slack_manager.connect';
		$connect = __( 'Click to authorize wpSlackManager to manage your Slack team !', parent::get_NAME() );
		require_once( parent::get_PLUGIN_PATH() . 'views/home_admin.php' );
	}
}