<?php 

class wpSM_token_service {

	private $_table_name;

	public function __construct() {	
		global $wpdb;
		$this->_table_name = $wpdb->prefix . 'wpsm_token';
	}

	public function get($object) {
		if ( get_class($object) != "wpSM_token_object" ){ return false; }
		
		$this->_create_table();
		
		global $wpdb;
		$token_row = $wpdb->get_row( 
			$wpdb->prepare( 
				"SELECT * FROM $this->_table_name WHERE user_id = %s", 
				$object->user_id() 
			)
		);
		$object->hydrate($token_row);
	}

	private function _create_table() {
		
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();
		
		$sql = "
		CREATE TABLE IF NOT EXISTS $this->_table_name (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  user_id bigint(20) UNSIGNED NOT NULL,
		  access_token varchar(255) NOT NULL,
		  scope varchar(255) NOT NULL,
		  team_id varchar(255) NOT NULL,
		  PRIMARY KEY  (id),
		  FOREIGN KEY (user_id) REFERENCES " . $wpdb->prefix . "users(ID)
		) $charset_collate; ";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}
}