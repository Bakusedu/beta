<?php
include '../core/init.php';
//process AJAX request

 $data = array(); //array for success
 $error = array(); //array for errors

//validate the variables


 if(empty($_POST['attendance'])) {
   $error = 'attendance field required!';
 }
if(empty($_POST['firsttest'])) {
  $error = 'firsttest field required!';
}
if(empty($_POST['secondtest'])) {
  $error = 'secondtest field required! '.$_POST['secondtest'];
}
if($_POST['attendance'] > 5 || $_POST['firsttest'] > 10 || $_POST['secondtest'] > 15){
  $error = 'field greater than max';
}

//Check if errors exist
if(!empty($error)) {
  $data['success'] = false;
  $data['message'] = $error;
}
else{
  $attendance = sanitize('attendance');
  $firsttest = sanitize('firsttest');
  $secondtest = sanitize('secondtest');

  //prepare to insert into the database))

  $result = $student->insertAssessment($_SESSION['studentid'],$_SESSION['us3rid'],$_SESSION['courseid'],$attendance,$firsttest,$secondtest);
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
