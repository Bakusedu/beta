<?php
include '../core/init.php';
if(!isset($_GET['id'])){
  redirectTo('dashboard.php');
}
restricted();
$courseid = intval($_GET['id']);
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link href="../../CSS/bootstrap.min.css" rel="stylesheet">

     <link href="../../CSS/bootstrap.min2.css" rel="stylesheet">

     <link href="../../fonts/css/font-awesome.min.css" rel="stylesheet">
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
    <div class="container">
      <h3 class="text-center"><strong><?php echo $res['name'] ?></strong> Students</h3>
      <div class="col-md-offset-3">
        <div class="col-md-8 table-responsive">
          <table class="table">
            <?php if($results):?>
          <thead>
            <th>S/N</th>
            <th>Photo</th>
            <th>Names</th>
            <th>Regnum</th>
            <th>Email</th>
            <th>Gender</th>
            <?php $total = 0; ?>
          </thead>
          <tbody>
            <?php foreach ($results as $result ): ?>

            <tr>
              <td><?php echo $i; ?></td>
              <?php if($result['photo'] == NULL): ?>
              <td><img class="img-responsive" src="../../images/pictures/user.png" alt=""></td>
              <?php else: ?>
              <td><img class="img-responsive" src="../../images/pictures/<?php echo $result['photo']; ?>" alt="">
              </td>
            <?php endif; ?>
              <td><?php echo $result['name']; ?></td>
              <td><?php echo $result['regnum']; ?></td>
              <td><?php echo $result['email']; ?></td>
              <td><?php echo $result['gender']; ?></td>
              <?php $i = $i + 1;?>
              <!-- <td></td> -->
            </tr>
          <?php endforeach;?>
        <?php else: ?>
          <tbody>
            <tr><td class="alert alert-info text-center">No registered students yet</td></tr>
        <?php  endif;?>
          </tbody>
          </table>

        </div>
      </div>

    </div>
   </body>
  </html>
