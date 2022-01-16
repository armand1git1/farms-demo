<?php
  define('MAINFILE_INCLUDED', 1);
  require_once('includes/function1.php');

  session_start();
  
  unset($_SESSION['token']);
  unset($_SESSION['username']);

  redirectTo('index.php?lang=en');
?>
