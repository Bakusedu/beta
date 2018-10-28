<?php require_once '../core/init.php'; ?>
<?php
  if(!isset($_GET['id'])){
    redirectTo('student.php');
  }
  $id = intval($_GET['id']);
  $errors = NULL;
  if(isset($_POST['update'])){

    //process form first

    $admin->name = sanitize('name');
    $admin->regnum = sanitize('regnum');
    $admin->gender = isset($_POST['gender']) ? $_POST['gender'] : 'N/A';
    $admin->email = sanitize('email');
    $admin->id = $id;
    //Validate form input

    if(!filter_var($admin->email,FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Email is invalid.";
    }
    if(is_numeric($admin->name)){
      $errors[] = "invalid name";
    }
    if(empty($admin->regnum)){
      $erors[] = 'Regnum field empty';
    }

    Photograph::$upload_dir = "../../images/buffer/";
    $image_directory = "../../images/pictures/";
    $old_photo = $_POST['foto'];

    $file = $_FILES['photo'];
    if($file['error'] == 4){
      if(empty($errors)){
         $result = $admin->updateStudent();
        if($result){
          $session->message('Account updated successfully');
          redirectTo('student_list.php');
         }
      }
    }
    else{
      // Attempt to upload and save file
      if (empty($errors)) {
          //lecturers photo
          if ($photo->attach_file($file)) {
            // Get filename
            $student->photo = $photo->filename;
            // Upload and save the file
            if ($photo->save()) {
              // Save a copy in the database
              $student->id = $id;
              $result = $student->studentInfo();
              if ($result){
                // Resize the uploaded photo
                $resize->load(Photograph::$upload_dir.$photo->filename);
                $resize->resizeToWidth(600);
                $resize->save($image_directory.$photo->filename);

                // Delete original file in buffer directory
                if (file_exists(Photograph::$upload_dir.$photo->filename)) {
                  unlink(Photograph::$upload_dir.$photo->filename);
                }
                if($result == 'Updated'){
                  if($old_photo != 'user.png'){
                    if (file_exists($image_directory.$old_photo)) {
                      unlink($image_directory.$old_photo);
                    }

                  }
                }

              }
            }
            else {
              $errors[] = join("<br>", $photo->errors);
            }
          }
          else {
            $errors[] = join("<br>", $photo->errors);
          }
        }
        if(empty($errors)){
           $result = $admin->updateStudent();
          if($result){
            $session->message('Account updated successfully');
            redirectTo('student_list.php');
           }
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
            <form action="student_update.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
              <fieldset>
                <?php $pic = $admin->getSPicture($id); ?>
                <?php $info = $admin->getStudentInfo($id); ?>
                <h4>Update student profile</h4>
                <div class="row">
                  <div class="form-group">
                    <input type="file" class="form-control" name="photo">
                  </div>
                  <div class="pull-right">
                    <img src="../../images/pictures/<?php echo $pic; ?>"  width="50%" alt="">
                  </div>

                </div>
                <div class="form-group">
                  <label for="name">Full name</label>
                  <input type="text" class="form-control" name="name" placeholder="<?php echo stickyForm('name'); ?>" value="<?php echo $info['name'];  ?>">
                </div>
                <div class="form-group">
                  <label for="regnum">Regnum</label>
                  <input type="text" class="form-control" name="regnum" placeholder="<?php echo stickyForm('regnum'); ?>" value="<?php echo $info['regnum']; ?>">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" name="email" placeholder="<?php echo stickyForm('email'); ?>" value="<?php echo $info['email']; ?>">
                </div>
                <div class="form-group">
                  <label>Gender</label><br>
                  <input type="radio" name="gender" value="Male"> Male
                  <input type="radio" name="gender" value="Female"> Female
                  <input type="hidden" name="foto" value="<?php echo $pic; ?>">
                </div>
                <div class="form-group">
                  <button type="submit" name="update" class="btn btn-primary"><i class="fa fa-user"></i> Update</button>
                </div>
              </fieldset>
            </form>
          </div>
          <div class="col-md-3">
            <div class="panel panel-primary">
              <ul class="list-group">
                <li class="list-group-item"><a href="student_list.php"><i class="fa fa-user"></i> Student profile</a></li>
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
