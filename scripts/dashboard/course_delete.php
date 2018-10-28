<?php require_once '../core/init.php'; ?>
<?php
  if(!isset($_GET['courseid'])){
    redirectTo('course_allocation.php');
  }
  $id = intval($_GET['courseid']);
    $delete = $admin->deleteCourse($id);
    if($delete){
      $session->message('Course deleted successfully');
      redirectTo('course_allocation.php');
    }
 ?>
