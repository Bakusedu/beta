<?php require_once '../core/init.php'; ?>
<?php
  if(!isset($_GET['id'])){
    redirectTo('lecturer_list.php');
  }
  $admin->id = intval($_GET['id']);
  $result = $admin->deleteLecturer();
  if($result){
    $pic = $admin->getLPicture($admin->id);
    $image_directory = "../../images/pictures/";
    if(file_exists($image_directory.$pic)) {
      if($pic != 'user.png'){
        unlink($image_directory.$pic);
      }
    }
    $delete = $admin->deleteLPic();
    if($delete){
      $session->message('Profile deleted successfully');
      redirectTo('lecturer_list.php');
    }
  }
 ?>
