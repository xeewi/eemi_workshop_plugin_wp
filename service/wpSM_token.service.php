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
				esc_sql( $object->wp_user_ID() )
			)
		);

		$object->hydrate($token_row);
	}

	public function add( $object ) {
		if ( get_class( $object ) != "wpSM_token_object" ){ return false; }
		if ( $object->id() ){ return false; }
		if ( !$object->wp_user_ID() ){ return false; }

		global $wpdb;
		$wpdb->insert( $this->_table_name, Array( 'wp_user_ID' => esc_sql( $object->wp_user_ID() ) ) );
		$object->set_id( $wpdb->insert_id );
		$this->get( $object );
	}

	public function edit( $object ) {
		if ( get_class( $object ) != "wpSM_token_object" ){ return false; }
		if ( !$object->id() ){ return false; }

		global $wpdb;

		$sql = Array();

		if ( $object->wp_user_ID() ) 	{ $sql['wp_user_ID']    = esc_sql( $object->wp_user_ID() ); }
		if ( $object->access_token() ) 	{ $sql['access_token']  = esc_sql( $object->access_token() ); }
		if ( $object->user_id() ) 		{ $sql['user_id']       = esc_sql( $object->user_id() ); }
		if ( $object->team_id() ) 		{ $sql['team_id']       = esc_sql( $object->team_id() ); }
		if ( $object->scope() ) 		{ $sql['scope']         = esc_sql( $object->scope() ); }
		if ( $object->client_id() ) 	{ $sql['client_id']     = esc_sql( $object->client_id() ); }
		if ( $object->client_secret() ) { $sql['client_secret'] = esc_sql( $object->client_secret() ); }

		$wpdb->update( $this->_table_name, $sql, Array( "id" => $object->id() ) );
	}

	public function delete( $object ) {
		if ( get_class( $object ) != "wpSM_token_object" ){ return false; }
		if ( !$object->id() ){ return false; }

		global $wpdb;
		$wpdb->delete( $this->_table_name, Array( "id" => esc_sql( $object->id() ) ) );
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