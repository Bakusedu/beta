<?php
  include '../core/init.php';
  restricted();
  // if(!isset($_GET['level']) || $_GET['semester']){
  //   redirectTo('notset.php');
  // }

   $level = $_GET['level'];
   $semester = $_GET['semester'];
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
      <div class="col-md-12">
        <h3 class="text-center"><?php echo " Result"; ?></h3>
      </div>
        <div class="container">
          <div class="col-md-12 table-responsive">

            <?php $true = $student->record($_SESSION['us3rid'],$level,$semester); ?>
            <?php if($true): ?>
            <table class="table">
            <thead>
              <th>S/N</th>
              <th>Name</th>
              <th>Course Code</th>
              <th>Grade</th>
            </thead>
            <tbody>
                  <div class="form-group">
                    <?php $total_point = 0; ?>
                    <?php $i = 0; ?>
                    <?php $x = 1;?>
                      <?php foreach($true as $res): ?>
                        <?php if($true[$i]['priviledges'] !== 'restricted'): ?>
                        <tr>
                          <td><?php echo $x; ?></td>
                          <td><?php echo $true[$i]['name']; ?></td>
                          <td><?php echo $true[$i]['coursecode']; ?></td>
                          <?php if($true[$i]['grade'] == 'A'): ?>
                            <td><a  class="btn btn-success"><?php echo $true[$i]['grade']; ?></a></td>
                          <?php endif; ?>
                            <?php if($true[$i]['grade'] == 'B'): ?>
                              <td><a  class="btn btn-primary"><?php echo $true[$i]['grade']; ?></a></td>
                            <?php endif; ?>
                              <?php if($true[$i]['grade'] == 'C'): ?>
                                <td><a  class="btn btn-info"><?php echo $true[$i]['grade']; ?></a></td>
                            <?php endif; ?>
                              <?php if($true[$i]['grade'] == 'D'): ?>
                                <td><a  class="btn btn-secondary"><?php echo $true[$i]['grade']; ?></a></td>
                            <?php endif; ?>
                              <?php if($true[$i]['grade'] == 'E'): ?>
                                <td><a  class="btn btn-warning"><?php echo $true[$i]['grade']; ?></a></td>
                            <?php endif; ?>
                              <?php if($true[$i]['grade'] == 'F'): ?>
                                <td><a  class="btn btn-danger"><?php echo $true[$i]['grade']; ?></a></td>
                          <?php endif; ?>
                          <?php $grade = $true[$i]['grade'];
                                $credithrs = $true[$i]['credithrs'];
                                $total_point = $total_point + point_adder($grade,$credithrs);
                           ?>

                          <!-- <td></td> -->
                        </tr>
                </div>
          <?php else: ?>
            <div class="form-group">
              <td><?php echo $x; ?></td>
              <td><?php echo $true[$i]['name']; ?></td>
              <td><?php echo $true[$i]['coursecode']; ?></td>
              <td class="alert alert-info">Result not yet available</td>
            </div>
          <?php endif; ?>
          <?php $i++; ?>
          <?php $x++; ?>
        <?php endforeach; ?>
      </tbody>
      </table>
      <p class="alert alert-info text-center"><?php $total_creditload = $student->getCreditload($level,$semester);
          $gp = $total_point/$total_creditload;
          echo "Semester GP : <strong>".round($gp,3)."</strong>";
      ?></p>
      <?php
        if($result = $student->gpChecker($level,$semester,$_SESSION['us3rid'])){}
        else{
          $result = $student->gpInserter($gp,$level,$semester,$_SESSION['us3rid']);
        }
       ?>
    <?php else: ?>
      <div class="col-md-12">
        <p class="alert alert-info text-center"><strong>Result not available for this semester</strong></p>
      </div>
    <?php endif; ?>
    </div>
  </div>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/script.js"></script>
</body>
</html>
