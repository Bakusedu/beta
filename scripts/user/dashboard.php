<?php
  include '../core/init.php';
  restricted();
    $user_id = $_SESSION['us3rid'];
    $priviledges = $_SESSION['priviledges'];
    if($priviledges == 1){
      $regnum = $_SESSION['regnum'];
      $department = $_SESSION['department'];
      $level = $_SESSION['level'] ;
      $email = $_SESSION['email'];
      $gender = $_SESSION['gender'];
      $name = $_SESSION['name'];
    }
    elseif($priviledges == 2){
      $department = $_SESSION['department'];
      $email = $_SESSION['email'];
      $gender = $_SESSION['gender'];
      $name = $_SESSION['name'];
    }
    $_SESSION['semester'] = $admin->getSemester();
    $student->id = $user_id;
    $lecturer->id = $user_id;
  if (isset($_POST['upload'])){
    //handle file upload
    $file = $_FILES['photo'];
    Photograph::$upload_dir = "../../images/buffer/";
    $image_directory = "../../images/pictures/";
    $old_photo = $_POST['foto'];

    // Attempt to upload and save file
    if (empty($errors)) {
      if($_SESSION['priviledges'] == '2'){
        //lecturers photo
        if ($photo->attach_file($file)) {
          // Get filename
          $lecturer->photo = $photo->filename;
          // Upload and save the file
          if ($photo->save()) {
            // Save a copy in the database
            $result = $student->lecturerInfo();
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
                if (file_exists($image_directory.$old_photo)) {
                  unlink($image_directory.$old_photo);
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
      elseif($_SESSION['$priviledges'] == '1'){
        if ($photo->attach_file($file)) {
          // Get filename
          $student->photo = $photo->filename;
          // Upload and save the file
          if ($photo->save()) {
            // Save a copy in the database
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
                if (file_exists($image_directory.$old_photo)) {
                  unlink($image_directory.$old_photo);
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
    }
  }

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>D.M.S</title>

    <!-- Bootstrap core CSS -->

    <link href="../../CSS/bootstrap.min2.css" rel="stylesheet">

    <link href="../../fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../CSS/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="../../CSS/custom1.css" rel="stylesheet">
    <link href="../../CSS/icheck/flat/green.css" rel="stylesheet">


    <script src="../../js/jquery.min.js"></script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.php" class="site_title"><i class="fa fa-laptop"></i> <span>D.M.S</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">



                        </div>
                        <div class="profile_info">
                            <span>Welcome,<?php echo $name; ?></span>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

 <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a href="year1.php"><i class="fa fa-home"></i> Home </a>
                                    <ul class="nav child_menu" style="display: none">
                                           <li><a href="year1.php">Profile</a>
                                        </li>

                                    </ul>
                                </li>

                               <li><a><i class="fa fa-book"></i> Courses <span class="fa fa-chevron-down"></span></a>
                                 <ul class="nav child_menu" style="display:none">

                                   <?php if($priviledges == 1): ?>
                                      <li><a><i class="fa fa-table"></i>Register Courses<span class="fa fa-chevron-down"></span></a>
                                        <?php if($admin->getSemester() == '1'): ?>
                                          <li><a href="register_courses.php">1st Semester</a></li>
                                        <?php else: ?>
                                          <li><a href="register_courses.php">2nd Semester</a></li>
                                        <?php endif; ?>
                                        </li>

                                       <li><a href="view_courses.php"><i class="fa fa-table"></i>View Registerd Courses</a></li>
                                     <?php else: ?>
                                       <?php $result = $lecturer->getCourse($_SESSION['us3rid'],$_SESSION['semester']);?>
                
                                       <?php if($result): ?>
                                         <?php foreach($result as $res): ?>
                                         <li><a href='view_registered.php?id=<?php echo $res['id']; ?>'><?php echo $res['name']; ?></a><span class="badge"><?php $count = $lecturer->count($res['id'],$_SESSION['us3rid']);echo $count["0"]["COUNT(*)"];  ?>
                                         </span></li>
                                       <?php endforeach;?>
                                     <?php endif;endif; ?>
                                       <li><a href="study_table.php"><i class="fa fa-calendar-o"></i> Timetable <!-- <span class="fa fa-chevron-down"></span>--></a></li>

                                       <li><a href="exam_table.php"><i class="fa fa-calendar"></i> Examination Timetable <!-- <span class="fa fa-chevron-down"></span>--></a></li>

                                 </ul>

                               </li>

                                <li><a><i class="fa fa-book"></i> Results <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                      <?php if($priviledges == 2): ?>
                                        <li class="current-page"><a href="assessment.php">Assessment</a>
                                        </li>
                                        <li class="current-page"><a href="examination.php">Examination</a>
                                        </li>
                                        <li class="current-page"><a href="upload_result.php">Upload result</a>
                                        </li>
                                      <?php else: ?>
                                        <li class="current-page"><a href="view_assessment.php">View Assessment</a>
                                        </li>
                                        <li class="current-page"><a href="view_result.php">View Result</a>
                                        </li>
                                        <li><a href="record.php"> Records </a></li>
                                      <?php endif; ?>
                                    </ul>
                                </li>
                                <li><a href="contactadmin.php"><i class="fa fa-envelope-o"></i> Contact Admin</a></li>

                            </ul>
                        </div>

                    </div>                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                        <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a href="logout.php" data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="year1.php">  Profile</a>
                                    </li>
                                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->

            <!--
            ============HOME===================
             page content
            -->
            <div class="right_col" role="main">

<div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>User Profile</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>User Report <small>Activity report</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="edit.php?id=<?php echo $user_id; ?>">Edit Profile</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                                      <?php
                                        if($_SESSION['priviledges'] == '2'){
                                          $result = $lecturer->getLPicture();
                                        }
                                        else{
                                          $result = $student->getPicture();
                                      }
                                       ?>
                                       <div class="profile_img">
                                         <img src="<?php echo "../../images/pictures/".$result ?>" class="img-responsive" alt="">


                                       </div>

                                        <ul class="list-unstyled user_data">
                                          <form action="dashboard.php" method="post" enctype="multipart/form-data">

                                              <div class="form-group">
                                                <label for="photo">Change Picture</label>
                                                <input type="file" id="photo" name="photo">
                                                <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                                                <input type="hidden" name="foto" value="<?php echo $result ?>">
                                              </div>
                                              <li><input type="submit" class="btn btn-success" name="upload" value="Upload"></li>
                                          </form>


                                        </ul>
                                        <br />

                                    </div>
                                    <div class="col-md-9 col-sm-9 col-xs-12">

                                        <div class="profile_title">
                                          <?php if($priviledges == 1): ?>
                                            <div class="col-md-6">
                                                <h2>User Information</h2>
                                            </div>
                                          <?php else: ?>
                                            <div class="col-md-6">
                                                <h2>Lecturer Information</h2>
                                            </div>
                                          <?php endif; ?>
                                            <div class="col-md-6">
                                                <div id="reportrange" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
                                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                                    <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if($priviledges == 1): ?>
                                        <div class="col-12 table-responsive">
                                          <table class="table">
                                          <thead>
                                            <th>Name</th>
                                            <th>Registeration Number</th>
                                            <th>Department</th>
                                            <th>Level</th>
                                            <th>Gender</th>
                                            <th>Email</th>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td><?php echo $name; ?></td>
                                              <td><?php echo $regnum; ?></td>
                                              <td><?php echo $department; ?></td>
                                              <td><?php echo $level; ?></td>
                                              <td><?php echo $gender; ?></td>
                                              <td><?php echo $email; ?></td>
                                            </tr>
                                          </tbody>
                                          </table>

                                        </div>
                                      <?php else: ?>
                                        <div class="col-12 table-responsive">
                                          <table class="table">
                                          <thead>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Gender</th>
                                            <th>Email</th>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td><?php echo $name; ?></td>
                                              <td><?php echo $department; ?></td>
                                              <td><?php echo $gender; ?></td>
                                              <td><?php echo $email; ?></td>
                                            </tr>
                                          </tbody>
                                          </table>

                                        </div>
                                      <?php endif; ?>
                                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                            <div id="myTabContent" class="tab-content">
                                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                        </div>

                <!-- footer content -->

                <footer>
                    <div class>
                        <p class="pull-right">TECH-18 ||
                            <span class="lead"> <i class="fa fa-laptop"></i> TECH-18</span>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
            <!-- /page content -->

        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>
    <script src="../js/bootstrap.min.js"></script>

    <!-- gauge js -->
    <script type="text/javascript" src="../../js/gauge/gauge.min.js"></script>
    <script type="text/javascript" src="../../js/gauge/gauge_demo.js"></script>
    <!-- chart js -->
    <script src="../../js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="../../js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="../../js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="../../js/icheck/icheck.min.js"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="../../js/moment.min.js"></script>
    <script type="text/javascript" src="../../js/datepicker/daterangepicker.js"></script>

    <script src="../../js/custom.js"></script>

    <!-- flot js -->
    <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
    <script type="text/javascript" src="../../js/flot/jquery.flot.js"></script>
    <script type="text/javascript" src="../../js/flot/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="../../js/flot/jquery.flot.orderBars.js"></script>
    <script type="text/javascript" src="../../js/flot/jquery.flot.time.min.js"></script>
    <script type="text/javascript" src="../../js/flot/date.js"></script>
    <script type="text/javascript" src="../../js/flot/jquery.flot.spline.js"></script>
    <script type="text/javascript" src="../../js/flot/jquery.flot.stack.js"></script>
    <script type="text/javascript" src="../../js/flot/curvedLines.js"></script>
    <script type="text/javascript" src="../../js/flot/jquery.flot.resize.js"></script>
    <script>
        $(document).ready(function () {
            // [17, 74, 6, 39, 20, 85, 7]
            //[82, 23, 66, 9, 99, 6, 2]
            var data1 = [[gd(2012, 1, 1), 17], [gd(2012, 1, 2), 74], [gd(2012, 1, 3), 6], [gd(2012, 1, 4), 39], [gd(2012, 1, 5), 20], [gd(2012, 1, 6), 85], [gd(2012, 1, 7), 7]];

            var data2 = [[gd(2012, 1, 1), 82], [gd(2012, 1, 2), 23], [gd(2012, 1, 3), 66], [gd(2012, 1, 4), 9], [gd(2012, 1, 5), 119], [gd(2012, 1, 6), 6], [gd(2012, 1, 7), 9]];
            $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
                data1, data2
            ], {
                series: {
                    lines: {
                        show: false,
                        fill: true
                    },
                    splines: {
                        show: true,
                        tension: 0.4,
                        lineWidth: 1,
                        fill: 0.4
                    },
                    points: {
                        radius: 0,
                        show: true
                    },
                    shadowSize: 2
                },
                grid: {
                    verticalLines: true,
                    hoverable: true,
                    clickable: true,
                    tickColor: "#d5d5d5",
                    borderWidth: 1,
                    color: '#fff'
                },
                colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
                xaxis: {
                    tickColor: "rgba(51, 51, 51, 0.06)",
                    mode: "time",
                    tickSize: [1, "day"],
                    //tickLength: 10,
                    axisLabel: "Date",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Verdana, Arial',
                    axisLabelPadding: 10
                        //mode: "time", timeformat: "%m/%d/%y", minTickSize: [1, "day"]
                },
                yaxis: {
                    ticks: 8,
                    tickColor: "rgba(51, 51, 51, 0.06)",
                },
                tooltip: false
            });

            function gd(year, month, day) {
                return new Date(year, month - 1, day).getTime();
            }
        });
    </script>

    <!-- worldmap -->
    <script type="text/javascript" src="../../js/maps/jquery-jvectormap-2.0.1.min.js"></script>
    <script type="text/javascript" src="../../js/maps/gdp-data.js"></script>
    <script type="text/javascript" src="../../js/maps/jquery-jvectormap-world-mill-en.js"></script>
    <script type="text/javascript" src="../../js/maps/jquery-jvectormap-us-aea-en.js"></script>
    <script>
        $(function () {
            $('#world-map-gdp').vectorMap({
                map: 'world_mill_en',
                backgroundColor: 'transparent',
                zoomOnScroll: false,
                series: {
                    regions: [{
                        values: gdpData,
                        scale: ['#E6F2F0', '#149B7E'],
                        normalizeFunction: 'polynomial'
                    }]
                },
                onRegionTipShow: function (e, el, code) {
                    el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
                }
            });
        });
    </script>
    <!-- skycons -->
    <script src="../../js/skycons/skycons.js"></script>
    <script>
        var icons = new Skycons({
                "color": "#73879C"
            }),
            list = [
                "clear-day", "clear-night", "partly-cloudy-day",
                "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                "fog"
            ],
            i;

        for (i = list.length; i--;)
            icons.set(list[i], list[i]);

        icons.play();
    </script>

    <!-- dashbord linegraph -->
    <script>
        var doughnutData = [
            {
                value: 30,
                color: "#455C73"
            },
            {
                value: 30,
                color: "#9B59B6"
            },
            {
                value: 60,
                color: "#BDC3C7"
            },
            {
                value: 100,
                color: "#26B99A"
            },
            {
                value: 120,
                color: "#3498DB"
            }
    ];
        var myDoughnut = new Chart(document.getElementById("canvas1").getContext("2d")).Doughnut(doughnutData);
    </script>
    <!-- /dashbord linegraph -->
    <!-- datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {

            var cb = function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
            }

            var optionSet1 = {
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'left',
                buttonClasses: ['btn btn-default'],
                applyClass: 'btn-small btn-primary',
                cancelClass: 'btn-small',
                format: 'MM/DD/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Clear',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            };
            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
            $('#reportrange').daterangepicker(optionSet1, cb);
            $('#reportrange').on('show.daterangepicker', function () {
                console.log("show event fired");
            });
            $('#reportrange').on('hide.daterangepicker', function () {
                console.log("hide event fired");
            });
            $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
            });
            $('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
                console.log("cancel event fired");
            });
            $('#options1').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
            });
            $('#options2').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
            });
            $('#destroy').click(function () {
                $('#reportrange').data('daterangepicker').remove();
            });
        });
    </script>
    <script>
        NProgress.done();
    </script>
    <!-- /datepicker -->
    <!-- /footer content -->
</body>

</html>
