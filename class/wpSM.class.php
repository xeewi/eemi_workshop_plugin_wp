<?php

require_once( 'wpSM_token.class.php' );

class wpSM {

	private $_token;
	
	public $modules;

	public function __construct(){
		$this->modules = Array(
			'token' => new wpSM_token,
		);
	}

	public function token(){
		return $this->_token;
	}

	public function set_token(){
		$this->_token = $this->modules['token']->get();
	}

	public function add_scripts(){
		wp_enqueue_style( 'wpSM_fonts', WP_PLUGIN_URL . "/wpSlackManager/asset/css/wpSM.fonts.css", false );
		wp_enqueue_style( 'wpSM', WP_PLUGIN_URL . "/wpSlackManager/asset/css/wpSM.css", false );
	}


	public function init(){
		if ( !current_user_can("administrator") ) { return false; }

		$this->set_token();

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
		add_action( 'admin_post_add_clients_discnt', Array( $this, 'add_clients_discnt' ) );
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
			'wpsm.return_uri', 
			Array( $this, "return_discnt" ) );
	}

	public function home_discnt(){
		
		if ( isset($_GET['error']) && $_GET['error'] == "post" ) { $post_error = true; }
		
		require_once( WP_PLUGIN_DIR . '/wpSlackManager/views/disconnected.home.php' );
	}

	public function return_discnt(){
		var_dump($this->_token);
	}

	public function add_clients_discnt(){
		var_dump($_POST);
		wp_redirect( "admin.php?page=wpsm.disconnected.home&error=post" );
		exit;
	}

}