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

require('class/wpSM_token.class.php');
require('service/wp_SM_token.service.php');

$token_service = new wpSM_token_service; 
$token = new wpSM_token;
