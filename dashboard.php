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
    $pickeddate = date('Y-m-d');

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

    $sql_query1 = "select CourseCode, mark, grade from semesterresults where year = '100' and student_id='" . $loggedinfo . "'";
    $resultance100 = mysqli_query($con, $sql_query1);
    $rowsno100 = mysqli_num_rows($resultance100);

    $sql_query1 = "select CourseCode, mark, grade from semesterresults where year = '200' and student_id='" . $loggedinfo . "'";
    $resultance200 = mysqli_query($con, $sql_query1);
    $rowsno200 = mysqli_num_rows($resultance200);

    $sql_query1 = "select CourseCode, mark, grade from semesterresults where year = '300' and student_id='" . $loggedinfo . "'";
    $resultance300 = mysqli_query($con, $sql_query1);
    $rowsno300 = mysqli_num_rows($resultance300);

    $sql_query1 = "select CourseCode, mark, grade from semesterresults where year = '400' and student_id='" . $loggedinfo . "'";
    $resultance400 = mysqli_query($con, $sql_query1);
    $rowsno400 = mysqli_num_rows($resultance400);

    $sql_query1 = "select CourseCode, mark, grade from semesterresults where mark < '50' and student_id='" . $loggedinfo . "'";
    $resultanceFailed = mysqli_query($con, $sql_query1);
    $rowsnoFailed = mysqli_num_rows($resultanceFailed);
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
                            <div aria-labelledby="languages" class="dropdown-menu"><a rel="nofollow" href="#" class="dropdown-item"> <img src="img/flags/16/DE.png" alt="English" class="mr-2"><span>German</span></a><a rel="nofollow" href="#" class="dropdown-item"> <img src="img/flags/16/FR.png" alt="English" class="mr-2"><span>French </span></a></div>
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
                    <li class="active">
                        <a href="dashboard.php"> <i class="icon-home"></i>Home </a>
                    </li>
                    <li>
                        <a href="results.php"> <i class="icon-padnote"></i>View Results </a>
                    </li>
                    <li>
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
                                        <div class="stats-2-content"><span class="d-block">Student Name</span><strong class="d-block"><?php echo $name3 . " " . $name2 . " " . $name1 ?></strong>
                                            <div class="progress progress-template progress-small">
                                                <div role="progressbar" style="width: 100%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template progress-bar-small dashbg-6"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="stats-2 d-flex">
                                        <div class="stats-2-arrow height"></i></div>
                                        <div class="stats-2-content"><span class="d-block">Date of Birth</span><strong class="d-block"><?php echo $dateofbirth ?></strong>
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
                                        <div class="item"><strong class="d-block strong-sm"></strong><span class="d-block span-sm">UNDERGRADUATE</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="stats-2-block block d-flex">
                                    <div class="stats-2 d-flex">
                                        <div class="stats-2-arrow low"></i></div>
                                        <div class="stats-2-content"><span class="d-block">Cuurent Study Level</span><strong class="d-block"><?php echo $level ?></strong>
                                            <div class="progress progress-template progress-small">
                                                <div role="progressbar" style="width: 100%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template progress-bar-small dashbg-6"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="stats-2 d-flex">
                                        <div class="stats-2-arrow height"></i></div>
                                        <div class="stats-2-content"><span class="d-block">Student Address</span><strong class="d-block"><?php echo $studentaddress ?></strong>
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
                <a href="#" data-toggle="modal" data-target="#myModal1">Open me</a>
                <div id="myModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" data-dismiss="modal" aria-label="Close" class="close"> <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="year-grid">
                                <div onclick="showResult('res100')" class="year">100 Level</div>
                                <div onclick="showResult('res200')" class="year">200 Level</div>
                                <div onclick="showResult('res300')" class="year">300 Level</div>
                                <div onclick="showResult('res400')" class="year">400 Level</div>
                            </div>
                            <div id="printable">
                                <div class="block margin-bottom-sm">
                                    <?php
                                    $resultrowFF = mysqli_fetch_assoc($resultanceFailed);
                                    if (count($resultrowFF) == 0) {
                                        echo "
                                        <div id='resfailed' class='table-responsive'>
                                        <h3 style='margin: 25px auto; max-width: 95%; text-align: center;'>No Outstanding courses</h3>
                                        <p style='margin: 10px; max-width: 95%;text-align: center;'>Congratulations, You have met the minimum requirements to be awarded a Bachelor's Degree in Computer Science</p>
                                        <p style='margin: 10px; max-width: 95%;text-align: center;'>You have been successfully added into the Graduating Class List.</p>
                                        </div>
                                        ";
                                        echo '<div id="resfailed" class="table-responsive" style="display: none;">';
                                    } else {
                                        echo '<div id="resfailed" class="table-responsive">';
                                    }
                                    ?>
                                    <h3 style="margin: 25px auto; max-width: 95%; text-align: center;">Outstanding courses</h3>
                                    <p style="margin: 10px; max-width: 95%;text-align: center;">Sorry, you do not meet the minimum requirements to be awarded a Bachelor's Degree in Computer Science, as you have a failing grade in the following course(s): </p>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Course Code</th>
                                                <th>Your Score</th>
                                                <th>Your Grade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql_query1 = "select CourseCode, mark, grade from semesterresults where mark < '50' and student_id='" . $loggedinfo . "'";
                                            $resultanceFailed = mysqli_query($con, $sql_query1);
                                            while ($resultrow = mysqli_fetch_assoc($resultanceFailed)) {
                                                echo "<tr>";
                                                echo "<td>" . $resultrow["CourseCode"] . "</td>";
                                                echo "<td>" . $resultrow["mark"] . "</td>";
                                                echo "<td>" . $resultrow["grade"] . "</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <p style="margin: 20px; max-width: 95%;">If you feel there are any mistakes with any of there courses and you would like to go through the result reconcilation process please <a href="reconcile.php">click here.</a></p>
                                </div>
                                <div id='res100' class="table-responsive">
                                    <h3 style="margin: 25px auto; width: 100%; text-align: center;">100 Level</h3>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Course Code</th>
                                                <th>Your Score</th>
                                                <th>Your Grade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($rowsno100 > 0) {
                                                // output data of each row
                                                while ($resultrow = mysqli_fetch_assoc($resultance100)) {
                                                    echo "<tr>";
                                                    echo "<td>" . $resultrow["CourseCode"] . "</td>";
                                                    echo "<td>" . $resultrow["mark"] . "</td>";
                                                    echo "<td>" . $resultrow["grade"] . "</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "0 results";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div id='res200' class="table-responsive">
                                    <h3 style="margin: 25px auto; width: 100%; text-align: center;">200 Level</h3>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Course Code</th>
                                                <th>Your Score</th>
                                                <th>Your Grade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($rowsno200 > 0) {
                                                // output data of each row
                                                while ($resultrow = mysqli_fetch_assoc($resultance200)) {
                                                    echo "<tr>";
                                                    echo "<td>" . $resultrow["CourseCode"] . "</td>";
                                                    echo "<td>" . $resultrow["mark"] . "</td>";
                                                    echo "<td>" . $resultrow["grade"] . "</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "0 results";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div id='res300' class="table-responsive">
                                    <h3 style="margin: 25px auto; width: 100%; text-align: center;">300 Level</h3>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Course Code</th>
                                                <th>Your Score</th>
                                                <th>Your Grade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($rowsno300 > 0) {
                                                // output data of each row
                                                while ($resultrow = mysqli_fetch_assoc($resultance300)) {
                                                    echo "<tr>";
                                                    echo "<td>" . $resultrow["CourseCode"] . "</td>";
                                                    echo "<td>" . $resultrow["mark"] . "</td>";
                                                    echo "<td>" . $resultrow["grade"] . "</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "0 results";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div id='res400' class="table-responsive">
                                    <h3 style="margin: 25px auto; width: 100%; text-align: center;">400 Level</h3>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Course Code</th>
                                                <th>Your Score</th>
                                                <th>Your Grade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($rowsno400 > 0) {
                                                // output data of each row
                                                while ($resultrow = mysqli_fetch_assoc($resultance400)) {
                                                    echo "<tr>";
                                                    echo "<td>" . $resultrow["CourseCode"] . "</td>";
                                                    echo "<td>" . $resultrow["mark"] . "</td>";
                                                    echo "<td>" . $resultrow["grade"] . "</td>";
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
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
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
    <script>
        $(window).on('load', function() {
            $('#myModal1').modal('show');
        });

        function showResult(value) {
            document.getElementById('res100').style.display = 'none';
            document.getElementById('res200').style.display = 'none';
            document.getElementById('res300').style.display = 'none';
            document.getElementById('res400').style.display = 'none';
            document.getElementById(value).style.display = 'unset';
        }
    </script>

    <style>
        .year-grid {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            flex-wrap: wrap;
            width: 95%;
            align-self: center;
            border: 1px solid #28a745;
            border-bottom: none;
            border-right: none;
        }

        .year {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50%;
            padding: 10px 0;
            border-bottom: 1px solid #28a745;
            border-right: 1px solid #28a745;
            cursor: pointer;
        }

        .year:hover {
            background: #28a74530;
        }

        #res100,
        #res200,
        #res300,
        #res400 {
            display: none;
        }
    </style>

    </html>
<?php } ?>