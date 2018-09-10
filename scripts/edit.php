<?php
 include 'core/init.php';
 $id = $_SESSION['us3rid'];
 restricted();

  if(isset($_POST['submit'])){

    if(empty($_POST['name']) || empty($_POST['email'])){
      $errors[] = "All fields are required!";
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "E-mail is invalid.";
    }
    if (empty($errors)){
      $session->message("Profile updated successfully");
      $student->name = sanitize('name');
      $student->email = sanitize('email');
      $result = $student->updateUser($id,$student->name,$student->email);
    }
}else{
  $errors[] = "Please fill these fields!";
}
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <!-- Meta, title, CSS, favicons, etc. -->
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">


     <!-- Bootstrap core CSS -->

     <link href="../CSS/bootstrap.min2.css" rel="stylesheet">

     <link href="../fonts/css/font-awesome.min.css" rel="stylesheet">
     <link href="../CSS/animate.min.css" rel="stylesheet">

     <!-- Custom styling plus plugins -->
     <link href="../CSS/custom1.css" rel="stylesheet">
     <link href="../CSS/icheck/flat/green.css" rel="stylesheet">


     <script src="../js/jquery.min.js"></script>
     <title>Edit Profile</title>
     <style>
       .important{
         margin-bottom:6%;
       }
       .important-div{
         margin-top:6%;
       }
       .anchor{
         color:white;
         font-size:1.5em;
       }
     </style>
   </head>
   <body>
     <div class="content-wrapper">
       <div class="container-fluid">
         <!-- Breadcrumbs-->
         <ol class="breadcrumb">
           <li class="breadcrumb-item">
             <a href="dashboard.php">Dashboard</a>
           </li>
           <li class="breadcrumb-item active">My Dashboard</li>
         </ol>
         <!-- Icon Cards-->
         <?php if(loggedIn()): ?>
         <div class="card mb-3">
           <div class="card-header important">
             <i class="fa fa-plus"></i> Edit Profile
           </div>
           <div class="card-body">
             <div class="col-md-6">
               <?php //error($errors); ?>
                 <?php
                 if(!empty($errors)){
                  error($errors);
                }else{
                  success($session->message);
                }
                  ?>
                 <form action="edit.php" method="post" enctype="multipart/form-data">

                 <div class="form-group">
                   <?php  ?>
                   <label for="name">Name</label>
                   <input type="text" class="form-control" name="name" value="" placeholder="<?php echo $_SESSION['name']; ?>">
                 </div>
                 <div class="form-group">
                   <label for="email">Email</label>
                   <input type="text" class="form-control" name="email" value="" placeholder="<?php echo $_SESSION['email']; ?>">
                 </div>
                 <input type="submit" class="btn btn-sm"name="submit" value="Update">
                 <div class="col-sm-12 important-div">
                    <p class="alert alert-info">Note: For further changes, please <a href="contactadmin.php"><span class="anchor">contact admin</span></a> </p>
                 </div>

              </form>
              </div>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
    </div>
   </body>
 </html>
