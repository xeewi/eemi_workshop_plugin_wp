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

// Common part
require_once( 'class/wpSM_common.class.php' );

// Connection module
require_once( 'class/wpSM_connect.class.php' );

// Final module
require_once( 'class/wpSM.class.php' );

$manager = new wpSM;