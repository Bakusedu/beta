<?php
 require_once '../core/init.php';

 if(!isset($_GET['courseid']) || !isset($_GET['lecturerid'])){
   redirectTo('lecturer_allocate.php');
 }
 $courseid = intval($_GET['courseid']);
 $lecturerid = intval($_GET['lecturerid']);

 $result = $admin->allocateCourse($lecturerid,$courseid);
 if($result){
   redirectTo('course_allocation.php');
 }
