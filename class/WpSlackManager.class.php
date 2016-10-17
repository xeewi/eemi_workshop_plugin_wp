<?php

class WpSlackManager {

/*	Construct
-------------------------- */
	function __construct(){
		$this->set_wpdb();
	}

/*	Proprieties
-------------------------- */
	private $_wpdb;

/*	Getters
-------------------------- */
	public function get_wpdb(){
		return $this->_wpdb;
	}

/*	Setters
-------------------------- */
	private function set_wpdb(){
		global $wpdb;
		$this->_wpdb = $wpdb;
	}

}