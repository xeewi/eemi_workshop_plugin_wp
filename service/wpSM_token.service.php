<?php 

class wpSM_token_service {

	private $_table_name;

	public function __construct() {	
		global $wpdb;
		$this->_set_table_name( $wpdb->prefix . 'wpsm_token' );
		$this->_create_table();
	}

	public function table_name(){
		return $this->_table_name;
	}

	private function _set_table_name($value){
		if ( !is_string($value) ) { return false; }
		$this->_table_name = $value;
	}

	public function get( $object ) {
		if ( get_class( $object ) != "wpSM_token_object" ){ return false; }
		if ( !$object->wp_user_id() ){ return false; }

		global $wpdb;
		$token_row = $wpdb->get_row( 
			$wpdb->prepare( 
				"SELECT * FROM $this->_table_name WHERE wp_user_ID = %d", 
				$object->wp_user_ID()
			)
		);

		$object->hydrate($token_row);
	}

	public function add( $object ) {
		if ( get_class( $object ) != "wpSM_token_object" ){ return false; }
		if ( $object->id() ){ return false; }
		if ( !$object->wp_user_ID() ){ return false; }

		global $wpdb;
		$wpdb->insert( $this->_table_name, Array( 'wp_user_ID' => $object->wp_user_ID() ) );
		$object->set_id( $wpdb->insert_id );
		$this->get( $object );
	}

	public function edit( $object ) {
		if ( get_class( $object ) != "wpSM_token_object" ){ return false; }
		if ( !$object->id() ){ return false; }

		global $wpdb;
		$wpdb->update( $this->_table_name, Array(
			"wp_user_ID" => $object->wp_user_ID(),
			"access_token" => $object->access_token(),
			"user_id" => $object->user_id(),
			"team_id" => $object->team_id(),
			"scope" => $object->scope(),
			"client_id" => $object->client_id(),
			"client_secret" => $object->client_secret()
		), Array( "id" => $object->id() ) );
	}

	public function delete( $object ) {
		if ( get_class( $object ) != "wpSM_token_object" ){ return false; }
		if ( !$object->id() ){ return false; }

		global $wpdb;
		$wpdb->delete( $this->_table_name, Array( "id" => $object->id() ) );
	}

	private function _create_table() {
		
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();
		
		$sql = "
		CREATE TABLE IF NOT EXISTS $this->_table_name (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  wp_user_ID bigint(20) UNSIGNED NOT NULL,
		  user_id varchar(255),
		  team_id varchar(255),
		  access_token varchar(255),
		  scope varchar(255),
		  client_id varchar(255),
		  client_secret varchar(255),
		  PRIMARY KEY  (id),
		  FOREIGN KEY (wp_user_ID) REFERENCES " . $wpdb->prefix . "users(ID)
		) $charset_collate;";


		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}
}