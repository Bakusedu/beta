<?php
// Start SESSION
if (!isset($_SESSION)) {
  session_start();
}

// Set application path
define("DS", DIRECTORY_SEPARATOR);
define("APP_ROOT", dirname(dirname(dirname(__FILE__))).DS);

// Link common files
require_once APP_ROOT . '/scripts/db/connect.php';
require_once APP_ROOT . '/scripts/core/functions.php';
require_once APP_ROOT . '/scripts/core/autoload.php';
  $student = new Student();
  $session = new Session();
  $resize = new Resizeimage();
  $photo = new Photograph();
  $lecturer = new Lecturer();
  $admin = new Admin();

  $errrors = array();

  $message = $session->message();

 ?>
