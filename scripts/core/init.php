<?php
// Start SESSION
if (!isset($_SESSION)) {
  session_start();
}
  include 'class/studentclass.php';
  include '/class/sessions.class.php';
  include './db/connect.php';
  include 'functions.php';
  include 'class/resizeimage.class.php';
  include 'class/photograph.class.php';
  include 'class/lecturer.class.php';
  $student = new Student();
  $session = new Session();
  $resize = new Resizeimage();
  $photo = new Photograph();
  $lecturer = new Lecturer();

  $errrors = array();

  $message = $session->message();

 ?>
