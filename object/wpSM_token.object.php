<?php

class wpSM_token_object {

	private $_access_token;
	private $_user_id;
	private $_scope;
	private $_team_id;

	public function __construct(){ 
		$this->set_user_id( get_current_user_id() );
	}
	
	public function hydrate($values){
		if( !$values || !is_array($values) ){ return false; }
		foreach ($values as $key => $value) {
			$method = "set_" . $key;

			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	public function access_token(){ return $this->_access_token; }
	public function user_id(){ return $this->_user_id; }
	public function scope(){ return $this->_scope; }
	public function team_id(){ return $this->_team_id; }

	public function set_access_token($value){
		if ( !is_string($value) ){ return false; }
		$this->_access_token = $value;
	}

	public function set_user_id($value){
		if ( !is_int($value) ) { return false; }
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

}