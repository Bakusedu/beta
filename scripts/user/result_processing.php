<?php
  include '../core/init.php';
  restricted();
  if(!isset($_GET['id'])){
    redirectTo('course_assessment.php');
  }

   $studentid = intval($_GET['id']);
   $_SESSION['studentid'] = $studentid;
  //   if (empty($_POST['attendance']) || empty($_POST['firsttest']) || empty($_POST['secondtest'])) {
  //     redirectTo('errorpage.php/fields_empty');
  //   }
  //   else{
  //     $attendance = sanitize('attendance');
  //     $firsttest = sanitize('firsttest');
  //     $secondtest = sanitize('secondtest');
  //     echo $secondtest;
  //
  //     $result = $student->insertAssessment($studentid,$_SESSION['us3rid'],$_SESSION['courseid'],$attendance,$firsttest,$secondtest);
  //     if ($result) {
  //       echo "inserted!";
  //     }
  //     else{
  //       redirectTo('errorpage.php/didnt_insert');
  //     }
  //   }
  //
  // }

  // var_dump($_SESSION['courseid']);
  // var_dump($_SESSION['us3rid']);
  // var_dump($studentid);
?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link href="../../CSS/bootstrap.min.css" rel="stylesheet">

      <link href="../../CSS/bootstrap.min2.css" rel="stylesheet">

      <link href="../../fonts/css/font-awesome.min.css" rel="stylesheet">
      <title>Upload Assessment</title>
      <style>
        body {
          color:white;
        }
      </style>
    </head>
    <body>
      <?php $results = $student->getInfo($studentid);
       $i = 1;
       if($results):?>
        <div class="container">
          <div class="col-md-12 table-responsive">
            <form  action="" method="post">
            <table class="table">
            <thead>
              <th>S/N</th>
              <th>Regnum</th>
              <th>Attendance</th>
              <th>1st test</th>
              <th>2nd test</th>
              <th>Exam Score</th>
              <th>Total</th>
              <th>Grade</th>
            </thead>
            <tbody>
                <div class="form-group">
                  <?php $true = $student->checkStudent($_SESSION['studentid'],$_SESSION['courseid']); ?>
                  <?php if($true): ?>
                    <?php $result = $student->getAssessment($_SESSION['studentid'],$_SESSION['courseid']); ?>
                      <?php if($result): ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $results['regnum']; ?></td>
                        <td><input class="form-control" type="text" name="attendance" id="attendance" value="<?php echo $result['attendance']; ?>" readonly></td>
                        <td><input class="form-control" type="text" name="firsttest" value="<?php echo $result['firsttest']; ?>" id="firsttest"  readonly></td>
                        <td><input class="form-control" type="text" name="secondtest" value="<?php echo $result['secondtest']; ?>" id="secondtest" readonly></td>
                        <td><input class="form-control" type="text" name="exam_score" value="<?php echo $result['exam_score']; ?>" id="exam_score" readonly></td>
                        <td><input class="form-control" type="text" name="total" value="" id="total" readonly></td>
                        <td><input class="form-control" type="text" name="grade" value="" id="grade" readonly></td>
                        <td><button class="btn btn-success" name="upload" id="update">Upload result</button></td>
                        <!-- <td></td> -->
                      </tr>
                      <tr id="messages"></tr>
                    <?php endif; ?>
                  <?php else: ?>
                    <tr><p class="alert alert-info">No record found for this student</p></tr>
                  <?php endif; ?>
              </div>
            </tbody>
            </table>
          </form>
        </div>
        <?php endif;?>
      </div>
      <script src="../../js/jquery-3.3.1.min.js"></script>
      <script src="../../js/calculator.js"></script>
      <script src="../../js/grade_upload.js"></script>
    </body>
  </html>
