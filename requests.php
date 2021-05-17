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

    $getrequests = "SELECT * from reconcile where studentID='".$loggedinfo."'";
    $requestStatus = mysqli_query($con, $getrequests);
    $requestresult = mysqli_num_rows($requestStatus);

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
                <li>
                    <a href="reconcile.php"> <i class="fa fa-bar-chart"></i>Reconcile Result</a>
                </li>
                <li class="active">
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
                                        <div class="icon"><i class="fa fa-table"></i></div><strong>View Request History</strong>
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
                
                
                    <div class="block margin-bottom-sm">
                    <div class="title"><strong>Request Summary</strong></div>
                    <div class="table-responsive"> 
                        <table class="table table-striped">
                        <thead>
                            <tr>
                            <th>Matric Number</th>
                            <th>Affected Semester</th>
                            <th>Date Submitted</th>
                            <th>Request ID</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                        if ($requestresult > 0) {
                                            // output data of each row
                                            while ($requestrow = mysqli_fetch_assoc($requestStatus)) {
                                                echo "<tr>";
                                                echo "<td>" . $requestrow["studentID"] . "</td>";
                                                echo "<td>" . $requestrow["affectedSemester"] . "</td>";
                                                echo "<td>" . $requestrow["requestdate"] . "</td>";
                                                echo "<td>" . $requestrow["requestID"] . "</td>";
                                                
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                        ?>
                        </tbody>
                        </table>
                
             
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
    <script>
         function getName(x, y) {
                    $length = rand($x, $y);
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $randomString = '';

                    for ($i = 0; $i < $length; $i++) {
                        $randomString = $characters[rand(0, strlen($characters) - 1)];
                    }

                    return $randomString;
                }
    </script>
    
</body>

</html>
<?php } ?>