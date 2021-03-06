<?php require_once '../core/init.php'; ?>
<?php
  if(!isset($_GET['id'])){
    redirectTo('lecturer_list.php');
  }
  $admin->id = intval($_GET['id']);
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
        <h2>Student profile</h2>
        <?php $result = $admin->getStudent(); ?>
        <div class="row">
          <div class="col-md-4">
            <img src="../../images/pictures/<?php echo $result['photo']; ?>" width="100%" alt="#">
          </div>
          <div class="col-md-8">
                <p><strong>Name :</strong> <?php echo $result['name'];?></p>
                <p><strong>Department :</strong> <?php echo $result['department']; ?></p>
                <p><strong>Regnum :</strong> <?php echo $result['regnum']; ?></p>
                <p><strong>Level :</strong> <?php echo $result['level']; ?></p>
                <p><strong>Gender :</strong> <?php echo $result['gender']; ?></p>
                <p><strong>Email :</strong> <?php echo $result['email']; ?></p>
                <a class="btn btn-primary" href="student_list_view.php?level=<?php echo $result['level'];?>"><i class="fa fa-arrow-left"></i> Back to Students</a>
            </div>

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
    <script src="jquery.min.js"></script>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('.list').click(function(){
      $('.listNone').slideToggle();
    });
  });
</script>
</body>

</html>
