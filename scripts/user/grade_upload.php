<?php
include '../core/init.php';
//process AJAX request
$data = array();
$error = array();
  //prepare to insert into the database))
  if(isset($_POST['grade'])){
    $grade = $_POST['grade'];
  }
  $level = $lecturer->getLevel($_SESSION['courseid']);
  if($grade == 'F'){
    $check = $lecturer->checkFailed($_SESSION['studentid'],$_SESSION['courseid']);
      if($check){
        $update = $lecturer->updateFailed($_SESSION['studentid'],$_SESSION['courseid'],$_SESSION['semester'],$level);
        $result = $lecturer->updateGrade($_SESSION['studentid'],$_SESSION['courseid'],$grade,$_SESSION['semester'],$level);
      }
      else{
        $res = $lecturer->failed_students($_SESSION['studentid'],$_SESSION['us3rid'],$_SESSION['courseid'],$_SESSION['semester'],$level);
        $result = $lecturer->updateGrade($_SESSION['studentid'],$_SESSION['courseid'],$grade,$_SESSION['semester'],$level);
      }
    //start
  }
  else{
    $result = $lecturer->updateGrade($_SESSION['studentid'],$_SESSION['courseid'],$grade,$_SESSION['semester'],$level);
    $check = $lecturer->checkFailed($_SESSION['studentid'],$_SESSION['courseid']);
      if($check){
        $lecturer->deleteFailed($_SESSION['studentid'],$_SESSION['courseid']);
      }
  }
    if($result){
      $data['success'] = true;
      $data['message'] = 'Record uploaded successfully!';
    }
    else{
      $data['success'] = false;
      $data['errors'] = 'Data of student failed to upload!';
    }

 echo json_encode($data);
