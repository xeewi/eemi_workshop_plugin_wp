<?php

class wpSM_token {

	private $_access_token;
	private $_user_id;

	public function __construct(){
		$this->set_user_id( get_current_user_id() );
	}
	
	public function hydrate($values){
		foreach ($values as $key => $value) {
			$method = "set_" . $key;
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	public function access_token(){
		return $this->_access_token;
	}

	public function user_id(){
		return $this->_user_id;
	}

	public function set_user_id($value){
		if ( !is_int($value) ) { throw new Execption('value must be an int'); return false; }
	}

	public function set_access_token($value){
		if ( !is_string($value) ){ throw new Exception("value must be a string", 1); return false; }
		$this->access_token = $value;
	}

};