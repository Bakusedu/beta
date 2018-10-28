<?php
include 'core/init.php';
//process AJAX request
$data = array();
  //prepare to insert into the database))
  if(isset($_POST['courseid'])){
    $courseid = $_POST['courseid'];
  }

  $result = $lecturer->deleteAssessment($_SESSION['studentid'],$courseid);
  if($result){
    $data['success'] = true;
    $data['message'] = 'Record deleted successfully!';
  }
  else{
    $data['success'] = false;
    $data['errors'] = 'Data of student failed to delete!';
  }

 echo json_encode($data);
