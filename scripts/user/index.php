<?php include '../core/init.php'; ?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../CSS/bootstrap.min.css" rel="stylesheet">

    <link href="../../CSS/bootstrap.min2.css" rel="stylesheet">

    <link href="../../fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../CSS/animate.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../CSS/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="../../CSS/simple-line-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../CSS/stylish-portfolio.min.css" rel="stylesheet">
        <!-- Custom styling plus plugins -->
    <link href="../../CSS/custom1.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../CSS/maps/jquery-jvectormap-2.0.1.css" />
    <link href="../../CSS/icheck/flat/green.css" rel="stylesheet" />
    <link href="../../CSS/floatexamples.css" rel="stylesheet" type="text/css" />
    <style>
    @media only screen and (max-width:640px) {
      .display {
        display:none;
      }
    }
    </style>

  </head>

  <body id="page-top">
    <!-- Navigation -->
    <div class="navbar nav_title" style="border: 0;">
    <a href="index.html" class="site_title"><i class="fa fa-laptop"></i> <span>D.M.S</span></a>
    <a class="menu-toggle rounded" href="#">
    <span><i class="fa fa-bars"></i></span>
    </a>
      </div>
      <?php if(!isset($_SESSION['us3rid'])): ?>

    <nav id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand">
          <a class="js-scroll-trigger">Welcome</a>
        </li>
        <li class="sidebar-nav-item">
          <a class="js-scroll-trigger" href="index.php">Home</a>
        </li>
        <li class="sidebar-nav-item">
          <a class="js-scroll-trigger" href="register.php">Register</a>
        </li>

        <li class="sidebar-nav-item">
          <a class="js-scroll-trigger" href="login.php">Login</a>
        </li>
      </ul>
    </nav>
  <?php else: ?>
    <nav id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand">
          <a class="js-scroll-trigger">Welcome</a>
        </li>
        <li class="sidebar-nav-item">
          <a class="js-scroll-trigger" href="dashboard.php">Dashboard</a>
        </li>
      </ul>
    </nav>
  <?php endif; ?>
    <!-- Header -->
    <header class="masthead d-flex">
      <div class="container text-center my-auto">
        <h1 class="mb-1">Database Magement System</h1>
        <h3 class="mb-5">
          <em>Access To Everything A Student Needs</em>
        </h3>
        <?php if(!isset($_SESSION['us3rid'])): ?>
        <a class="btn btn-primary btn-xl js-scroll-trigger" href="register.php">REGISTER</a>

        <a class="btn btn-success btn-xl js-scroll-trigger" href="login.php">LOGIN</a>
      <?php else: ?>

      <?php endif; ?>
            </div>
          </div>
        </div>

      </div>
      <div class="overlay"></div>
    </header>

    <!-- Bootstrap core JavaScript -->
    <script src="../../Js/jquery.min.js"></script>
    <script src="../../Js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="../../Js/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="../../Js/stylish-portfolio.min.js"></script>

  </body>

</html>
