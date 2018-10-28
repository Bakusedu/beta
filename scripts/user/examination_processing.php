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
      <title>Upload Score</title>
      <style>
        body {
          color:white;
        }
      </style>
    </head>
    <body>
      <?php $true = $student->checkStudent($_SESSION['studentid'],$_SESSION['courseid']); ?>
      <?php if($true): ?>
      <?php $results = $student->getInfo($studentid);$i = 1;?>
       <?php if($results):?>
        <div class="container">
          <div class="col-md-12 table-responsive">
            <form  action="" method="post">
            <table class="table">
            <thead>
              <th>S/N</th>
              <th>Regnum</th>
              <th>Exam Score</th>
            </thead>
            <tbody>
                <div class="form-group">
                    <?php $result = $student->getExamination($_SESSION['studentid'],$_SESSION['courseid']); ?>
                      <?php if($result['exam_score'] == NULL): ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $results['regnum']; ?></td>
                          <td><input class="form-control" type="text" name="exam_score" id="exam" value="" required></td>
                          <td><a class="btn btn-success" id="enter">Enter score</a></td>
                          <!-- <td></td> -->
                        </tr>

                      <tr id="messages"></tr>
                    <?php else: ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $results['regnum']; ?></td>
                        <td><input class="form-control" type="text" name="exam_score" id="exam" value="<?php echo $result['exam_score']; ?>" required></td>
                        <td><button class="btn btn-success" name="upload" id="update">Update</button></td>
                        <!-- <td></td> -->
                      </tr>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            </tbody>
            </table>
          </form>
      <?php else:?>
        <p class="alert alert-info text-center">This Student does not have assessment</p>
      </div>
    <?php endif; ?>
      </div>
      <script src="../../js/jquery-3.3.1.min.js"></script>
      <script src="../../js/exam_upload.js"></script>
      <script src="../../js/exam_update.js"></script>
    </body>
  </html>
