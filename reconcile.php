<?php
session_start();
?>
<?php
if (!isset($_SESSION['uname'])) {

    session_destroy();
    echo " <script type =\"text/javascript\">" .
        "window.alert('You have been logged out. Please click ok to sign in again');" .
        " window.location='index.php'; " .
        "</script> ";
} else {
?>
    <!--Picking values from database and creating variables to store them here-->
    <?php
    require 'db.php';
    $loggedinfo = $_SESSION['uname'];
    $requestid = substr(md5(uniqid(rand(), 1)), 3, 10);
    $requestdate = date("Y-m-d");

    $sql_query = "select firstName, middleName, lastName, dob, department, level, studentaddress from students where student_id='" . $loggedinfo . "'";
    $result = mysqli_query($con, $sql_query);
    $row = mysqli_fetch_array($result);
    $name1 = $row['firstName'];
    $name2 = $row['lastName'];
    $name3 = $row['middleName'];
    $dateofbirth = $row['dob'];
    $department = $row['department'];
    $level = $row['level'];
    $studentaddress = $row['studentaddress'];
$combinedStudentName = $name2 ." ". $name1;
    if (isset($_POST['reconcileSubmit'])) {
        $lfn = $_POST['lecturerFName'];
        $lln = $_POST['lecturerlName'];
        $rs = $_POST['reconcileScore'];
        $rct = $_POST['reconcileCourseTitle'];
        $rcc = $_POST['reconcileCourseCode'];
        $sa = $_POST['semesterAffected'];
        $combinedName = $lfn ." ". $lln;


        $query_reconcile = "INSERT into reconcile(studentName, studentID, studentDOB, studentLevel, studentDepartment, affectedSemester, courseCode, courseTitle, currentScore, lecturerName, requestID, requestdate) VALUES ('$combinedStudentName', '$loggedinfo', '$dateofbirth', '$level', '$department', '$sa', '$rcc', '$rct', '$rs', '$combinedName', '$requestid', '$requestdate')";
        $query_reconcile_result = mysqli_query($con, $query_reconcile);
        if(!$query_reconcile_result){
            echo "Error " . mysqli_error($con);
      
    } 
    else if($query_reconcile_result){
        echo(
             '<script>
        setTimeout(function() {
            swal({
                title: "Request Submitted Successful",
                text: "Click okay to go to home page",
                type: "success"
            }, function() {
                window.location = "dashboard.php";
            });
        }, 1000);
    </script>'
     );
    }
    }
      

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Request Reconciliation</title>
    <!-- Bootstrap CSS-->
     <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.sea.css" id="theme-stylesheet">
    <!-- Custom stylesheet - -->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Carousel-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
     <!-- Sweet Alert-->
    <script href="C/:wamp64/www/sites/rrs/node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    </head>
    <body>

    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <div class="search-panel">
                <div class="search-inner d-flex align-items-center justify-content-center">
                    <div class="close-btn">Close <i class="fa fa-close"></i></div>
                    <form id="searchForm" action="#">
                        <div class="form-group">
                            <input type="search" name="search" placeholder="What are you searching for...">
                            <button type="submit" class="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container-fluid d-flex align-items-center justify-content-between">
                <div class="navbar-header">
                    <!-- Navbar Header-->
                    <a href="index.html" class="navbar-brand">
                        <div class="brand-text brand-big visible text-uppercase">UNI HUB</div>
                        <div class="brand-text brand-sm">U.H</div>
                    </a>
                    <!-- Sidebar Toggle Btn-->
                    <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
                </div>
                <div class="right-menu list-inline no-margin-bottom">

                    <!-- Tasks-->

                    <!-- Tasks end-->
                    <!-- Megamenu-->

                    <div class="list-inline-item"> <a id="logout" class="nav-link">This is your result reconciliation system</a></div>
                    <!-- Megamenu end     -->
                    <!-- Languages dropdown    -->
                    <div class="list-inline-item dropdown"><a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle"><img src="img/flags/16/GB.png" alt="English"><span class="d-none d-sm-inline-block">English</span></a>
              <div aria-labelledby="languages" class="dropdown-menu"><a rel="nofollow" href="#" class="dropdown-item"> <img src="img/flags/16/DE.png" alt="English" class="mr-2"><span>German</span></a><a rel="nofollow" href="#" class="dropdown-item"> <img src="img/flags/16/FR.png" alt="English" class="mr-2"><span>French  </span></a></div>
            </div>
                    <!-- Log out               -->
                    <div class="list-inline-item logout"> <a id="logout" href="logout.php" class="nav-link">Logout <i class="icon-logout"></i></a></div>
                </div>
            </div>
        </nav>
    </header>
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        <nav id="sidebar">
            <!-- Sidebar Header-->
            <div class="sidebar-header d-flex align-items-center">
                <div class="avatar"><img src="img/user32.png" style="position:center" alt="..." class="img-fluid rounded-circle"></div>
                <div class="title">
                    <h1 class="h5"><?php echo $name1 ?> &nbsp;<?php echo $name3 ?> , <?php echo $name2 ?></h1>
              </div>
            </div>
            <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
            <ul class="list-unstyled">
                <li>
                    <a href="dashboard.php"> <i class="icon-home"></i>Home </a>
                </li>
                <li>
                    <a href="results.php"> <i class="icon-padnote"></i>View Results </a>
                </li>
                <li class="active">
                    <a href="reconcile.php"> <i class="fa fa-bar-chart"></i>Reconcile Result</a>
                </li>
                <li>
                    <a href="requests.php"> <i class="icon-grid"></i>View Request Status</a>
                </li>
            </ul>

        </nav>
        <!-- Sidebar Navigation end-->
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">RRS Student Dashboard</h2>
                </div>
            </div>

            <section class="no-padding-top no-padding-bottom">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="statistic-block block">
                                <div class="progress-details d-flex align-items-end justify-content-between">
                                    <div class="title">
                                        <div class="icon"><i class="fa fa-book"></i></div><strong>Fill the form appropriately</strong>
                                    </div>
                                    <div class="number dashtext-1"></div>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="no-padding-top">
          <div class="container-fluid">
            <div class="row">
             
              <!-- Form Elements -->
              <div class="col-lg-12">
                <div class="block">
                  <div class="title"><strong>Result Reconciliation Form</strong></div>
                  <div class="block-body">
                    <form method="POST" action="" class="form-horizontal">
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Student Name</label>
                        <div class="col-sm-9">
                          <input type="text" placeholder="<?php echo $name1 ?> &nbsp;<?php echo $name3 ?> , <?php echo $name2 ?>" class="form-control" name ="reconcileName" readonly>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Matric Number</label>
                        <div class="col-sm-9">
                          <input type="text" name="reconcileMatric" placeholder="<?php echo $loggedinfo ?>" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Date of Birth</label>
                        <div class="col-sm-9">
                          <input type="text" placeholder="<?php echo $dateofbirth ?>" name="reconcileDob" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Currrent Study Level</label>
                        <div class="col-sm-9">
                          <input type="text" disabled="" placeholder="<?php echo $level ?>" class="form-control">
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Department</label>
                        <div class="col-sm-9">
                          <input type="text" disabled="" placeholder="<?php echo $department ?>" class="form-control">
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Student Request <br></label>
                        <div class="col-sm-9">
                          <div class="i-checks">
                            <input id="checkboxCustom" type="checkbox" value="" disabled="" checked="" class="checkbox-template">
                            <label for="checkboxCustom">Result Reconciliation</label><p><small class="text-primary">You cannot edit this field</small></p>
                          </div>                          
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Affected Semester</label>
                        <div class="col-sm-9">
                          <select name="semesterAffected" class="form-control mb-3 mb-3">
                            <option>100 Level First Semester</option>
                            <option>100 Level Second Semester</option>
                            <option>200 Level First Semester </option>
                            <option>200 Level Second Semester</option>
                            <option>300 Level First Semester</option>
                            <option>300 Level Second Semester</option>
                            <option>400 Level First Semester</option>
                            <option>400 Level Second Semester</option>
                          </select>
                        </div>                      
                      </div>                     
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Course Details</label>
                        <div class="col-sm-9">
                          <div class="row">
                            <div class="col-md-3">
                              <input type="text" name="reconcileCourseCode" placeholder="Course Code" class="form-control" required />
                            </div>
                            <div class="col-md-4">
                              <input type="text" name="reconcileCourseTitle" placeholder="Course Title" class="form-control" required />
                            </div>
                            <div class="col-md-5">
                              <input type="number" name="reconcileScore" max="100" placeholder="Current Score (x%)" class="form-control" required/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Lecturer Details</label>
                        <div class="col-sm-9">
                          <div class="row">
                            <div class="col-md-3">
                              <input type="text" name="lecturerFName" placeholder="First Name" class="form-control" required />
                            </div>
                            <div class="col-md-4">
                              <input type="text" name="lecturerlName" placeholder="Last Name" class="form-control" required />
                            </div>                            
                          </div>
                        </div>
                      </div>
                      
                    
                      <div class="line"></div>
                      <div class="form-group row">
                        <div class="col-sm-9 ml-auto">                          
                          <button type="submit" name="reconcileSubmit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <footer class="footer">
                <div class="footer__block block no-margin-bottom">
                    <div class="container-fluid text-center">

                        <p class="no-margin-bottom">2021 &copy; unihub</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
        
    </body>
    </html>
    <?php } ?>