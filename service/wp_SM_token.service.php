<?php 

class wpSM_token_service {

	private $_table_name;

	public function __construct() {	
		global $wpdb;
		$this->_table_name = $wpdb->prefix . 'wpsm_token';
	}

	public function get_token($object) {

	}

	public function create_table() {
		
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();
		
		$sql = "CREATE TABLE IF NOT EXIST $this->_table_name (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  user_id mediumint(9) NOT NULL,
		  access_token varchar(255) NOT NULL,
		  scope varchar(255) NOT NULL,
		  team_id varchar(255) NOT NULL
		  PRIMARY KEY  (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}
}