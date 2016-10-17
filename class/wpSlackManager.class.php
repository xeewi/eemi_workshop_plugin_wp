<?php

require_once('wpSlackManager.views.php');

class wpSlackManager {

/*	Construct
-------------------------- */
	function __construct(){
		$this->set_wpdb();
		$this->set_table_name();
		$this->_views = new WpSlackManagerViews;
		$this->_url = wpSM_URL;
	}

/*	Proprieties
-------------------------- */
	private $_views;
	private $_wpdb;
	private $_table_name;
	private $_url;

/*	Getters
-------------------------- */
	public function get_wpdb(){
		return $this->_wpdb;
	}

	public function get_table_name(){
		return $this->_table_name;
	}

	public function get_views(){
		return $this->_views;
	}

	public function get_url(){
		return $this->_url;
	}

/*	Setters
-------------------------- */
	private function set_wpdb(){
		global $wpdb;
		$this->_wpdb = $wpdb;
	}

	private function set_table_name(){
		if ( !$this->_wpdb ) { $this->set_wpdb(); }
		$this->_table_name = $this->_wpdb->prefix . "slack_manager";
	}

/*	Functions
-------------------------- */
	public function admin_main_menu(){
		add_menu_page( 'Slack Manager', 
			'Slack Manager',
			'administrator',
			'slack_manager/home',
			[$this->_views, 'home_admin'],
			plugins_url('wpSlackManager/asset/img/icon-menu.svg')
		);
	}
}