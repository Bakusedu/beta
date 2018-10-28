<?php
include '../core/init.php';
if(!isset($_GET['id'])){
  redirectTo('assessment.php');
}
restricted();
$courseid = intval($_GET['id']);
$_SESSION['courseid'] = $courseid;
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link href="../../CSS/bootstrap.min.css" rel="stylesheet">

     <link href="../../CSS/bootstrap.min2.css" rel="stylesheet">

     <link href="../../fonts/css/font-awesome.min.css" rel="stylesheet">
     <title>Examination</title>
     <style>
       body {
         color:white;
       }
     </style>
   </head>
   <body>
     <?php $res = $lecturer->getName($courseid); ?>
     <?php $results = $lecturer->registeredStudents($courseid,$_SESSION['us3rid']); ?>
       <?php $i = 1;?>
       <?php if($results):?>
         <div class="container">
           <div class="row">
             <div class="col-md-12">
               <div class="col-md-5">
                 <h3><strong><?php echo $res['name'] ?></strong> Student Examination</h3>
                 <a href="dashboard.php" class="btn btn-info mb-2"><strong><i class="fa fa-home"></i> Dashboard</strong></a>
               </div>
               <div class="col-md-7 mt-4">
                 <form class="form-inline pull-right" action="#" method="get">
                   <div class="input-group">
                     <input type="text" name="s" class="form-control"  placeholder="Search Records...">
                     <div class="input-group-btn">
                       <button type="button" class="btn btn-primary">
                         <i class="fa fa-search"></i>
                       </button>
                     </div>
                   </div>
                 </form>
                </div>
             </div>
           </div>
           <div class="col-md-12">
             <div class="panel panel-primary">
               <ul class="list-group">
                 <li class="list-group-item text-center"><a href="course_assessment.php?id=<?php echo $_SESSION['courseid'] ?>"><i class="fa fa-user"></i> <strong><?php echo $res['name']?></strong> Assessment</a></li>
                 <li class="list-group-item text-center"><a href="upload_view.php?id=<?php echo $_SESSION['courseid'] ?>"><i class="fa fa-graduation-cap"></i> <strong><?php echo $res['name'] ?></strong> Result</a></li>
               </ul>
             </div>
           </div>
         </div>
      <div class="container">
        <div class="col-md-12 table-responsive">
          <form  action="assessment_processing.php" method="post">
          <table class="table">
          <thead>
            <th>S/N</th>
            <th>Names</th>
            <th>Regnum</th>
            <th>Gender</th>
            <?php $total = 0; ?>
          </thead>
          <tbody>
              <div class="form-group">
              <?php foreach ($results as $result ): ?>

              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $result['name']; ?></td>
                <td><?php echo $result['regnum']; ?></td>
                <td><?php echo $result['gender']; ?></td>
                <?php $true = $student->checkStudent($result['studentid'],$_SESSION['courseid']); ?>
                <?php $update = $student->getExamination($result['studentid'],$_SESSION['courseid']); ?>
                <?php if($true): ?>
                  <?php if($update['exam_score'] == NULL): ?>
                    <td><a class="btn btn-success" href="examination_processing.php?id=<?php echo $result['studentid']?>">Enter score</a></td>
                <?php else: ?>
                  <td><a class="btn btn-success" href="examination_processing.php?id=<?php echo $result['studentid']?>">Update score</a></td>
                <?php endif; ?>
              <?php else: ?>
                <td><a class="btn btn-success" href="examination_processing.php?id=<?php echo $result['studentid']?>">Enter score</a><span class=".small text-danger"> No assessment</span></td>
              <?php endif; ?>
                <?php $i = $i + 1;?>
                <!-- <td></td> -->
              </tr>
            <?php endforeach;?>
            </div>
          </tbody>
          </table>
        </form>
      </div>
    <?php else:?>
      <div class="container">
        <div class="row">
          <p class="alert alert-info col-md-12 text-center">No registered Students Currently!</p>
        </div>
      </div>
    <?php endif; ?>
   </body>
  </html>
