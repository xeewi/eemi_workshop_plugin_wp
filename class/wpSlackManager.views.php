<?php

class wpSlackManagerViews {
	
	function __construct(){
		$this->_path = wpSM_PATH;
	}

	private $_path;

	private function get_path(){
		return $this->_path;
	}

	public function home_admin(){
		require_once( $this->get_path() . 'views/home_admin.php' );
	}
}