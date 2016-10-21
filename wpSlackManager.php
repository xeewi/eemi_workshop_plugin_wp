<?php
/**
* Plugin Name: wpSlackManager
* Plugin URI: https://github.com/xeewi/eemi_workshop_plugin_wp
* Description: Manage your Slack team from your WordPress dashboard
* Version: 0.4
* Author: Xeewi
* Author URI: https://github.com/xeewi/
* License: WTFPL
* Text Domain : wpSlackManager
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if ( ! defined( 'WPINC' ) ) { exit; }

require_once( 'wpSM.class.php' );

$manager = new wpSM;

add_action( 'init', Array( $manager, "init" ) );