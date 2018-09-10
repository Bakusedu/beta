<?php
  include 'pageheader.php';
  $errors = NULL;
  if(isset($_POST['submit'])){

    if(empty($_POST['regnum']) || empty($_POST['password'])) {
      $errors[] = "All fields are required!";
    }
    else{
      $student->regnum = trim($_POST['regnum']);
      $student->password = trim($_POST['password']);
      if($student->loginUser($student->regnum,$student->password)){
        redirectTo('dashboard.php');
      }
      else{
        $errors[] = "Authentication failed!";
      }
    }
  }


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <style>
      .background{
        background-color:white;
        position:relative;
        top:40%;
      }
      #submit{
        margin-top:2%;
      }
      form{
        margin-top:4%;
      }
    </style>
</head>
<?php  ?>
<div class="col-sm-12 background">
  <div class="form-group">
    <form class="" action="login.php" method="post">
      <fieldset>
        <div class="col-sm-8">
          <?php error($errors); success($session->message); ?>
          <legend>Login to your account</legend>
          <?php  ?>
          <label for="regnum">Reg Number</label>
          <input type="text" name="regnum" class="form-control radius" value="" placeholder="Reg Num" autofocus required>
          <label for="Password">Password</label>
          <input type="password" name="password" value="" class="form-control radius" placeholder="password">
          <div class="">
            <input type="submit" id="submit" class="btn btn-primary" name="submit" value="Submit">
          </div>
        </div>

      </fieldset>

    </form>
  </div>
</div>
</html>
