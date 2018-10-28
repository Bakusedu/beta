<?php include '../core/init.php' ?>

<?php
$errors = NULL;
  if (isset($_POST['submit'])) {
    // Set required fields
    $name = $_POST['name'];
    $regnum = $_POST['regnum'];
    $email = $_POST['email'];
    $level = $_POST['level'];
    $department = $_POST['department'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    if(empty($name) || empty($regnum) || empty($email) || empty($password) || empty($cpassword)){
          // Test for required fields that were ignored

          $errors[] = "All fields are required!";
    }else{

      $student->name = sanitize('name');
      $student->regnum = sanitize('regnum');
      $student->email = sanitize('email');
      $student->level = ($_POST['level']);
      $student->department = ($_POST['department']);
      $student->gender = $_POST['gender'];
      $student->password = sanitize('password');
      // Validate the form fields
      if (!filter_var($student->email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "E-mail is invalid.";
      }
      if (strlen($student->password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
      }

      $result = checkPassword($student->password,$_POST['cpassword']);

        if(!($result)){
          $errors[] = "Passwords do not match";
        }
        if(empty($errors)){
          $student->password = md5($student->password);
            $result = $student->insertUser();

            if ($result) {
                $session->message("Profile created successfully.");
                redirectTo('login.php');
            }
        }

    }
}





 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <!-- Bootstrap Core CSS -->
    <link href="../../CSS/bootstrap.min.css" rel="stylesheet">

    <link href="../../CSS/bootstrap.min2.css" rel="stylesheet">

    <link href="../../fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../CSS/animate.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- Custom Fonts -->
    <link href="../../CSS/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="../../CSS/simple-line-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../CSS/stylish-portfolio.min.css" rel="stylesheet">
    <!--<link href="bootstrap.min.css" rel="stylesheet">-->


<style type="text/css">

body{
  /*background-image: url(../Img/1.jpg);*/
  background: #2A3F54;
}

label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 700;
    color: #f5f5f5;
  }
  .text-warning {
    color: #f5f5f5;
}
</style>



</head>
<body>
  <a class="menu-toggle rounded" href="#">
      <i class="fa fa-bars"></i>
    </a>
    <nav id="sidebar-wrapper">

      <ul class="sidebar-nav">
        <?php if (loggedIn()):
          $name = $_SESSION['name']; ?>

        <li class="sidebar-brand">
          <a class="js-scroll-trigger"><i class="fa fa-user"></i> <?php echo $name; ?></a>
        </li>
        <li class="sidebar-brand">
          <a class="js-scroll-trigger" href="dashboard.php"><i class="fa fa-dashboard"></i>&nbsp;Dashboard</a>
        </li>
        <li class="sidebar-nav-item">
          <a class="js-scroll-trigger" href="logout.php"><i class="fa fa-lock"></i>&nbsp;logout</a>
        </li>
        <?php else: ?>
        <li class="sidebar-nav-item">
          <a class="js-scroll-trigger" href="index.php">Home</a>
        </li>
        <li class="sidebar-nav-item">
          <a class="js-scroll-trigger" href="register.php">Register</a>
        </li>

        <li class="sidebar-nav-item">
          <a class="js-scroll-trigger" href="login.php">Login</a>
        </li>
        <?php endif; ?>
      </ul>
    </nav>

<!-- if you want to create login page and register page together in one page ...you have to only chnage his name...that's it...                 -->
<div class="container">
  <div class="row">
    <div class="col-sm-4"> </div>
<div class="col-md-4">

<h1 class="text-center text-warning">Register Here</h1>
<br/>

<div class="col-sm-12">


<br/>


  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
<?php error($errors) ?>
<form action="register.php" method="POST">
  <div class="form-group">
    <label for="name" class="control-label">Full Name</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name Here"  value="<?php echo stickyForm('name');?>">
  </div>

  <div class="form-group">
    <label for="regnum">Reg Number</label>
    <input type="text" class="form-control" name="regnum" id="regnum" placeholder="Enter Reg Number Here"  value="<?php echo stickyForm('regnum');?>">
  </div>

    <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email Here"  value="<?php echo stickyForm('email');?>">
  </div>

    <div class="form-group">
    <label for="level">Level</label>
    <select class="form-control " name="level" id="level">
      <option>100</option>
      <option>200</option>
      <option>300</option>
      <option>400</option>
    </select>
    </div>

    <div class="form-group">
    <label for="department">Department</label>
    <select class="form-control" name="department" id="department">
      <option "selected">Computer Science</option>
    </select>
    </div>


    <div class="form-group">
    <label for="Gender">Gender</label>
    <select class="form-control" name="gender" id="gender">
      <option>Male</option>
      <option>Female</option>
    </select>
    </div>



  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" name="password" id="password">
  </div>

    <div class="form-group">
    <label for="pwd">Confirm Password:</label>
    <input type="password" name="cpassword" class="form-control" id="passwordconfirm">
  </div>


  <button type="submit" name="submit" class="btn btn-default btn-lg" >Submit</button>

</form>

<!--<a href="#" class="pull-right btn btn-block btn-danger" > Already Register ?   </a>-->



    </div>




<!-- ===========Login Modal===============-->   </div>
  </div>
</div>
</div>

<!-- This design is created by manoj chauhan  -->

    <!-- Bootstrap core JavaScript -->
    <script src="../../Js/jquery.min.js"></script>
    <script src="../../Js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="../../Js/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="../../Js/stylish-portfolio.min.js"></script>

</body>
</html>
