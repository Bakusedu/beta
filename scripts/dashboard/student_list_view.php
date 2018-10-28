<?php require_once '../core/init.php'; ?>
<?php
  if(!isset($_GET['level'])){
    redirectTo('student_list.php');
  }
  $level = intval($_GET['level']);
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
            <div class="table-responsive">
              <h2><?php echo $level ?>Level Students</h2>
              <?php $results = $admin->getStudents($level); ?>
              <?php if($results):?>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach($results as $result): ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $result['name'] ?></td>
                    <td><?php echo $result['department']; ?></td>
                    <td><?php echo $result['gender']; ?></td>
                    <td><?php echo $result['email']; ?></td>
                    <td>
                      <a href="student_view.php?id=<?php echo $result['id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                      <a href="student_update.php?id=<?php echo $result['id'];?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="student_delete.php?id=<?php echo $result['id']; ?>"
                       onclick="return confirm('Are you sure you want to delete this profile?" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i>
                        </a>
                    </td>
                </tr>
                  <?php $i++; ?>
                <?php endforeach; ?>
                </tbody>
              </table>
            <?php else: ?>
              <p class="alert alert-warning text-center">No Registered <strong>Students</strong> yet!</p>
            <?php endif; ?>
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
