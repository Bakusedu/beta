<?php
 require_once '../core/init.php';
  if(!isset($_GET['semester'])){
    redirectTo('settings.php');
  }
  $semester = intval($_GET['semester']);
  $update = $admin->updateSemester($semester);
  if($update){
    redirectTo('settings.php');
  }

 ?>
