<?php
// include './db/connect.php';
class Student {
  private $database;
  public $name,$regnum,$email,$level,$course,$department,$gender,$password,$cpassword,$photo,$id,$message;

  public function __construct(){
    $this->database = new Connect();
    $this->database=$this->database->connect();
  }

    public function insertUser(){
    $statement = $this->database->prepare("INSERT INTO users (name,regnum,email,level,department,gender,password) VALUES (?,?,?,?,?,?,?) ");
    $statement->bindParam(1,$this->name);
    $statement->bindParam(2,$this->regnum);
    $statement->bindParam(3,$this->email);
    $statement->bindParam(4,$this->level);
    $statement->bindParam(5,$this->department);
    $statement->bindParam(6,$this->gender);
    $statement->bindParam(7,$this->password);
    $result = $statement->execute();

    return $result ? true : false;
  }

  public function getStudent(){
    $statement = $this->database->prepare("SELECT * FROM users WHERE regnum = :regnum AND passwords = :password");
    $statement->execute(array("regnum" => $this->regnum , "password" => $this->password));
    $result = $statement->fetch();
    if($result){
      $_SESSION['us3rid'] = $result['id'];
      $_SESSION['regnum'] = $result['regnum'];
      $_SESSION['department'] = $result['department'];
      $_SESSION['level'] = $result['level'];
      $_SESSION['email'] = $result['email'];
      $_SESSION['gender'] = $result['gender'];
      $_SESSION['name'] = $result['name'];
      $_SESSION['priviledges'] = $result['priviledges'];
      return $result;
    }
    else{
      return false;
    }

    }
    public function getLecturer(){
        $statement = $this->database->prepare("SELECT * FROM lecturers WHERE email =:regnum AND password =:password");
        $statement->execute(array("regnum" => $this->regnum , "password" => $this->password));
        $result = $statement->fetch();
        if($result){
          $_SESSION['us3rid'] = $result['id'];
          $_SESSION['name'] = $result['Name'];
          $_SESSION['department'] = $result['department'];
          $_SESSION['email'] = $result['email'];
          $_SESSION['gender'] = $result['gender'];
          $_SESSION['priviledges'] = $result['priviledges'];
          return true;
        }
        else{
          return false;
        }
    }
    public function getAdmin($regnum,$password){
        $statement = $this->database->prepare("SELECT * FROM admin WHERE email =:regnum AND password =:password");
        $statement->execute(array("regnum" => $regnum , "password" => $password));
        $result = $statement->fetch();
        if($result){
          $_SESSION['us3rid'] = $result['id'];
          $_SESSION['name'] = $result['name'];
          $_SESSION['email'] = $result['email'];
          $_SESSION['gender'] = $result['gender'];
          $_SESSION['priviledges'] = $result['priviledges'];
        }
        return $result ? true : false;
    }
    public function loginUser(){
      if($this->getStudent()){
        return true;
      }
      if($this->getLecturer()){
        return true;
      }
      return false;
    }
    public function logout() {
      if (isset($_SESSION['us3rid'])) {
        unset($_SESSION['us3rid']);
        session_destroy();
        return true;
      }
      return false;
    }
    public function updateUser($id,$value1,$value2) {
      $name = $value1;
      $email = $value2;

      if (!isset($id)) {
        redirectTo('dashboard.php');
      }
      $statement = $this->database->prepare("UPDATE users SET name =:name, email =:email WHERE id =:id");
      $result = $statement->execute(array("name" => $name, "email" => $email, "id" => $id));
      return $result ? true : false;
    }
    public function studentInfo(){
      $statement = $this->database->prepare("SELECT photo FROM studentinfo WHERE pictureid =:id");
      $statement->execute(array("id" => $this->id));
      $result = $statement->fetch();
      if($result == NULL){
        $statement = $this->database->prepare("INSERT INTO studentinfo (pictureid,photo) VALUES (?,?)");
        $statement->bindParam(1,$this->id);
        $statement->bindParam(2,$this->photo);
        $result = $statement->execute();
        return $result? "INSERTED" : "QE";
      }else{
        $statement = $this->database->prepare("UPDATE studentinfo SET photo =:foto WHERE pictureid =:pic_id");
        $result = $statement->execute(array("foto" => $this->photo,"pic_id" => $this->id));
        return $result ? "Updated":"queryError!";
      }
    }
    public function getPicture(){
      $statement = $this->database->prepare("SELECT photo FROM studentinfo WHERE pictureid =:id");
      $statement->execute(array("id" => $this->id));
      $result = $statement->fetch();
      if($result){
        return $result['photo'];
      }else{
        return "user.png";
      }
    }
    public function insertMessage(){
    $statement = $this->database->prepare("INSERT INTO messages (name,regnum,message,messageid) VALUES (?,?,?,?) ");
    $statement->bindParam(1,$this->name);
    $statement->bindParam(2,$this->regnum);
    $statement->bindParam(3,$this->message);
    $statement->bindParam(4,$this->messageid);
    $result = $statement->execute();

    return $result ? true : false;
  }
  public function getCredithrs($id){
    $statement = $this->database->prepare("SELECT credithrs FROM course WHERE id =:id");
    $statement->execute(array("id" => $id));
    $result = $statement->fetch();
    return $result ? $result['credithrs'] : false;
  }
  public function getLecturerid($id){
    $statement = $this->database->prepare("SELECT lecturerid FROM course WHERE id =:id");
    $statement->execute(array("id" => $id));
    $result = $statement->fetch();
    return $result ? $result['lecturerid'] : false;
  }

