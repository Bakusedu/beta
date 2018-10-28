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
     <script src="../../js/jquery-3.3.1.min.js"></script>
     <title>View Courses</title>
     <style>
       body {
         color:white;
       }
     </style>
   </head>
   <body>
     <h3 class="text-center">Student Result Record</h3>
     <div class="col-md-12">
         <ul class="list-group">
           <?php if($_SESSION['level'] == '100'):?>
             <li class="list-group-item text-center link"><a href="#">100 LEVEL</a></li>
             <li style ="display:none" class="list-group-item text-center semester"><a  href="record_view.php?level=100&semester=1">first semester</a></li>
             <li style ="display:none" class="list-group-item text-center semester"><a  href="record_view.php?level=100&semester=2">second semester</a></li>

          <?php endif; ?>
          <?php if($_SESSION['level'] == '200'): ?>
            <li class="list-group-item text-center link"><a href="#">100 LEVEL</a></li>
            <li style ="display:none" class="list-group-item text-center semester"><a  href="record_view.php?level=100&semester=1">first semester</a></li>
            <li style ="display:none" class="list-group-item text-center semester"><a  href="record_view.php?level=100&semester=2">second semester</a></li>
            <li class="list-group-item text-center link1"><a href="#">200 LEVEL</a></li>
            <li style ="display:none" class="list-group-item text-center semester1"><a  href="record_view.php?level=200&semester=1">first semester</a></li>
            <li style ="display:none" class="list-group-item text-center semester1"><a  href="record_view.php?level=200&semester=2">second semester</a></li>
          <?php endif; ?>
          <?php if($_SESSION['level'] == '300'): ?>
            <li class="list-group-item text-center link"><a href="#">100 LEVEL</a></li>
            <li style ="display:none" class="list-group-item text-center semester"><a  href="record_view.php?level=100&semester=1">first semester</a></li>
            <li style ="display:none" class="list-group-item text-center semester"><a  href="record_view.php?level=100&semester=2">second semester</a></li>
            <li class="list-group-item text-center link1"><a href="#">200 LEVEL</a></li>
            <li style ="display:none" class="list-group-item text-center semester1"><a  href="record_view.php?level=200&semester=1">first semester</a></li>
            <li style ="display:none" class="list-group-item text-center semester1"><a  href="record_view.php?level=200&semester=2">second semester</a></li>
            <li class="list-group-item text-center link2"><a href="#">300 LEVEL</a></li>
            <li style ="display:none" class="list-group-item text-center semester2"><a  href="record_view.php?level=300&semester=1">first semester</a></li>
            <li style ="display:none" class="list-group-item text-center semester2"><a  href="record_view.php?level=300&semester=2">second semester</a></li>
          <?php endif; ?>
          <?php if($_SESSION['level'] == '400'): ?>
            <li class="list-group-item text-center link"><a href="#">100 LEVEL</a></li>
            <li style ="display:none" class="list-group-item text-center semester"><a  href="record_view.php?level=100&semester=1">first semester</a></li>
            <li style ="display:none" class="list-group-item text-center semester"><a  href="record_view.php?level=100&semester=2">second semester</a></li>
            <li class="list-group-item text-center link1"><a href="#">200 LEVEL</a></li>
            <li style ="display:none" class="list-group-item text-center semester1"><a  href="record_view.php?level=200&semester=1">first semester</a></li>
            <li style ="display:none" class="list-group-item text-center semester1"><a  href="record_view.php?level=200&semester=2">second semester</a></li>
            <li class="list-group-item text-center link2"><a href="#">300 LEVEL</a></li>
            <li style ="display:none" class="list-group-item text-center semester2"><a  href="record_view.php?level=300&semester=1">first semester</a></li>
            <li style ="display:none" class="list-group-item text-center semester2"><a  href="record_view.php?level=300&semester=2">second semester</a></li>
            <li class="list-group-item text-center link3"><a href="#">400 LEVEL</a></li>
            <li style ="display:none" class="list-group-item text-center semester3"><a  href="record_view.php?level=400&semester=1">first semester</a></li>
            <li style ="display:none" class="list-group-item text-center semester3"><a  href="record_view.php?level=400&semester=2">second semester</a></li>
          <?php endif; ?>
         </ul>
     </div>
     <script>
       $(document).ready(function(){
         $('.link').click(function(){
           var value = $('.link a').text();
           $('.semester').slideToggle();
         });
         $('.link1').click(function(){
           var value = $('.link a').text();
           $('.semester1').slideToggle();
         });
         $('.link2').click(function(){
           var value = $('.link a').text();
           $('.semester2').slideToggle();
         });
         $('.link3').click(function(){
           var value = $('.link a').text();
           $('.semester3').slideToggle();
         });
       });
     </script>
   </body>
  </html>
