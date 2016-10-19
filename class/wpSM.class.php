<?php

require_once('wpSM_token.class.php');

class wpSM {

	private $_token;
	
	public $modules;

	public function __construct(){
		
		$this->modules = Array(
			'token' => new wpSM_token,
		);
		

		add_action('wp_loaded', Array($this, "wp_loaded"));
	}

	public function wp_loaded(){

		if ( !current_user_can("administrator") ) { return false; }

		$this->_token = $this->modules['token']->get();

		if ( $this->_token->access_token() ) {
			$this->connected();
		} else {
			$this->disconnected();
		}

	}

	public function connected(){
		var_dump("connected");
	}

	public function disconnected(){
		var_dump("disconnected");
	}

}