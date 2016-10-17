<?php
/**
* Plugin Name: WpSlackManager
* Plugin URI: https://github.com/xeewi/eemi_workshop_plugin_wp
* Description: Manage your Slack team from your WordPress dashboard
* Version: 0.1
* Author: Xeewi
* Author URI: https://github.com/xeewi/
* License: WTFPL
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if ( ! defined( 'WPINC' ) ) { exit; }

require_once('class/WpSlackManager.class.php');

$manager = new WpSlackManager;

add_action( 'admin_menu', array($manager, 'admin_main_menu') );