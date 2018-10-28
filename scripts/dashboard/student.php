<?php require_once '../core/init.php'; ?>
<?php
  $errors = NULL;
  if(isset($_POST['regista'])){
    $admin->name = sanitize('name');
    $admin->department = $_POST['department'];
    $admin->gender = isset($_POST['gender']) ? $_POST['gender'] : 'N/A';
    $admin->email = sanitize('email');
    $admin->password = sanitize('password');
    $admin->level = sanitize('level');
    $admin->regnum = sanitize('regnum');
    $confirm = $_POST['cpassword'];
    //Validate form input

    if(!filter_var($admin->email,FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Email is invalid.";
    }
    if(empty($admin->name)){
      $errors[] = 'Full name field required';
    }
    if(strlen($admin->password) < 6) {
      $errors[] = "Password must be at least 6 Charactters long.";
    }
    if($admin->password !== $confirm) {
      $errors[] = "Passwords do not match.";
    }
    if($admin->level == '--Choose--'){
      $errors[] = 'Level field is empty';
    }

    //Check for errors

    if(empty($errors)){
      $result = $admin->createStudent();
      $create = $admin->createStudentInfo($result);
      if($create){
        $session->message('Account created successfully');
      }
    }
  }
 ?>
<!-- administrator -->
  <?php require_once 'inc/header.php'; ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>
      <!-- Icon Cards-->
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-8">
            <?php error($errors); success($message); ?>
            <form action="student.php" method="post">
              <h2><i class="fa fa-plus"></i>Add new student</h2>
              <fieldset>
                <legend>Student profile</legend>
                <div class="form-group">
                  <label for="name">Email</label>
                  <input type="text" class="form-control" name="email" placeholder="Email" value="">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" value="">
                </div>
                <div class="form-group">
                  <label for="cpassword">Confirm password</label>
                  <input type="password" class="form-control" name="cpassword" value="">
                </div>
                <legend>Student credentials</legend>
                <div class="form-group">
                  <label for="name">Full name</label>
                  <input type="text" class="form-control" name="name" placeholder="Student name" value="">
                </div>
                <div class="form-group">
                  <label for="department">Department</label>
                  <select class="form-control" name="department">
                    <option>--Choose--</option>
                    <option>Computer Science</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="regnum">Reg num</label>
                  <input type="text" class="form-control" name="regnum" placeholder="Registeration Number" value="">
                </div>
                <div class="form-group">
                  <label for="level">Level</label>
                  <select class="form-control" name="level">
                    <option>--Choose--</option>
                    <option>100</option>
                    <option>200</option>
                    <option>300</option>
                    <option>400</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Gender</label><br>
                  <input type="radio" name="gender" value="Male"> Male
                  <input type="radio" name="gender" value="Female"> Female
                </div>
                <div class="form-group">
                  <button type="submit" name="regista" class="btn btn-primary"><i class="fa fa-user"></i> Register</button>
                </div>
              </fieldset>
            </form>
          </div>
          <div class="col-md-3">
            <div class="panel panel-primary">
              <ul class="list-group">
                <li class="list-group-item"><a href="student_list.php"><i class="fa fa-user"></i> Student profile</a></li>
                <!-- <li class="list-group-item"><a href="course_allocation.php"><i class="fa fa-graduation-cap"></i> Course allocation</a></li> -->
              </ul>
            </div>
          </div>
        </div>
      </div>

    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Bakus 2017</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="../user/logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
</div>
</body>

</html>
