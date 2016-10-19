<?php

/*	
	Users object
	wpSlackManager
*/

class wpSM_users_object {

	private $_id;
	private $_name;
	private $_deleted;
	private $_color;
	private $_is_admin;
	private $_is_owner;
	private $_profile;

	public function __construct( $values = false ){
		if ( $values ) { $this->hydrate($values); } 
	}

/*	Hydrate
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function hydrate($values){
		if( !$values || !is_array($values) ){ return false; }
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
	public function name(){ return $this->_name; }
	public function deleted(){ return $this->_deleted; }
	public function color(){ return $this->_color; }
	public function is_admin(){ return $this->_is_admin; }
	public function is_owner(){ return $this->_is_owner; }
	public function profile(){ return $this->_profile; }

/*	Setters
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/

	public function set_id( $value ){
		if ( !is_string( $value ) ){ return false; }
		$this->_id = $value;
	}
	public function set_name( $value ){
		if ( !is_string( $value ) ){ return false; }
		$this->_name = $value;
	}
	public function set_deleted( $value ){
		if ( !is_string( $value ) ){ return false; }
		$this->_deleted = $value;
	}
	public function set_color( $value ){
		if ( !is_string( $value ) ){ return false; }
		$this->_color = $value;
	}
	public function set_is_admin( $value ){
		if ( !is_string( $value ) ){ return false; }
		$this->_is_admin = $value;
	}
	public function set_is_owner( $value ){
		if ( !is_string( $value ) ){ return false; }
		$this->_is_owner = $value;
	}
	public function set_profile( $value ){
		if ( !is_array( $value ) ){ return false; }
		$this->_profile = $value;
	}


}