  public function getCourseInformation($level,$semester) {
    $statement = $this->database->prepare("SELECT course.id, lecturers.Name, course.name,course.credithrs,course.lecturerid,course.coursecode
                  FROM course INNER JOIN lecturers ON course.lecturerid=lecturers.id WHERE level =:level AND semester =:semester");
    $result = $statement->execute(array("level" => $level,"semester" => $semester));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result ? $result : false;
  }
  public function insertCourses($courseid,$studentid,$lecturerid){
  $statement = $this->database->prepare("INSERT INTO registeredcourses (courseid,studentid,lecturerid) VALUES (?,?,?,?) ");
  $statement->bindParam(1,$courseid);
  $statement->bindParam(2,$studentid);
  $statement->bindParam(3,$lecturerid);
  $statement->bindParam(4,$semester);
  $result = $statement->execute();

  return $result ? true : false;
}

public function checkRegister($id,$semester){
  $statement = $this->database->prepare("SELECT studentid FROM registeredcourses WHERE studentid =:id AND semester =:semester");
  $statement->execute(array("id" => $id,"semester" => $semester));
  $result = $statement->fetch();
  return $result ? $result['studentid'] : false;
  }
public function viewCourses($id,$semester){
  $statement = $this->database->prepare("SELECT registeredcourses.courseid, registeredcourses.studentid, course.name,course.credithrs,course.coursecode
                FROM registeredcourses INNER JOIN course ON registeredcourses.courseid=course.id WHERE studentid =:id AND registeredcourses.semester =:semester");
  $result = $statement->execute(array("id" => $id,"semester" => $semester));
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  return $result ? $result : false;
  }
  public function insertAssessment($studentid,$lecturerid,$courseid,$attendance,$firsttest,$secondtest){
    $statement = $this->database->prepare("INSERT INTO student_assessment(stud_id,lecturer_id,course_id,attendance,firsttest,secondtest) VALUES
    (?,?,?,?,?,?)");
    $statement->bindParam(1,$studentid);
    $statement->bindParam(2,$lecturerid);
    $statement->bindParam(3,$courseid);
    $statement->bindParam(4,$attendance);
    $statement->bindParam(5,$firsttest);
    $statement->bindParam(6,$secondtest);
    $result = $statement->execute();

    return $result ? true : false;
  }
  public function getInfo($id){
    $statement = $this->database->prepare("SELECT regnum FROM users WHERE id = :id");
    $statement->execute(array("id" => $id));
    $result = $statement->fetch();
    return $result ? $result : 'false';
  }
  public function checkStudent($id,$courseid){
    $statement = $this->database->prepare("SELECT stud_id FROM student_assessment WHERE stud_id = :id AND course_id = :courseid");
    $statement->execute(array("id" => $id,"courseid" => $courseid));
    $result = $statement->fetch();
    return $result ? true : false;
  }
  public function getAssessment($id,$courseid){
    $statement = $this->database->prepare("SELECT * FROM student_assessment WHERE stud_id = :id AND course_id = :courseid");
    $statement->execute(array("id" => $id, "courseid" => $courseid));
    $result = $statement->fetch();
    return $result ? $result : false;
  }
  public function procedure($id,$semester){
    $statement = $this->database->prepare("SELECT * FROM `registeredcourses` LEFT JOIN `course` ON registeredcourses.courseid = course.id WHERE studentid = :id AND registeredcourses.semester =:semester");
    $result = $statement->execute(array("id" => $id,"semester" => $semester));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result ? $result : false;
  }
  public function assessment($courseid,$id){
    $statement = $this->database->prepare("SELECT * FROM `student_assessment` WHERE stud_id = :id AND course_id = :courseid");
    $result = $statement->execute(array("courseid" => $courseid,"id" => $id));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result ? $result : false;
  }
  public function result_available($courseid,$id){
    $statement = $this->database->prepare("SELECT * FROM `student_assessment` WHERE stud_id = :id AND course_id = :courseid");
    $result = $statement->execute(array("courseid" => $courseid,"id" => $id));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result ? $result : false;
  }
  public function record($id,$level,$semester){
    $statement = $this->database->prepare("SELECT student_assessment.course_id, student_assessment.stud_id,student_assessment.grade,student_assessment.priviledges, course.name,course.coursecode,course.credithrs
       FROM student_assessment INNER JOIN course ON student_assessment.course_id=course.id WHERE stud_id = :id AND year = :level AND sem = :semester");
    $result = $statement->execute(array("id" => $id, "level" => $level, "semester" => $semester));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result ? $result : false;
  }
  public function getExamination($id,$courseid){
    $statement = $this->database->prepare("SELECT exam_score FROM student_assessment WHERE stud_id = :id AND course_id = :courseid");
    $statement->execute(array("id" => $id, "courseid" => $courseid));
    $result = $statement->fetch();
    return $result ? $result : false;
  }
  public function getCourseCount($level,$semester){
    $statement = $this->database->prepare("SELECT COUNT(*) AS count FROM course WHERE lecturerid <> 0 AND level =:level AND semester =:semester");
    $result = $statement->execute(array("level" => $level,"semester" => $semester));
    $result = $statement->fetch();
    return $result ? $result['count'] : false;
  }
  public function getCriteria($level,$semester){
    $statement = $this->database->prepare("SELECT credit_load,no_of_courses FROM creditload WHERE level =:level AND semester =:semester");
    $result = $statement->execute(array("level" => $level, "semester" => $semester));
    $result = $statement->fetch();
    return $result ? $result : false;
  }
  public function getCreditload($level,$semester){
    $statement = $this->database->prepare("SELECT credit_load FROM creditload WHERE level =:level AND semester =:semester");
    $result = $statement->execute(array("level" => $level, "semester" => $semester));
    $result = $statement->fetch();
    return $result ? $result['credit_load'] : false;
  }
  public function gpChecker($level,$semester,$studentid){
    $statement = $this->database->prepare("SELECT studentid FROM grade_point_record WHERE level = :level AND  semester = :semester AND studentid = :studentid");
    $result = $statement->execute(array("level" => $level, "semester" => $semester,"studentid" => $studentid));
    $result = $statement->fetch();
    return $result ? true : false;
  }
  public function gpInserter($gp,$level,$semester,$studentid){
    $statement = $this->database->prepare("INSERT INTO grade_point_record (studentid,level,semester,gp) VALUES (?,?,?,?)");
    $statement->bindParam(1,$studentid);
    $statement->bindParam(2,$level);
    $statement->bindParam(3,$semester);
    $statement->bindParam(4,$gp);
    $result = $statement->execute();
    return $result ? true : false;
  }
}



 ?>
