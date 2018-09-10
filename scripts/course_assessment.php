<?php
include 'core/init.php';
if(!isset($_GET['id'])){
  redirectTo('assessment.php');
}
restricted();
$courseid = intval($_GET['id']);
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link href="../CSS/bootstrap.min.css" rel="stylesheet">

     <link href="../CSS/bootstrap.min2.css" rel="stylesheet">

     <link href="../fonts/css/font-awesome.min.css" rel="stylesheet">
     <title>View Courses</title>
     <style>
       body {
         color:white;
       }
     </style>
   </head>
   <body>
     <?php $res = $lecturer->getName($courseid); ?>
     <?php $results = $lecturer->registeredStudents($courseid,$_SESSION['us3rid']); ?>
       <?php $i = 1;?>
       <?php if($results):?>
    <div class="container">
      <h3 class="text-center"><strong><?php echo $res['name'] ?></strong> Student Assessment</h3>
        <div class="col-md-12 table-responsive">
          <table class="table">
          <thead>
            <th>S/N</th>
            <th>Names</th>
            <th>Regnum</th>
            <th>Gender</th>
            <th>Attendance</th>
            <th>1st Test</th>
            <th>2nd Test</th>
            <th>Assessment</th>
            <?php $total = 0; ?>
          </thead>
          <tbody>
            <div class="form-group">

            <?php foreach ($results as $result ): ?>

            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $result['name']; ?></td>
              <td><?php echo $result['regnum']; ?></td>
              <td><?php echo $result['gender']; ?></td>
              <td><input type="text" class="form-control" name="" ></td>
              <td><input type="text" class="form-control" name="" ></td>
              <td><input type="text" class="form-control" name="" ></td>
              <td><input type="text" class="form-control" name="" ></td>
              <?php $i = $i + 1;?>
              <!-- <td></td> -->
            </tr>
          <?php endforeach; endif;?>
          </div>
          </tbody>
          </table>

        </div>
      </div>
   </body>
  </html>
