<?php
include '../core/init.php';
restricted();
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
     <div class="col-md-12">
       <?php $result = $student->procedure($_SESSION['us3rid'],$_SESSION['semester']); ?>
       <?php if($result): ?>
         <h3 class="text-center">Assessment</h3>
         <?php foreach($result as $results): ?>
         <ul class="list-group">
           <li class="list-group-item text-center"><a href="assessment_view.php?id=<?php echo $results['id']; ?>"><?php echo $results['name']; ?></a></li>
         </ul>
       <?php endforeach; ?>
     <?php else: ?>
          <p class="alert alert-info text-center">Assessment not available</p>
       <?php endif; ?>
     </div>
   </body>
  </html>
