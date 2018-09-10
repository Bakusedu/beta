<?php

class Lecturer {
  private $database;
  public $name,$email,$course,$department,$gender,$password,$id;

  public function __construct(){
    $this->database = new Connect();
    $this->database=$this->database->connect();
  }
  public function getCourse($id,$semester){
    $statement = $this->database->prepare("SELECT * FROM course WHERE lecturerid =:id AND semester =:semester");
    $statement->execute(array("id" => $id,"semester" => $semester));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result ? $result : false;
  }
  public function registeredStudents($courseid,$id){
    $statement = $this->database->prepare("SELECT * FROM `registeredcourses` LEFT JOIN `users` ON registeredcourses.studentid = users.id LEFT JOIN `studentinfo`  ON users.id = studentinfo.pictureid WHERE courseid =:courseid AND lecturerid =:lecturerid");
    $result = $statement->execute(array("courseid" => $courseid,"lecturerid" => $id));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result ? $result : false;
  }
  public function count($courseid,$id){
    $statement = $this->database->prepare("SELECT * FROM `registeredcourses` LEFT JOIN `users` ON registeredcourses.studentid = users.id LEFT JOIN `studentinfo`  ON users.id = studentinfo.pictureid WHERE courseid =:courseid AND lecturerid =:lecturerid");
    $result = $statement->execute(array("courseid" => $courseid,"lecturerid" => $id));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result ? $result : false;
  }
  public function getName($id){
    $statement = $this->database->prepare("SELECT * FROM course WHERE id =:id");
    $statement->execute(array("id" => $id));
    $result = $statement->fetch();
    return $result ? $result : false;
  }
}
 ?>
