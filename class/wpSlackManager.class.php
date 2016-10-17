<?php

require_once( 'wpSlackManager.common.php' );
require_once( 'wpSlackManager.views.php' );

class wpSlackManager extends wpSlackManagerCommon {
/*	Proprieties
-------------------------- */
	private $_views;

/*	Construct
-------------------------- */
	function __construct(){
		parent::__construct();
		$this->_views = new WpSlackManagerViews;
	}

/*	Methods
-------------------------- */
	public function admin_main_menu_disconnected(){
		add_menu_page( 'Slack Manager Disconnected', 
			'Slack Manager',
			'administrator',
			'slack_manager.home_admin_disconnected',
			[ $this->_views, 'home_admin_disconnected' ],
			parent::get_PLUGIN_URL() . '/asset/img/icon-menu.svg' );
	}
		
	public function load_text_domain(){
		load_plugin_textdomain( 'wpSlackManager', false, dirname( parent::get_PLUGIN_PATH() . 'lang/' ) );
	}



}