
<?php
  include '../core/init.php';
  restricted();
  if(isset($_POST['submit'])){
    $name = sanitize('name');
    $regnum = sanitize('regnum');
    $message = sanitize('message');
    $student->messageid = $_SESSION['us3rid'];
    $student->name = $name;
    $student->regnum = $regnum;
    $student->message = $message;
    $result = $student->insertMessage();
    if($result){
      $session->message = "Message sent!";
    }

  }

  ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="../../CSS/bootstrap.min.css" rel="stylesheet">

    <link href="../../CSS/bootstrap.min2.css" rel="stylesheet">

    <link href="../../fonts/css/font-awesome.min.css" rel="stylesheet">
    <title>Contact admin</title>
    <style>
      body{
        color:white;
      }
      .margin{
        margin-top:5%;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h2 class="text-center">Contact Admin</h2>
      <p class="alert alert-info ">Please fill in thesame <em>Name</em> and <em>Registeration Number</em> used when registering </p>
      <form class="" action="contactadmin.php" method="post">
        <?php success($session->message); ?>
          <div class="row margin">
            <div class="form-group col-sm-6">
              <label class="control-label">Name</label>
              <input type="text" class="form-control" name="name" value="">
            </div>
            <div class="form-group col-sm-6">
              <label class="control-label">Reg num</label>
              <input type="text" class="form-control" name="regnum" value="">
            </div>

          </div>
          <hr>
          <div class="col-sm-12">
            <label for="" class="control-label">Message</label>
            <textarea class="form-control" name="message" rows="8"></textarea>
          </div>
          <div class="col-sm-12 margin">
            <input type="submit" class="btn btn-primary  btn-block" name="submit" value="Send">
          </div>
      </form>

    </div>
  </body>
</html>
