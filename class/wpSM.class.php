<?php

class wpSM extends wpSM_common {
/*	Proprieties
-------------------------- */
	private $_connect;

/*	Construct
-------------------------- */
	function __construct(){
		parent::__construct();
		add_action( 'plugins_loaded', array( $this, 'load_text_domain' ) );

		$this->_connect = new wpSM_connect;
		$this->_connect->hook_add_connect();
	}

/*	Methods
-------------------------- */
	public function load_text_domain(){
		load_plugin_textdomain( 'wpSlackManager', false, dirname( parent::get_PLUGIN_PATH() . 'lang/' ) );
	}


}