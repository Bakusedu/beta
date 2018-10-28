<?php

class Admin {
  private $database;
  public $name,$email,$department,$gender,$password,$id,$level,$coursename,$coursecode,$semester,$credithrs,$regnum;

  public function __construct(){
    $this->database = new Connect();
    $this->database=$this->database->connect();
  }
  public function create(){
    $statement = $this->database->prepare("INSERT INTO lecturers (name,department,gender,email,password) VALUES (?,?,?,?,?)");
    $statement->bindParam(1,$this->name);
    $statement->bindParam(2,$this->department);
    $statement->bindParam(3,$this->gender);
    $statement->bindParam(4,$this->email);
    $statement->bindParam(5,$this->password);
    $result = $statement->execute();
    return $result ? $this->database->lastInsertId() : false;
  }
  public function getLecturers($semester){
    $statement = $this->database->prepare("SELECT lecturers.Name,lecturers.department,lecturers.email,lecturers.gender,
      course.lecturerid FROM lecturers INNER JOIN course ON lecturers.id = course.lecturerid WHERE semester = :semester
      GROUP BY course.lecturerid ");
    $results = $statement->execute(array("semester" => $semester));
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $results ? $results : false;
  }
  public function getLecturer($id){
    $statement = $this->database->prepare("SELECT lecturers.Name,lecturers.department,lecturers.email,lecturerinfo.pictureid,lecturerinfo.photo
       FROM lecturers INNER JOIN lecturerinfo ON lecturers.id = lecturerinfo.pictureid WHERE lecturers.id = :id");
    $result = $statement->execute(array("id" => $id));
    $result = $statement->fetch();
    return $result ? $result : false;
  }
  public function getCourseCount($id,$semester){
    $statement = $this->database->prepare("SELECT COUNT(*) FROM course WHERE lecturerid = :id AND semester = :semester");
    $result = $statement->execute(array("id" => $id,"semester" => $semester));
    $result = $statement->fetch();
    return $result ? $result['COUNT(*)'] : false;
  }
  public function getSemester(){
    $statement = $this->database->prepare("SELECT semester FROM semester");
    $result = $statement->execute();
    $result = $statement->fetch();
    return $result ? $result['semester'] : false;
  }
  public function getCourseName($id,$semester){
    $statement = $this->database->prepare("SELECT name,coursecode FROM course WHERE lecturerid = :id AND semester = :semester");
    $result = $statement->execute(array("id" => $id,"semester" => $semester));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result ? $result : false;
  }
  public function selectCourse(){
    $statement = $this->database->prepare("SELECT * FROM course WHERE id =:id AND semester =:semester");
    $result = $statement->execute(array("id" => $this->id,"semester" => $this->semester));
    $result = $statement->fetch();
    return $result ? $result : false;
  }
  public function getLecturerInfo($id){
    $statement = $this->database->prepare("SELECT Name,department,email FROM lecturers WHERE id =:id");
    $result = $statement->execute(array("id" => $id));
    $result = $statement->fetch();
    return $result ? $result : false;
  }
  public function getStudentInfo($id){
    $statement = $this->database->prepare("SELECT name,department,regnum,gender,email FROM users WHERE id =:id");
    $result = $statement->execute(array("id" => $id));
    $result = $statement->fetch();
    return $result ? $result : false;
  }
  public function getLPicture($id){
    $statement = $this->database->prepare("SELECT photo FROM lecturerinfo WHERE pictureid =:id");
    $statement->execute(array("id" => $id));
    $result = $statement->fetch();
    if($result){
      return $result['photo'];
    }
  }
  public function getSPicture($id){
    $statement = $this->database->prepare("SELECT photo FROM studentinfo WHERE pictureid =:id");
    $statement->execute(array("id" => $id));
    $result = $statement->fetch();
    if($result){
      return $result['photo'];
    }
  }
  public function updateLecturer(){
    $statement = $this->database->prepare("UPDATE lecturers SET Name = ?, email = ?, department = ?, gender = ? WHERE id = ?");
    $statement->bindParam(1,$this->name);
    $statement->bindParam(2,$this->email);
    $statement->bindParam(3,$this->department);
    $statement->bindParam(4,$this->gender);
    $statement->bindParam(5,$this->id);
    $result = $statement->execute();
    return $result ? true : false;
  }
  public function updateStudent(){
    $statement = $this->database->prepare("UPDATE users SET name = ?, email = ?,regnum =?, gender = ? WHERE id = ?");
    $statement->bindParam(1,$this->name);
    $statement->bindParam(2,$this->email);
    $statement->bindParam(3,$this->regnum);
    $statement->bindParam(4,$this->gender);
    $statement->bindParam(5,$this->id);
    $result = $statement->execute();
    return $result ? true : false;
  }
  public function deleteLecturer(){
    $statement = $this->database->prepare("DELETE FROM lecturers WHERE id = ?");
    $statement->bindParam(1,$this->id);
    $result = $statement->execute();
    return $result ? true : false;
  }
  public function deleteStudent(){
    $statement = $this->database->prepare("DELETE FROM users WHERE id = ?");
    $statement->bindParam(1,$this->id);
    $result = $statement->execute();
    return $result ? true : false;
  }
  public function deleteLPic(){
    $statement = $this->database->prepare("DELETE FROM lecturerinfo WHERE pictureid = ?");
    $statement->bindParam(1,$this->id);
    $result = $statement->execute();
    return $result ? true : false;
  }
  public function deleteSPic(){
    $statement = $this->database->prepare("DELETE FROM studentinfo WHERE pictureid = ?");
    $statement->bindParam(1,$this->id);
    $result = $statement->execute();
    return $result ? true : false;
  }
  public function deleteCourse($id){
    $statement = $this->database->prepare("DELETE FROM course WHERE id = ?");
    $statement->bindParam(1,$id);
    $result = $statement->execute();
    return $result ? true : false;
  }
  public function getCourse($semester,$level){
    $statement = $this->database->prepare("SELECT * FROM course WHERE semester = ? AND level = ?");
    $statement->bindParam(1,$semester);
    $statement->bindParam(2,$level);
    $result = $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result ? $result : false;
  }
  public function updateSemester($semester){
    $statement = $this->database->prepare("UPDATE semester SET semester = :semester");
    $result = $statement->execute(array("semester" => $semester));
    return $result ? true : false;
  }
  public function getAllLecturers(){
    $statement = $this->database->prepare("SELECT Name,department,email,gender,id FROM lecturers");
    $result = $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result ? $result : false;
  }
  public function allocateCourse($lecturerid,$courseid){
    $statement = $this->database->prepare("UPDATE course SET lecturerid = :lecturerid WHERE id = :courseid");
    $result = $statement->execute(array("lecturerid" => $lecturerid,"courseid" => $courseid));
    return $result ? true : false;
  }
  public function updateCourse(){
    $statement = $this->database->prepare("UPDATE course SET name =?,credithrs=?,semester=?,level=?,coursecode=? WHERE id =?");
    $statement->bindParam(1,$this->coursename);
    $statement->bindParam(2,$this->credithrs);
    $statement->bindParam(3,$this->semester);
    $statement->bindParam(4,$this->level);
    $statement->bindParam(5,$this->coursecode);
    $statement->bindParam(6,$this->id);
    $result = $statement->execute();
    return $result ? true : false;
  }
  public function createLecturerInfo($id){
    $statement = $this->database->prepare("INSERT INTO lecturerinfo (pictureid) VALUES(?)");
    $statement->bindParam(1,$id);
    $result = $statement->execute();
    return $result ? true : false;
  }
  public function createStudent(){
    $statement = $this->database->prepare("INSERT INTO users (name,regnum,email,level,department,gender,passwords) VALUES(?,?,?,?,?,?,?)");
    $statement->bindParam(1,$this->name);
    $statement->bindParam(2,$this->regnum);
    $statement->bindParam(3,$this->email);
    $statement->bindParam(4,$this->level);
    $statement->bindParam(5,$this->department);
    $statement->bindParam(6,$this->gender);
    $statement->bindParam(7,$this->password);
    $result = $statement->execute();
    return $result ? $this->database->lastInsertId() : false;
  }
  public function createStudentInfo($id){
    $statement = $this->database->prepare("INSERT INTO studentinfo (pictureid) VALUES(?)");
    $statement->bindParam(1,$id);
    $result = $statement->execute();
    return $result ? true : false;
  }
  public function getCourseid($id){
    $statement = $this->database->prepare("SELECT lecturerid FROM course WHERE lecturerid = :cid");
    $result = $statement->execute(array("cid" => $id));
    $result = $statement->fetch();
    return $result ? $result['lecturerid'] : false;
  }
  public function createCourse(){
    $statement = $this->database->prepare("INSERT INTO course (name,credithrs,semester,level,coursecode) VALUES (?,?,?,?,?)");
    $statement->bindParam(1,$this->coursename);
    $statement->bindParam(2,$this->credithrs);
    $statement->bindParam(3,$this->semester);
    $statement->bindParam(4,$this->level);
    $statement->bindParam(5,$this->coursecode);
    $result = $statement->execute();
    return $result ? true : false;
  }
  public function getStudents($level){
    $statement = $this->database->prepare("SELECT id,name,regnum,email,department,gender FROM users WHERE level=:level");
    $results = $statement->execute(array("level" => $level));
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $results ? $results : false;
  }
  public function getStudent(){
    $statement = $this->database->prepare("SELECT users.id,users.name,users.regnum,users.level,users.email,users.department,users.gender,studentinfo.photo FROM users INNER JOIN studentinfo
    ON users.id = studentinfo.pictureid WHERE studentinfo.pictureid = ?");
    $statement->bindParam(1,$this->id);
    $result = $statement->execute();
    $result = $statement->fetch();
    return $result ? $result : false;
  }

}
 ?>
