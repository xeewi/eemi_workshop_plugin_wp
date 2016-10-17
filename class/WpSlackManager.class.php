<?php

class WpSlackManager {

/*	Construct
-------------------------- */
	function __construct(){
		$this->set_wpdb();
		$this->set_table_name();
	}

/*	Proprieties
-------------------------- */
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

}