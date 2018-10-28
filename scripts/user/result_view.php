<?php
  include '../core/init.php';
  restricted();
  if(!isset($_GET['id'])){
    redirectTo('course_assessment.php');
  }

   $courseid = intval($_GET['id']);
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
      <title>Result</title>
      <style>
        body {
          color:white;
        }
      </style>
    </head>
    <body>
      <?php $res = $lecturer->getName($courseid); ?>
      <div class="col-md-12">
        <h3 class="text-center"><?php echo $res['name']." Result"; ?></h3>
      </div>
        <div class="container">
          <div class="col-md-12 table-responsive">
            <?php $true = $student->result_available($courseid,$_SESSION['us3rid']); ?>
            <?php if($true['0']['grade'] != NULL): ?>
            <table class="table">
            <thead>
              <th>Regnum</th>
              <th>Attendance</th>
              <th>1st test</th>
              <th>2nd test</th>
              <th>Exam Score</th>
              <th>Grade</th>
            </thead>
            <tbody>
                <?php $results = $student->getInfo($_SESSION['us3rid']); ?>
                  <div class="form-group">
                        <tr>
                          <td><?php echo $results['regnum']; ?></td>
                          <td><?php echo $true['0']['attendance']; ?></td>
                          <td><?php echo $true['0']['firsttest']; ?></td>
                          <td><?php echo $true['0']['secondtest']; ?></td>
                          <td><?php echo $true['0']['exam_score']; ?></td>
                          <?php if($true['0']['grade'] == 'A'): ?>
                            <td><a  class="btn btn-success"><?php echo $true['0']['grade']; ?></a></td>
                          <?php endif; ?>
                            <?php if($true['0']['grade'] == 'B'): ?>
                              <td><a  class="btn btn-primary"><?php echo $true['0']['grade']; ?></a></td>
                            <?php endif; ?>
                              <?php if($true['0']['grade'] == 'C'): ?>
                                <td><a  class="btn btn-info"><?php echo $true['0']['grade']; ?></a></td>
                            <?php endif; ?>
                              <?php if($true['0']['grade'] == 'D'): ?>
                                <td><a  class="btn btn-secondary"><?php echo $true['0']['grade']; ?></a></td>
                            <?php endif; ?>
                              <?php if($true['0']['grade'] == 'E'): ?>
                                <td><a  class="btn btn-warning"><?php echo $true['0']['grade']; ?></a></td>
                            <?php endif; ?>
                              <?php if($true['0']['grade'] == 'F'): ?>
                                <td><a  class="btn btn-danger"><?php echo $true['0']['grade']; ?></a></td>
                          <?php endif; ?>
                          <!-- <td></td> -->
                        </tr>
                </div>
            </tbody>
            </table>
          <?php else: ?>
            <div class="col-md-12">
              <p class="alert alert-info text-center">Result not yet available</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <script src="../js/jquery-3.3.1.min.js"></script>
      <script src="../js/script.js"></script>
    </body>
  </html>
