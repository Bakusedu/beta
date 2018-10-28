<?php require_once '../core/init.php'; ?>
<?php
  if(!isset($_GET['id'])){
    redirectTo('student_list.php');
  }
  $admin->id = intval($_GET['id']);
  $result = $admin->deleteStudent();
  if($result){
    $pic = $admin->getSPicture($admin->id);
    $image_directory = "../../images/pictures/";
    if(file_exists($image_directory.$pic)) {
      if($$pic != 'user.png'){
        unlink($image_directory.$pic);
      }
    }
    $delete = $admin->deleteSPic();
    if($delete){
      $session->message('Profile deleted successfully');
      redirectTo('student_list.php');
    }
  }
 ?>
