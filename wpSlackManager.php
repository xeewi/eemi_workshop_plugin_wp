<?php
/**
* Plugin Name: wpSlackManager
* Plugin URI: https://github.com/xeewi/eemi_workshop_plugin_wp
* Description: Manage your Slack team from your WordPress dashboard
* Version: 0.1
* Author: Xeewi
* Author URI: https://github.com/xeewi/
* License: WTFPL
* Text Domain : wpSlackManager
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if ( ! defined( 'WPINC' ) ) { exit; }

define( 'wpSM_PATH', plugin_dir_path( __FILE__ ) );
define( 'wpSM_URL',  plugins_url( 'wpSlackManager/' ) );

require_once( 'class/wpSlackManager.class.php' );

$manager = new wpSlackManager;

add_action( 'admin_menu', array( $manager, 'admin_main_menu' ) );