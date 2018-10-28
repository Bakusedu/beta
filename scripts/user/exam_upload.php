<?php
include '../core/init.php';
//process AJAX request
$data = array();
$error = array();
  //prepare to insert into the database))
  if(isset($_POST['exam_score'])){
    $exam_score = $_POST['exam_score'];
    if($_POST['exam_score'] > 70){
      $error = 'field greater than max';
    }
  }

  if(!empty($error)){
    $data['success'] = false;
    $data['message'] = $error;
  }
  else{
    $result = $lecturer->updateExam($_SESSION['studentid'],$_SESSION['courseid'],$exam_score);
    var_dump($result);
    if($result){
      $data['success'] = true;
      $data['message'] = 'Record uploaded successfully!';
    }
    else{
      $data['success'] = false;
      $data['errors'] = 'Data of student failed to upload!';
    }

  }

 echo json_encode($data);
