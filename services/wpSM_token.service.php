<?php 

/*	
	Token service
	wpSlackManager
*/

require_once( 'wpSM.service.php' );

class wpSM_token_service extends wpSM_service {

	private $_table_name;

	public function __construct() {	
		global $wpdb;
		$this->_set_table_name( $wpdb->prefix . 'wpsm_token' );
		$this->_create_table();
	}

/*	Getters
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function table_name(){
		return $this->_table_name;
	}

/*	Setters
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	private function _set_table_name($value){
		if ( !is_string($value) ) { return false; }
		$this->_table_name = $value;
	}

/*	Get token row by wp_user_ID 
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function get( $token ) {
		if ( get_class( $token ) != "wpSM_token_object" ){ return false; }
		if ( !$token->wp_user_id() ){ return false; }

		global $wpdb;
		$token_row = $wpdb->get_row( 
			$wpdb->prepare( 
				"SELECT * FROM $this->_table_name WHERE wp_user_ID = %d", 
				esc_sql( $token->wp_user_ID() )
			)
		);

		$token->hydrate($token_row);
	}

/*	Get bot user
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function get_bot() {
		global $wpdb;
		
		$token_rows = $wpdb->query( "SELECT bot_id, bot_token FROM $this->_table_name WHERE bot_id IS NOT NULL"	);
		if ( $token_rows == 1 ) { return false; }
		return $token_rows;
	}

/*	HTTP GET request for access_token to Slack
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function get_access( $token ){
		if ( get_class( $token ) != "wpSM_token_object" ){ return false; }
		if ( !$token->client_id() ){ return false; }
		if ( !$token->client_secret() ){ return false; }
		if ( !$token->code() ){ return false; }
		
		$url = parent::$slack_uri . 'oauth.access?client_id=' . $token->client_id() . '&client_secret=' . $token->client_secret() . '&code=' . $token->code();

		$response = wp_remote_get( $url );
		$json = json_decode($response['body']);

		if ( !$json->ok ) { return false; }

		$values = Array(
			'access_token' => $json->access_token,
			'scope'        => $json->scope,
			'user_id'      => $json->user_id,
			'team_id'      => $json->team_id,
		);

		$token->hydrate($values);
	}

/*	Insert new token row
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function add( $token ) {
		if ( get_class( $token ) != "wpSM_token_object" ){ return false; }
		if ( $token->id() ){ return false; }
		if ( !$token->wp_user_ID() ){ return false; }

		global $wpdb;
		$wpdb->insert( $this->_table_name, Array( 'wp_user_ID' => esc_sql( $token->wp_user_ID() ) ) );
		$token->set_id( $wpdb->insert_id );
		$this->get( $token );
	}

/*	Edit token row
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function edit( $token ) {
		if ( get_class( $token ) != "wpSM_token_object" ){ return false; }
		if ( !$token->id() ){ return false; }

		global $wpdb;

		$sql = Array();

		if ( $token->wp_user_ID() ) { 
			$sql['wp_user_ID'] = esc_sql( $token->wp_user_ID() ); 
		}
		if ( $token->user_id() ) {
			$sql['user_id'] = esc_sql( $token->user_id() );
		} else { $sql['user_id'] = NULL; }

		if ( $token->team_id() ) { 
			$sql['team_id'] = esc_sql( $token->team_id() ); 
		} else { $sql['team_id'] = NULL; }

		if ( $token->access_token() ) { 
			$sql['access_token'] = esc_sql( $token->access_token() ); 
		} else { $sql['access_token'] = NULL; }

		if ( $token->scope() ) { 
			$sql['scope'] = esc_sql( $token->scope() ); 
		} else { $sql['scope'] = NULL; }

		if ( $token->client_id() ) { 
			$sql['client_id'] = esc_sql( $token->client_id() ); 
		} else { $sql['client_id'] = NULL; }

		if ( $token->client_secret() ) { 
			$sql['client_secret'] = esc_sql( $token->client_secret() ); 
		} else { $sql['client_secret'] = NULL; }

		if ( $token->bot_id() ) { 
			$sql['bot_id'] = esc_sql( $token->bot_id() ); 
		} else { $sql['bot_id'] = NULL; }

		if ( $token->bot_token() ) { 
			$sql['bot_token'] = esc_sql( $token->bot_token() ); 
		} else { $sql['bot_token'] = NULL; }		

		$wpdb->update( $this->_table_name, $sql, Array( "id" => $token->id() ), Array( '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ), Array( '%d' ) );
	}

/*	Delete token row
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function delete( $token ) {
		if ( get_class( $token ) != "wpSM_token_object" ){ return false; }
		if ( !$token->id() ){ return false; }

		global $wpdb;
		$wpdb->delete( $this->_table_name, Array( "id" => esc_sql( $token->id() ) ) );
	}

/*	Create table if not exist
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
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
		  scope text,
		  client_id varchar(255),
		  client_secret varchar(255),
		  bot_id varchar(255),
		  bot_token varchar(255),
		  PRIMARY KEY  (id),
		  FOREIGN KEY (wp_user_ID) REFERENCES " . $wpdb->prefix . "users(ID)
		) $charset_collate;";


		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}
}