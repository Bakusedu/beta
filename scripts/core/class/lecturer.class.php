<?php

class Lecturer {
  private $database;
  public $name,$email,$course,$department,$gender,$password,$id,$photo;

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
    $statement = $this->database->prepare("SELECT COUNT(*) FROM `registeredcourses` LEFT JOIN `users` ON registeredcourses.studentid = users.id LEFT JOIN `studentinfo`  ON users.id = studentinfo.pictureid WHERE courseid =:courseid AND lecturerid =:lecturerid");
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
  public function updateAssessment($id,$courseid,$attendance,$firsttest,$secondtest) {
    $statement = $this->database->prepare("UPDATE student_assessment SET attendance = :attendance,firsttest = :firsttest,secondtest = :secondtest WHERE stud_id = :id AND course_id = :courseid");
    $result = $statement->execute(array("id" => $id,"courseid"=>$courseid,"attendance" => $attendance, "firsttest" => $firsttest, "secondtest" => $secondtest));
    return $result ? true : false;
  }
  public function updateExam($id,$courseid,$examscore) {
    $statement = $this->database->prepare("UPDATE student_assessment SET exam_score = :examscore WHERE stud_id = :id AND course_id = :courseid");
    $result = $statement->execute(array("id" => $id,"courseid"=>$courseid,"examscore" => $examscore));
    return $result ? true : false;
  }
  public function deleteAssessment($id,$courseid){
    $statement = $this->database->prepare("DELETE FROM student_assessment  WHERE stud_id = :id AND course_id = :courseid");
    $result = $statement->execute(array("id" => $id,"courseid"=>$courseid));
    return $result ? true : false;
  }
  public function updateGrade($id,$courseid,$grade,$semester,$level) {
    $statement = $this->database->prepare("UPDATE student_assessment SET grade = :grade,priviledges = :priviledges,sem = :semester,year = :level WHERE stud_id = :id AND course_id = :courseid");
    $result = $statement->execute(array("id" => $id,"courseid"=>$courseid,"grade" => $grade,"priviledges" => 'access',"semester" => $semester,"level" => $level));
    return $result ? true : false;
  }
  public function checkGrade($id,$courseid) {
    $statement = $this->database->prepare("SELECT grade FROM student_assessment WHERE stud_id = :id AND course_id = :courseid");
    $result = $statement->execute(array("id" => $id,"courseid"=>$courseid));
    $result = $statement->fetch();
    return $result ? $result : false;
  }
  public function failed_students($studentid,$lecturerid,$courseid,$semester){
    $statement = $this->database->prepare("INSERT INTO failed_students(stud_id,lecturer_id,course_id,semester) VALUES
    (?,?,?,?)");
    $statement->bindParam(1,$studentid);
    $statement->bindParam(2,$lecturerid);
    $statement->bindParam(3,$courseid);
    $statement->bindParam(4,$semester);
    $result = $statement->execute();

    return $result ? true : false;
  }
  public function checkfailed($id,$courseid) {
    $statement = $this->database->prepare("SELECT stud_id FROM failed_students WHERE stud_id = :id AND course_id = :courseid");
    $result = $statement->execute(array("id" => $id,"courseid"=>$courseid));
    $result = $statement->fetch();
    return $result ? true : false;
  }
  public function getLevel($courseid) {
    $statement = $this->database->prepare("SELECT level FROM course WHERE id = :id");
    $result = $statement->execute(array("id" => $courseid));
    $result = $statement->fetch();
    return $result ? $result['level'] : false;
  }
  public function updateFailed($id,$courseid,$semester,$level) {
    $statement = $this->database->prepare("UPDATE failed_students SET stud_id = :id,course_id = :courseid,semester = :semester,year = :level WHERE stud_id = :id AND course_id = :courseid");
    $result = $statement->execute(array("id" => $id,"courseid"=>$courseid,"semester" => $semester,"level" => $level));
    return $result ? true : false;
  }
  public function deleteFailed($id,$courseid) {
    $statement = $this->database->prepare("DELETE FROM failed_students  WHERE stud_id = :id AND course_id = :courseid");
    $result = $statement->execute(array("id" => $id,"courseid"=>$courseid));
  }
  public function lecturerInfo(){
    $statement = $this->database->prepare("SELECT photo FROM lecturerinfo WHERE pictureid =:id");
    $statement->execute(array("id" => $this->id));
    $result = $statement->fetch();
    if($result == NULL){
      $statement = $this->database->prepare("INSERT INTO lecturerinfo (pictureid,photo) VALUES (?,?)");
      $statement->bindParam(1,$this->id);
      $statement->bindParam(2,$this->photo);
      $result = $statement->execute();
      return $result? "INSERTED" : "QE";
    }else{
      $statement = $this->database->prepare("UPDATE lecturerinfo SET photo =:foto WHERE pictureid =:pic_id");
      $result = $statement->execute(array("foto" => $this->photo,"pic_id" => $this->id));
      return $result ? "Updated":"queryError!";
    }
  }
  public function getLPicture(){
    $statement = $this->database->prepare("SELECT photo FROM lecturerinfo WHERE pictureid =:id");
    $statement->execute(array("id" => $this->id));
    $result = $statement->fetch();
    if($result){
      return $result['photo'];
    }else{
      return "user.png";
    }
  }
}
 ?>
