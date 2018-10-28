<?php require_once '../core/init.php'; ?>
<?php
  if(!isset($_GET['level']) || !isset($_GET['semester'])){
    redirectTo('course_allocation.php');
  }
  $level = intval($_GET['level']);
  $semester = intval($_GET['semester']);
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
          <div class="col-md-12">
            <?php// error($errors); success($message); ?>
              <h2>Course Allocation</h2>
              <div class="row">
                <div class="col-md-9">
                  <h4>List of courses</h4>
                </div>
                <div class="col-md-3">
                  <h5 class="">Level : <?php echo $level; ?> Semester : <?php echo $semester; ?></h5>
                </div>
              </div>

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Course Title</th>
                    <th>Course Code</th>
                    <th>Credit Hours</th>
                    <th>Level</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $course = $admin->getCourse($semester,$level); ?>
                  <?php if($course): ?>
                      <?php $i = 1; ?>
                      <?php if($course):foreach($course as $courses): ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $courses['name']; ?></td>
                        <td><?php echo $courses['coursecode']; ?></td>
                        <td><?php echo $courses['credithrs']; ?></td>
                        <td><?php echo $courses['level']; ?></td>
                        <td>
                          <?php $cid = $admin->getCourseid($courses['lecturerid']); ?>
                          <?php if($cid != '0'): ?>
                            <a href="#" class="btn btn-success"><i class=""></i>Allocated</a>
                            <!-- <a href="#" class="btn btn-success"><i class="fa fa-eye"></i></a> -->
                            <a href="update_allocate.php?courseid=<?php echo $courses['id']; ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                          <?php else: ?>
                            <a href="lecturer_allocate.php?courseid=<?php echo $courses['id']; ?>" class="btn btn-primary"><i class=""></i>Allocate</a>
                            <!-- <a href="#" class="btn btn-success"><i class="fa fa-eye"></i></a> -->
                          <?php endif; ?>
                        </td>
                    </tr>
                    <?php $i++; ?>
                  <?php endforeach;endif; ?>
                <?php else: ?>
                  <p class="alert alert-warning text-center">No Registered courses for this <strong>Session</strong></p>
                <?php endif; ?>
              </tbody>
              </table>
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
