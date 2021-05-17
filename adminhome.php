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
    require 'db.php';
    $loggedinfo = $_SESSION['uname'];
    $pickeddate = date('Y-m-d');

    $sql_query = "select * from staff where email='" . $loggedinfo . "'";
    $result = mysqli_query($con, $sql_query);
    $row = mysqli_fetch_array($result);
    $name1 = $row['firstName'];
    $name2 = $row['lastName'];
    $department = $row['department'];
    $staffPost = $row['staffPost'];
    $staffID = $row['staff_ID'];
    $combineFullName = $name1 ." ". $name2;
  
    $sql_query1 = "select * from reconcile where lecturerName='" . $combineFullName . "'";
    $resultance = mysqli_query($con, $sql_query1);
    $rowsno = mysqli_num_rows($resultance);
    $rowsfetch = mysqli_fetch_array($resultance);
    $rid = $rowsfetch['requestID'];

    //$sql_query1 = "select email from orders where email='" . $loggedinfo . "'";
    //$resultance = mysqli_query($con, $sql_query1);
    //$rowsno = mysqli_num_rows($resultance);

    //$pickeddate = date('Y-m-d H:i:s');
    /**$sql_query2 = "select due_date from orders where email='" . $loggedinfo . "' and due_date> '" . $pickeddate . "'  ";
    $resultant = mysqli_query($con, $sql_query2);
    $rowsno1 = mysqli_num_rows($resultant);

    $sql_query3 = "select due_date from orders where email='" . $loggedinfo . "' and due_date< '" . $pickeddate . "'  ";
    $resultant1 = mysqli_query($con, $sql_query3);
    $rowsno2 = mysqli_num_rows($resultant1); **/

    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

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
                    <h1 class="h5"><?php echo $name1 ?> <?php echo $name2 ?></h1>
              </div>
            </div>
            <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
            <ul class="list-unstyled">
                <li class="active">
                    <a href="adminhome.php"> <i class="icon-home"></i>Home </a>
                </li>
                <li>
                    <a href="admindashboard1.php"> <i class="icon-padnote"></i>Student Requests</a>
                </li>
            </ul>

        </nav>
        <!-- Sidebar Navigation end-->
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">RRS Staff Dashboard</h2>
                </div>
            </div>
            <section class="no-padding-top no-padding-bottom">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="statistic-block block">
                                <div class="progress-details d-flex align-items-end justify-content-between">
                                    <div class="title">
                                        <div class="icon"><i class="icon-user-1"></i></div><strong>Personal Information</strong>
                                    </div>
                                    <div class="number dashtext-1"></div>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </section>



            <section class="no-padding-bottom">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">

                            <div class="stats-2-block block d-flex">
                                <div class="stats-2 d-flex">
                                    <div class="stats-2-arrow low"></i></div>
                                    <div class="stats-2-content"><span class="d-block">Staff Name</span><strong class="d-block"><?php echo $name2. " ". $name1 ?></strong>
                                        <div class="progress progress-template progress-small">
                                            <div role="progressbar" style="width: 100%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template progress-bar-small dashbg-6"></div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>

                            <div class="stats-3-block block d-flex">
                                <div class="stats-3"><span class="d-block">Department</span><strong class="d-block"><?php echo $department ?></strong>
                                    <div class="progress progress-template progress-small">
                                        <div role="progressbar" style="width: 100%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template progress-bar-small dashbg-6"></div>
                                    </div>
                                </div>
                                <div class="stats-3 d-flex justify-content-between text-center">
                                    <div class="item"><strong class="d-block strong-sm"></strong><span class="d-block span-sm">Academic Staff</span><strong class="d-block"><?php echo $staffPost ?></strong> 
                                                                     
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="stats-2-block block d-flex">
                                    <div class="stats-2 d-flex">
                                        <div class="stats-2-arrow low"></i></div>
                                        <div class="stats-2-content"><span class="d-block">Staff ID</span><strong class="d-block"><?php echo $staffID ?></strong>
                                            <div class="progress progress-template progress-small">
                                                <div role="progressbar" style="width: 100%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template progress-bar-small dashbg-6"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="stats-2-arrow height"></i></div>
                                        <div class="stats-2-content"><span class="d-block">Email</span><strong class="d-block"><?php echo $loggedinfo ?></strong>
                                            <div class="progress progress-template progress-small">
                                                <div role="progressbar" style="width: 100%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template progress-bar-small dashbg-6"></div>
                                            </div>
                                        </div>
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
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js">
    </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js">
    </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/charts-home.js"></script>
    <script src="js/front.js"></script>
    
</body>

</html>
<?php } ?>