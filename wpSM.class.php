<?php

/*	wpSlackManager Plugin */

require_once( WP_PLUGIN_DIR . '/wpSlackManager/modules/wpSM_token.module.php' );

class wpSM {

	private $_token;
	private $_modules;

	public function __construct(){
		// Init all modules
		$this->_modules = Array(
			'token' => new wpSM_token,
		);
	}

/*	Getters
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function token(){
		return $this->_token;
	}

/*	Setters
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function set_token(){
		$this->_token = $this->_modules['token']->get();
	}

/*	Scripts
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function add_scripts(){
		wp_enqueue_style( 'wpSM_fonts', WP_PLUGIN_URL . "/wpSlackManager/asset/css/wpSM.fonts.css", false );
		wp_enqueue_style( 'wpSM', WP_PLUGIN_URL . "/wpSlackManager/asset/css/wpSM.css", false );
	}

/*	Init
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function init(){
		add_action( 'admin_enqueue_scripts', Array( $this, "add_scripts" ) );
		$this->init_admin();
	}

	// Init admin module
	public function init_admin(){
		if ( !current_user_can("administrator") ) { return false; }
		
		$this->set_token();

		if ( $this->_token->access_token() ) {
			$this->dashboard();
		} else {
			$this->auth();
		}
	}

/*	Auth
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	// Init auth
	public function auth(){
		add_action( 'admin_menu', Array( $this, 'auth_menu_auth' ) );
		add_action( 'admin_post_add_clients_discnt', Array( $this, 'auth_add_clients' ) );
	}

	// Add pages
	public function auth_menu_auth(){
		if ( isset( $_GET['page'] ) && isset( $_GET['code'] ) && $_GET['page'] == "wpsm.auth" ) {
			$this->auth_user( $_GET['code'] );
			return false;
		}

		add_menu_page( __('Disconnected : Slack Manager', 'wpSlackManager'), 
			'Slack Manager', 
			'administrator', 
			'wpsm.auth', 
			Array( $this, "auht_home" ), 
			plugins_url( '/wpSlackManager/asset/img/icon-menu.svg' ) 
		);
	}

	// Auth config page
	public function auht_home(){
		if ( isset($_GET['error']) && $_GET['error'] == "post" ) { $post_error = true; }
		if ( isset($_GET['error']) && $_GET['error'] == "access_denied" ) { $access_error = true; }
		if ( isset($_GET['success']) && $_GET['success'] == "post" ) { $post_success = true; }
		
		require_once( WP_PLUGIN_DIR . '/wpSlackManager/views/auth.home.php' );
	}

	// Add clients post (Step 3)
	public function auth_add_clients(){
		if ( !isset( $_POST ) ||
			 !isset( $_POST[ 'client_id' ] ) ||
			 !isset( $_POST[ 'client_secret' ] ) ) {
			wp_redirect( "admin.php?page=wpsm.auth&error=post" );
			exit;
		}

		$this->_modules[ 'token' ]->edit_clients( $this->_token, $_POST[ "client_id" ], $_POST["client_secret"] );
		wp_redirect( "admin.php?page=wpsm.auth&success=post" );
		exit;
	}

	// Auth user (Step 4)
	public function auth_user( $code ){
		
		$this->_modules['token']->edit_access( $this->_token, $code );
		
		if ( !$this->_token->access_token() ) {
			wp_redirect( "admin.php?page=wpsm.auth&error=access_denied" );
			exit;
		}

		wp_redirect( "admin.php?page=wpsm.dashboard" );
		exit;
	}

/*	Dashboard
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	public function dashboard(){
		var_dump( "connected" );
	}

}