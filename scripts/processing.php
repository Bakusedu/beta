<?php
  include 'core/init.php';
  restricted();
  $total = 0;

    $register = $_POST['courseid'];
    foreach ($register as $value) {
      $result = $student->getCredithrs($value);

      $total = $total + $result;
    }
    if($total < 21 || $total > 24){
      redirectTo('register_courses.php');
    }
    else{
      foreach ($register as $key) {
        $result = $student->getLecturerid($key);
        $results = $student->insertCourses($key,$_SESSION['us3rid'],$result);
        redirectTo('success_registered.php');

      }

    }

 ?>
