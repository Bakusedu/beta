<?php require_once '../core/init.php'; ?>
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
              <h4>Click on the desired <strong>Level</strong></h4>
              <div class="col-md-12 panel panel-primary">
                <ul class="list-group">
                  <li class="list-group-item text-center link"><a href="#">100 LEVEL</a></li>
                  <li style ="display:none" class="list-group-item text-center semester"><a  href="course_allocation_view.php?level=100&semester=1">first semester</a></li>
                  <li style ="display:none" class="list-group-item text-center semester"><a  href="course_allocation_view.php?level=100&semester=2">second semester</a></li>
                  <li class="list-group-item text-center link1"><a href="#">200 LEVEL</a></li>
                  <li style ="display:none" class="list-group-item text-center semester1"><a  href="course_allocation_view.php?level=200&semester=1">first semester</a></li>
                  <li style ="display:none" class="list-group-item text-center semester1"><a  href="course_allocation_view.php?level=200&semester=2">second semester</a></li>
                  <li class="list-group-item text-center link2"><a href="#">300 LEVEL</a></li>
                  <li style ="display:none" class="list-group-item text-center semester2"><a  href="course_allocation_view.php?level=300&semester=1">first semester</a></li>
                  <li style ="display:none" class="list-group-item text-center semester2"><a  href="course_allocation_view.php?level=300&semester=2">second semester</a></li>
                  <li class="list-group-item text-center link3"><a href="#">400 LEVEL</a></li>
                  <li style ="display:none" class="list-group-item text-center semester3"><a  href="course_allocation_view.php?level=400&semester=1">first semester</a></li>
                  <li style ="display:none" class="list-group-item text-center semester3"><a  href="course_allocation_view.php?level=400&semester=2">second semester</a></li>
                </ul>
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
    <script>
      $(document).ready(function(){
        $('.link').click(function(){
          var value = $('.link a').text();
          $('.semester').slideToggle();
        });
        $('.link1').click(function(){
          var value = $('.link a').text();
          $('.semester1').slideToggle();
        });
        $('.link2').click(function(){
          var value = $('.link a').text();
          $('.semester2').slideToggle();
        });
        $('.link3').click(function(){
          var value = $('.link a').text();
          $('.semester3').slideToggle();
        });
      });
    </script>
  </div>
</div>
</body>

</html>
