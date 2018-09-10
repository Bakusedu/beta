<?php
include 'core/init.php';
restricted();
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
     <?php $result = $student->viewCourses($_SESSION['us3rid']); ?>
       <?php $i = 1;?>
       <?php if($result):?>
     <h3 class="text-center">View Courses</h3>
     <div class="col-12 table-responsive">
       <table class="table">
       <thead>
         <th>S/N</th>
         <th>Course Name</th>
         <th>Course Code</th>
         <th>Credit hours</th>
         <?php $total = 0; ?>
       </thead>
       <tbody>
         <?php foreach ($result as $results): ?>

         <tr>
           <td><?php echo $i; ?></td>
           <td><?php echo $results['name']; ?></td>
           <td><?php echo $results['credithrs']; ?></td>
           <td><?php echo $results['coursecode']; ?></td>
           <?php $i = $i + 1;
           $total = $total + $results['credithrs'];?>
           <!-- <td></td> -->
         <?php endforeach; ?>
       <?php else: ?>
         <?php redirectTo('register_courses.php') ?>
       <?php endif; ?>
         </tr>
       </tbody>
       </table>

     </div>
   </body>
  </html>
