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
     <title>Upload result</title>
     <style>
       body {
         color:white;
       }
       ul li a:hover{
         text-decoration: none;
       }
     </style>
   </head>
   <body>
     <?php $res = $lecturer->getCourse($_SESSION['us3rid'],$_SESSION['semester']); ?>
       <?php if($res):?>
         <div class="container">
           <h3 class="text-center"><strong>Results</h3>
             <ul class="list-group">
                 <?php foreach ($res as $result ): ?>
                   <li class="list-group-item text-center"><a href="upload_view.php?id=<?php echo $result['id'];?>"><?php echo $result['name'] ?></a></li>

               <?php endforeach; endif;?>
             </ul>
             </div>
   </body>
  </html>
