<?php

require_once('WpSlackManager.views.php');

class WpSlackManager {

/*	Construct
-------------------------- */
	function __construct(){
		$this->set_wpdb();
		$this->set_table_name();
		$this->set_views();
	}

/*	Proprieties
-------------------------- */
	private $_views;
	private $_wpdb;
	private $_table_name;

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

	private function set_views(){
		$this->_views = new WpSlackManagerViews;
	}

/*	Functions
-------------------------- */
	public function admin_main_menu(){
		add_menu_page( 'Slack Manager', 
			'Slack Manager',
			'administrator',
			'slack_manager/home',
			[$this->_views, 'home'],
			plugins_url('wpSlackManager/asset/img/icon-menu.svg')
			);

	}
}