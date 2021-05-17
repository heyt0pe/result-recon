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

    $sql_query = "select * from staff where email='" . $loggedinfo . "'";
    $result = mysqli_query($con, $sql_query);
    $row = mysqli_fetch_array($result);
    $name1 = $row['firstName'];
    $name2 = $row['lastName'];
    $department = $row['department'];
    $combineFullName = $name1 ." ". $name2;
  
    $sql_query1 = "select * from reconcile where lecturerName='" . $combineFullName . "'";
    $resultance = mysqli_query($con, $sql_query1);
    $rowsno = mysqli_num_rows($resultance);
    $rowsfetch = mysqli_fetch_array($resultance);
    
    //$rid = $rowsfetch['requestID'];
    //$mk = $rowsfetch['mark'];
    //$gr = $rowsfetch['grade'];

     
    
         //   $ct =$rowsfetch1['CourseTitle'];
    

  //  $sql_query3 = "select due_date from orders where email='" . $loggedinfo . "' and due_date< '" . $pickeddate . "'  ";
    //$resultant1 = mysqli_query($con, $sql_query3);
    //$rowsno2 = mysqli_num_rows($resultant1); **/

    ?>

    <?php 

if (isset($_POST['reconcileSubmit'])) {
    $matric = $_POST['matric'];
    $cl = $_POST['currentlevel'];
    $dpt = $_POST['depart'];
    $as = $_POST['affectedsem'];
    $rcc = $_POST['reconcileCourseCode'];
    $rct = $_POST['reconcileCourseTitle'];
    $rs = $_POST['reconcileScore'];
    $ln = $_POST['lecturername'];
    $ri = $_POST['reqID'];
    $ca = $_POST['continousass'];
    $ex = $_POST['examscore'];
    $ts = $_POST['totalscore'];
    


    $query_reconcile = "INSERT into stafflog(studentID, studentLevel, department, affectedSemester, courseC, courseT, currentScore, lecturerName, requestID, caScore, examScore, totalScore) VALUES ('$matric', '$cl', '$dpt', '$as', '$rcc', '$rct', '$rs', '$ln', '$ri', '$ca', '$ex', '$ts')";
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
            window.location = "admindashboard1.php";
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
    <title>Staff Module</title>

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
                    <div class="list-inline-item logout"> <a id="logout" href="logout.php" class="nav-link">Logout <i
                                class="icon-logout"></i></a></div>
                </div>
            </div>
        </nav>
    </header>
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        <nav id="sidebar">
            <!-- Sidebar Header-->
            <div class="sidebar-header d-flex align-items-center">
                <div class="avatar"><img src="img/user32.png" style="position:center" alt="..."
                        class="img-fluid rounded-circle"></div>
                <div class="title">
                    <h1 class="h5"><?php echo $name1 ?> <?php echo $name2 ?></h1>
                </div>
            </div>
            <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
            <ul class="list-unstyled">
                <li>
                    <a href="adminhome.php"> <i class="icon-home"></i>Home </a>
                </li>
                <li class="active">
                    <a href="admindashboard1.php"> <i class="icon-padnote"></i>Student Requests </a>
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
                                        <div class="icon"><i class="icon-padnote"></i></div><strong>View Your Tasks
                                            </strong>
                                    </div>
                                    <div class="number dashtext-1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- This is the form that is above the table displayed for staff -->

            <section class="no-padding-top">
          <div class="container-fluid">
            <div class="row">
             
              <!-- Form Elements -->
              <div class="col-lg-12">
                <div class="block">
                  <div class="title"><strong>Result Reconciliation Form Staff Edition</strong></div>
                  <div class="block-body">
                    <form method="POST" action="" class="form-horizontal">
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Student Matric.No</label>
                        <div class="col-sm-9">
                          <input type="text" placeholder="" id="one" class="form-control" name ="matric" readonly>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Current Level</label>
                        <div class="col-sm-9">
                          <input type="text" name="currentlevel" id="two" placeholder="" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Department</label>
                        <div class="col-sm-9">
                          <input type="text" placeholder="" id="three" name="depart" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Affected Semester</label>
                        <div class="col-sm-9">
                          <input type="text"  id="four" placeholder="" name="affectedsem" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Course Details</label>
                        <div class="col-sm-9">
                          <div class="row">
                            <div class="col-md-3">
                              <input type="text" name="reconcileCourseCode" id="five" placeholder="Course Code" class="form-control" readonly />
                            </div>
                            <div class="col-md-4">
                              <input type="text"  name="reconcileCourseTitle" id="six" placeholder="Course Title" class="form-control" readonly />
                            </div>
                            <div class="col-md-5">
                              <input type="number"  name="reconcileScore" max="100" id="seven" placeholder="Current Score (x%)" class="form-control" readonly/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Lecturer Name</label>
                        <div class="col-sm-9">
                          <input type="text"  placeholder="" name="lecturername" id="eight" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Request ID</label>
                        <div class="col-sm-9">
                          <input type="text"  placeholder="" name="reqID" id="nine" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label">New Exam Score</label>
                        <div class="col-sm-9">
                          <div class="row">
                            <div class="col-md-3">
                              <input type="number" max="40" id="ten" name="continousass" placeholder="Continous Assessment" class="form-control" required />
                            </div>
                            <div class="col-md-4">
                              <input type="number" max="60" id="eleven" name="examscore" placeholder="Examination" class="form-control" required />
                            </div>
                            <div class="col-md-5">
                              <input type="number" name="totalscore" id="twelve" max="100" placeholder="Total (x%)" class="form-control" required/>
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





           <section class="no-padding-bottom">
                <div class="container-fluid">
                    <div class="row">
                        <div class="">

                        <div class="">
                  <div class="title"><strong>Your Tasks: Click on the buttons beside each request detail to generate details for the form above</strong></div>
                  <div class="table-responsive"> 
                    <table class="table" id='mytable'>
                      <thead>
                        <tr>
                           <th>Student ID</th>                                                   
                          <th>Current Study Level</th>
                          <th>Department</th>
                          <th>Affected Semester</th>
                          <th>Course Code</th>                         
                          <th>Current Title</th> 
                          <th>Current Score</th>
                          <th>Lecturer Name</th>
                          <th>Request ID</th> 
                        
                          
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      while ($resultrow = mysqli_fetch_assoc($resultance)) {
                          ?>
                          <tr>
                            <td><?php echo $resultrow['studentID'] ?></td>                           
                            <td><?php echo $resultrow['studentLevel'] ?></td>
                            <td><?php echo $resultrow['studentDepartment'] ?></td>
                            <td><?php echo $resultrow['affectedSemester'] ?></td>
                            <td><?php echo $resultrow['courseCode'] ?></td>
                            <td><?php echo $resultrow['courseTitle'] ?></td>
                            <td><?php echo $resultrow['currentScore'] ?></td>
                            <td><?php echo $resultrow['lecturerName'] ?></td> 
                            <td style = "width:150px; height: 60px;" class="btn btn-success"><?php echo $resultrow['requestID'] ?></td>

                            <!-- <a href="javascript:void(0)" class="btn btn-success get_id" > -->


                          </tr>

                          <?php } ?>
            
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!--Modal for displaying resultsn 
           
                  End of Model -->

                                        
                                    </ul>
                                </li>
                            </ul>
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


    <!-- JavaScript files-->

                            <script>
                                    var table = document.getElementById('mytable'),rIndex;
                                    for(var i = 1; i < table.rows.length; i++)
                                    {
                                        table.rows[i].onclick = function()
                                        {
                                            rIndex = this.rowIndex;
                                            document.getElementById("one").value =this.cells[0].innerHTML;
                                            document.getElementById("two").value =this.cells[1].innerHTML;
                                            document.getElementById("three").value =this.cells[2].innerHTML;
                                            document.getElementById("four").value =this.cells[3].innerHTML;
                                            document.getElementById("five").value =this.cells[4].innerHTML;
                                            document.getElementById("six").value =this.cells[5].innerHTML;
                                            document.getElementById("seven").value =this.cells[6].innerHTML;
                                            document.getElementById("eight").value =this.cells[7].innerHTML;
                                            document.getElementById("nine").value =this.cells[8].innerHTML;
                                            document.getElementById("ten").value =this.cells[9].innerHTML;
                                            document.getElementById("eleven").value =this.cells[10].innerHTML;
                                            document.getElementById("twelve").value =this.cells[11].innerHTML;
                                        };
                                    }
                            </script>



                                        <script>
                                            $(document).ready(function(){
                                                $(".get_id").click(function(){
                                                    var ids = $(this).data('id');
                                                    $.ajax({
                                                        url:"admindashboard1.php",
                                                        method:'POST',
                                                        data:{id:ids},
                                                        success:function(data){
                                                            $('#printable').html(data);
                                                        }
                                                    })
                                                })
                                            })
                                        
                                        </script>


    <script>
function printPage() {
    var w = window.open();

    var headers =  $("#heading").html();
    var field= $("#printable").html();
   
    var html = "<!DOCTYPE HTML>";
    html += '<html lang="en-us">';
    html += '<head><style></style></head>';
    html += "<body>";

    //check to see if they are null so "undefined" doesnt print on the page. <br>s optional, just to give space
    if(headers != null) html += headers + "<br/><br/>";
    if(field != null) html += field + "<br/><br/>";
   

    html += "</body>";
    w.document.write(html);
    w.window.print();
    w.document.close();
};
    </script>
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