<?php

/*	
	Token object
	wpSlackManager
*/

class wpSM_token_object {

	private $_id;
	private $_wp_user_ID;
	private $_user_id;
	private $_team_id;
	private $_access_token;
	private $_scope;
	private $_client_id;
	private $_client_secret;
	private $_bot_id;
	private $_bot_token;
	private $_code;

	public function __construct(){ 
		$this->_set_wp_user_ID( get_current_user_id() );
	}

/*	Hydrate
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function hydrate($values){

		if( !$values ){ return false; }
		foreach ($values as $key => $value) {
			$method = "set_" . $key;
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

/*	Getters
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function id(){ return $this->_id; }
	public function wp_user_ID(){ return $this->_wp_user_ID; }
	public function user_id(){ return $this->_user_id; }
	public function access_token(){ return $this->_access_token; }
	public function scope(){ return $this->_scope; }
	public function team_id(){ return $this->_team_id; }
	public function client_id(){ return $this->_client_id; }
	public function client_secret(){ return $this->_client_secret; }
	public function bot_id(){ return $this->_bot_id; }
	public function bot_token(){ return $this->_bot_token; }
	public function code(){ return $this->_code; }

/*	Setters
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function set_id($value){
		if ( !is_int( intval( $value ) ) ) { return false; }
		$this->_id = $value;
	}

	private function _set_wp_user_ID($value){
		if ( !is_int( intval( $value ) ) ) { return false; }
		$this->_wp_user_ID = $value;
	}

	public function set_access_token($value){
		if ( !is_string($value) ){ return false; }
		$this->_access_token = $value;
	}

	public function set_user_id($value){
		if ( !is_string($value) ) { return false; }
		$this->_user_id = $value;
	}

	public function set_scope( $value ) {
		if ( !is_string($value) ) { return false; }
		$this->_scope = $value;
	}

	public function set_team_id( $value ) {
		if ( !is_string($value) ) { return false; }
		$this->_team_id = $value;
	}

	public function set_client_id( $value ){
		if ( !is_string($value) ){ return false; }
		$this->_client_id = $value;
	}

	public function set_client_secret( $value ){
		if ( !is_string($value) ){ return false; }
		$this->_client_secret = $value;
	}

	public function set_bot_id( $value ){
		if ( !is_string($value) ){ return false; }
		$this->_bot_id = $value;
	}

	public function set_bot_token( $value ){
		if ( !is_string($value) ){ return false; }
		$this->_bot_token = $value;
	}

	public function set_code( $value ){
		if ( !is_string($value) ){ return false; }
		$this->_code = $value;
	}

}