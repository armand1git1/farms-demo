<?php
if (!defined('MAINFILE_INCLUDED'))
{
  die('You cannot access this file directly !');exit;
}

$global['site_name']              = 'Farms demo';
$global['script_name']            = basename($_SERVER['SCRIPT_NAME']);
$global['upload_path']            = './images';
$global['entry_display_per_page'] = 20;

$global['admin_pages']            = array('admin','users','settings');
$global['time_offset']            = 0;
//$global['api_url']                = "https://api-wtm.konguem.eu";
//$global['api_url']                = "https://api.walkap.net";
//$global['api_url']                = "http://127.0.0.1:8080";
// Online 
$global['api_url']                 = "http://84.249.7.85";

// directory settings
define('CORE_DIR', './core/');
define('TEMPLATE_DIR', './templates/');
define('MODEL_DIR', CORE_DIR . 'model/');

// database tables name
define('TABLE_USERS', 'users');
define('TABLE_WEB_SETTINGS', 'web_settings');

// some configurations
define('CALCULATE_IMAGE_SIZE', true);
?>