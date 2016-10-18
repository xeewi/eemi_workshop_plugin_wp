<?php

class wpSM_token_object {

	private $_id;
	private $_access_token;
	private $_user_id;
	private $_scope;
	private $_team_id;
	private $_client_id;
	private $_client_secret;

	public function __construct(){ 
		$this->_set_user_id( get_current_user_id() );
	}
	
	public function hydrate($values){
		if( !$values ){ return false; }
		foreach ($values as $key => $value) {
			$method = "set_" . $key;
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	public function id(){ return $this->_id; }
	public function user_id(){ return $this->_user_id; }
	public function access_token(){ return $this->_access_token; }
	public function scope(){ return $this->_scope; }
	public function team_id(){ return $this->_team_id; }
	public function client_id(){ return $this->_client_id; }
	public function client_secret(){ return $this->_client_secret; }

	public function set_id($value){
		if ( !is_int( intval( $value ) ) ) { return false; }
		$this->_id = $value;
	}

	private function _set_user_id($value){ // Used only on constructor
		if ( !is_int($value) ) { return false; }
		$this->_user_id = $value;
	}

	public function set_access_token($value){
		if ( !is_string($value) ){ return false; }
		$this->_access_token = $value;
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

}