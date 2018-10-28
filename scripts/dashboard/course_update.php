<?php require_once '../core/init.php'; ?>
<!-- administrator -->
<?php administrator(); ?>
<?php if(!isset($_GET['courseid'])){
  redirectTo('update_course.php');
}
$admin->id = intval($_GET['courseid']);
?>
<?php
$errors = NULL;
if(isset($_POST['update'])){
  //validate form
  if($_POST['semester'] == '--Choose--'){
    $errors[] = 'Semester field is empty';
  }
  if($_POST['level'] == '--Choose--'){
    $errors[] = 'level field is empty';
  }
  if($_POST['credithrs'] == '--Choose--'){
    $errors[] = 'credithrs field is empty';
  }
  $admin->coursename = sanitize('cname');
  if(empty($admin->coursename)){
    $errors[] = 'Course name field is empty';
  }
  $admin->coursecode = sanitize('ccode');
  if(empty($admin->coursecode)){
    $errors[] = 'Course code field empty';
  }
  $admin->semester = $_POST['semester'];
  $admin->credithrs = $_POST['credithrs'];
  $admin->level = $_POST['level'];
  if(empty($errors)){
    $update = $admin->updateCourse();
    if($update){
      $session->message('Course updated successfully');
    }
  }
}
 ?>
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
            <h4>Update course</h4>
            <div class="col-md-8">
              <?php error($errors);success($message); ?>
              <form  action="course_update.php?courseid=<?php echo $admin->id; ?>" method="post">
                <?php $admin->semester = $admin->getSemester();
                      $course = $admin->selectCourse();
                 ?>
                <div class="form-group">
                  <label for="cname">Course title</label>
                  <input type="text" class="form-control" name="cname" placeholder="Enter Course Name" value="<?php echo $course['name']; ?>" required>
                </div>
                <div class="form-group">
                  <label for="ccode">Course code</label>
                  <input type="text" class="form-control" name="ccode" placeholder="Enter Course Code" value="<?php echo $course['coursecode']; ?>" required>
                </div>
                <div class="form-group">
                  <label for="semester">Semester</label>
                  <select class="form-control" name="semester">
                    <option>--Choose--</option>
                    <option>1</option>
                    <option>2</option>
                  </select>
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
                  <label for="cname">Credit hours</label>
                  <select class="form-control" name="credithrs">
                    <option>--Choose--</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                  </select>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary" name="update"><i class="fa fa-edit"></i> Update</button>
                </div>
              </form>
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
