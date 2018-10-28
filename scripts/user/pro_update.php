<?php
include 'core/init.php';
//process AJAX request

 $data = array(); //array for success
 $error = array(); //array for errors

//validate the variables


 if(!isset($_POST['attendance'])) {
   $error = 'attendance field required!';
 }
if(!isset($_POST['firsttest'])) {
  $error = 'firsttest field required!';
}
if(!isset($_POST['secondtest'])) {
  $error = 'secondtest field required! '.$_POST['secondtest'];
}
  if($_POST['attendance'] > 5 || $_POST['firsttest'] > 10 || $_POST['secondtest'] > 15){
    $error = 'field greater than max';
  }
var_dump($_POST['attendance']);

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

  $result = $lecturer->updateAssessment($_SESSION['studentid'],$_SESSION['courseid'],$attendance,$firsttest,$secondtest);
  var_dump($result);
  if($result){
    $data['success'] = true;
    $data['message'] = 'Record updated successfully!';
  }
  else{
    $data['success'] = false;
    $data['errors'] = 'Data of student failed to update!';
  }
}

 echo json_encode($data);
