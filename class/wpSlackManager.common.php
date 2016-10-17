<?php

class wpSlackManagerCommon {
	
	private $_NAME;
	private $_SITE_URL;
	private $_PLUGIN_URL;
	private $_PLUGIN_PATH;

	function __construct(){
		// global $wpdb;
		// $this->_wpdb       = $wpdb;
		// $this->_table_name = $this->_wpdb->prefix . "slack_manager";
		$this->_NAME = "wpSlackManager";
		$this->_SITE_URL   = get_site_url();
		$this->_PLUGIN_URL   = plugins_url( 'wpSlackManager/' );
		$this->_PLUGIN_PATH  = WP_PLUGIN_DIR . "/wpSlackManager/";
	}

	public function get_NAME(){
		return $this->_NAME;
	}

	public function get_SITE_URL(){
		return $this->_SITE_URL;
	}

	public function get_PLUGIN_URL(){
		return $this->_PLUGIN_URL;
	}

	public function get_PLUGIN_PATH(){
		return $this->_PLUGIN_PATH;
	}

	// public function get_wpdb(){
	// 	return $this->_wpdb;
	// }

	// public function get_table_name(){
	// 	return $this->_table_name;
	// }
}