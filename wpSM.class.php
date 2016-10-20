<?php

/*	wpSlackManager Plugin */

require_once( WP_PLUGIN_DIR . '/wpSlackManager/modules/wpSM_token.module.php' );
require_once( WP_PLUGIN_DIR . '/wpSlackManager/modules/wpSM_users.module.php' );

class wpSM {

	private $_token;
	private $modules;

	public function __construct(){
		// Init all modules
		$this->modules = Array(
			'token' => new wpSM_token,
			'users' => new wpSM_users,
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
		$this->_token = $this->modules['token']->get();
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
			$this->connected();
		} else {
			$this->auth();
		}
	}

/*	Auth
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	// Init auth
	public function auth(){
		add_action( 'admin_menu', Array( $this, 'auth_menu' ) );
		add_action( 'admin_post_add_clients_discnt', Array( $this, 'auth_add_clients' ) );
	}

	// Add menu pages
	public function auth_menu(){
		if ( isset( $_GET['page'] ) && isset( $_GET['code'] ) && $_GET['page'] == "wpsm.auth" ) {
			$this->auth_user( $_GET['code'] );
			return false;
		}

		add_menu_page( __('Disconnected : Slack Manager', 'wpSlackManager'), 
			'Slack Manager', 
			'administrator', 
			'wpsm.auth', 
			Array( $this, "auth_home" ), 
			plugins_url( '/wpSlackManager/asset/img/icon-menu.svg' ) 
		);
	}

	// Auth config page
	public function auth_home(){
		if ( isset($_GET['error']) && $_GET['error'] == "post" ) { $post_error = true; }
		if ( isset($_GET['error']) && $_GET['error'] == "access_denied" ) { $access_error = true; }
		if ( isset($_GET['success']) && $_GET['success'] == "post" ) { $post_success = true; }
		
		$scopes = "incoming-webhook,commands,bot," .
		"channels:read,channels:write," .
		"chat:write:bot,chat:write:user," .
		"groups:read,groups:write," . 
		"team:read," .
		"users.profile:read,users.profile:write," .
		"users:read,users:write";


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

		$this->modules[ 'token' ]->edit_clients( $this->_token, $_POST[ "client_id" ], $_POST["client_secret"] );
		wp_redirect( "admin.php?page=wpsm.auth&success=post" );
		exit;
	}

	// Auth user (Step 4)
	public function auth_user( $code ){
		
		$this->modules['token']->edit_access( $this->_token, $code );
		
		if ( !$this->_token->access_token() ) {
			wp_redirect( "admin.php?page=wpsm.auth&error=access_denied" );
			exit;
		}

		wp_redirect( "admin.php?page=wpsm.dashboard" );
		exit;
	}


/*	Connected commons
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	// Init connected
	public function connected(){
		add_action( "admin_menu", Array( $this, 'connected_menu' ) );
	}

	// Add menu pages
	public function connected_menu(){
		// Dashboard
		add_menu_page( __('Dashboard : Slack Manager', 'wpSlackManager'), 
			'Slack Manager', 
			'administrator', 
			'wpsm.dashboard', 
			Array( $this, "dashboard_home" ), 
			plugins_url( '/wpSlackManager/asset/img/icon-menu.svg' ) 
		);

		// Users
		add_submenu_page( 'wpsm.dashboard', 
			'Users : Slack manager', 
			__('Users', 'wpSlackManager'), 
			'administrator',
			'wpsm.users', 
			Array( $this, 'users_home' )
		);
	}

/*	Dashboard
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	// Init dashboard
	public function dashboard_home(){
		require_once( WP_PLUGIN_DIR . '/wpSlackManager/views/dashboard.home.php' );
	}

/*	Users
<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>	*/
	// Init users
	public function users_home(){
		$page = "all"; // For menu
		$users = $this->modules['users']->get_list( $this->_token, 1 );

		require_once( WP_PLUGIN_DIR . '/wpSlackManager/views/users.home.php' );
	}

}