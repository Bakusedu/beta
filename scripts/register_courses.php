<?php
include 'core/init.php';
if($result = $student->checkRegister($_SESSION['us3rid'])){
  redirectTo('error_registered.php');
}

$semester = $_SESSION['semester'];
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
     <title>Register Courses</title>
     <style>
       body {
         color:white;
       }
     </style>
   </head>
   <body>
     <?php $result = $student->getCourseInformation($_SESSION['level'],$semester); ?>
     <?php if($result): ?>
       <?php $i = 1;?>
     <h3 class="text-center">Course Registeration</h3>
     <form  action="processing.php" method="post">

     <div class="col-12 table-responsive">
       <table class="table">
       <thead>
         <th>S/N</th>
         <th>Course Name</th>
         <th>Course Code</th>
         <th>Credit hours</th>
         <th>Lecturer</th>
         <th>Check to register</th>
         <?php $total = 0; ?>
       </thead>
       <tbody>
         <?php foreach ($result as $results): ?>

         <tr>
           <td><?php echo $i; ?></td>
           <td><?php echo $results['name']; ?></td>
           <td><?php echo $results['coursecode']; ?></td>
           <td><?php echo $results['credithrs']; ?></td>
           <td><?php echo $results['Name'];?></td>
           <td><input type="checkbox" name="courseid[]" value="<?php echo $results['id']; ?>">
           </td>
           <?php $i = $i + 1;
           $total = $total + $results['credithrs'];?>
           <!-- <td></td> -->
         <?php endforeach; endif; ?>
         </tr>
       </tbody>
       </table>

     </div>
     <div class="col-sm-6 col-sm-offset-3">
       <p class="alert alert-info text-center">Note,<em>Total Credit</em> load for this semester is <?php echo "<strong>".$total."</strong>"; ?>.You can only register a maximum of <strong>24</strong> credit unit per semester</p>
     </div>
     <div class="col-sm-12">
       <p class="text-center"><input type="submit" class="btn btn-success btn-lg" name="Register" value="Register"></p>
     </div>
   </form>
   </body>
  </html>
