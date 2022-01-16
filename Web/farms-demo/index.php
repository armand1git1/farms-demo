<?php

// for testing purpose 05.2021
require __DIR__ . '/vendor/autoload.php';


define('MAINFILE_INCLUDED',1);

include('common.php');


if($global['module'] == 'logout')
{
  if (session_status() != PHP_SESSION_NONE) {   
    session_destroy();
    redirectTo('index.php');
  }
}
// No session for TouchScreen
if(($global['script_name']=='index.php') || ($global['script_name']=='login.php'))
{
  if (session_status() != PHP_SESSION_NONE) {   
    session_destroy();
  }
}


if($global['module'] && file_exists(MODEL_DIR . $global['module'] . '.class.php'))
{
  require_once(MODEL_DIR . $global['module'] . '.class.php');
}

if($global['script_name'] && file_exists(CORE_DIR . $global['script_name']))
{
  require_once(CORE_DIR . $global['script_name']);
}

include('template.php');
?>
