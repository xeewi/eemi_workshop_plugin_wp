<?php

require_once( 'wpSM_token.class.php' );

class wpSM {

	private $_token;
	
	public $modules;

	public function __construct(){
		
		$this->modules = Array(
			'token' => new wpSM_token,
		);

		add_action( 'wp_loaded', Array( $this, "wp_loaded" ) );
	}

	public function wp_loaded(){
		
		$this->_token = $this->modules[ 'token' ]->get();

		if ( $this->_token->access_token() ) {
			$this->connected();
		} else {
			$this->disconnected();
		}

	}

	public function connected(){
		var_dump( "connected" );
	}

	public function disconnected(){
		add_action( 'admin_menu', Array( $this, 'menu_discnt' ) );
	}

	public function menu_discnt(){
		add_menu_page( __('Disconnected : Slack Manager', 'wpSlackManager'), 
			'Slack Manager', 
			'administrator', 
			'wpsm.disconnected.home', 
			Array( $this, "home_discnt" ), 
			plugins_url( '/wpSlackManager/asset/img/icon-menu.svg' ) 
		);

		add_submenu_page( null, 
			__( 'Return : Slack Manager', 'wpSlackManager' ),
			__( 'Return', 'wpSlackManager' ), 
			'administrator', 
			'wpsm.disconnected.return', 
			Array( $this, "return_discnt" ) );
	}

	public function home_discnt(){
		require_once( WP_PLUGIN_DIR . '/wpSlackManager/views/disconnected.home.php' );
	}

	public function return_discnt(){
		var_dump($this->_token);
	}
}