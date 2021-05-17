
<?php 
require 'db.php';
//code for user login. Cross checks with database if user exists, then validates to sign user in
session_start();
if (isset($_SESSION['uname'])) {

  session_destroy();
  header("location:index.php");
}

else {



if (isset($_POST['studentLogin'])) {

  $uname = mysqli_real_escape_string($con, $_POST['loginUsername']);
  $password = mysqli_real_escape_string($con, $_POST['loginPassword']);

  if ($uname != "" && $password != "") {

    $sql_query = "select count(*) as cntUser from students where student_id='" . $uname . "' and studentPassword='" . md5($password) . "'";
    $result = mysqli_query($con, $sql_query);
    $row = mysqli_fetch_array($result);

    $count = $row['cntUser'];

    if ($count > 0) {
    
    $_SESSION['uname'] = $uname;
    header('Location: dashboard.php');
    } else {
      echo(
        '<script>
        console.log("'.md5($password).'");
        setTimeout(function() {
            swal({
                title: "Invalid login details!",
                text: "Please check your Matric Number and Password to make sure they are correct",
                type: "error"
            }, function() {
                window.location = "index.php";
            });
        }, 1000);
    </script>'
    );
    }
  }
}
//staff_login
if (isset($_POST['adminSubmit'])) {

  $uname = mysqli_real_escape_string($con, $_POST['adminUsername']);
  $password = mysqli_real_escape_string($con, $_POST['adminPassword']);

  if ($uname != "" && $password != "") {

    $sql_query = "select * from staff where email='" . $uname . "' and staffPassword='" . md5($password) . "'";
    $result = mysqli_query($con, $sql_query);
    $row = mysqli_fetch_assoc($result);
    $result112 = $row['staffPost'];


    if ($result112=="Lecturer") {
    
    $_SESSION['uname'] = $uname;
    header('Location: admindashboard1.php');
    }
    elseif($result112=="H.O.D"){
      $_SESSION['uname'] =$uname;
      header('Location: admindashboard.php');
    }
    else {
      echo(
        '<script>
        setTimeout(function() {
            swal({
                title: "Invalid login details!",
                text: "Please check your staff email and Password to make sure they are correct",
                type: "error"
            }, function() {
                window.location = "index.php";
            });
        }, 1000);
    </script>'
    );
    }
  }
}
?>

<?php 
 //code for staff login. Cross checks with database if user exists, then validates to sign user in

/**if (isset($_POST['adminSubmit'])) {

  $adminUname = mysqli_real_escape_string($con, $_POST['adminUsername']);
  $adminPassword = mysqli_real_escape_string($con, $_POST['adminPassword']);

  if ($adminUname != "" && $adminPassword != "") {

    $sql_query1 = "select count(*) as cntUser1 from staff where email='" . $adminUname . "' and staffPassword='" . md5($adminPassword) . "'";
    $result1 = mysqli_query($con, $sql_query1);
    $row1 = mysqli_fetch_array($result1);

    $count1 = $row1['cntUser1'];

    if ($count1 > 0) {
    
    $_SESSION['adminUsername'] = $adminUnames;
    header('Location: www.google.com');
    } else {
      echo(
        '<script>
        setTimeout(function() {
            swal({
                title: "Invalid login details!",
                text: "Please check your Staff Email and Password to make sure they are correct",
                type: "error"
            }, function() {
                window.location = "index.php";
            });
        }, 1000);
    </script>'
    );
    }
  }
} **/


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="all,follow">
    <meta name="description" content="">
    <title>RRS Login</title>
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
     <div class="login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <h1>RRS @Unihub</h1>
                  </div>
                  <p>This system is brought to you by the University Hub.</p>
                  <p>Sign-In with your existing management system credentials and tender your request to reconcile your grades!</p>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
                <p>  <div><h3>Student Sign-In</h3></div></p>
                  <form method="POST" action="" class="form-validate">
                    <div class="form-group">
                      <input id="login-username" type="text" name="loginUsername" class="input-material" required />
                      <label for="login-username" class="label-material">Matric Number(**/****)</label>
                      </div>
                    <div class="form-group">
                      <input id="login-password" type="password" name="loginPassword" class="input-material" required />
                      <label for="login-password" class="label-material">Password</label>
                      <input type="checkbox" onclick="showPassword()" >Show Password          
                    </div>
                    <input type="submit" name="studentLogin" class="btn btn-primary" value="Login"/>
                    <!-- Pop-Up modal button for lecturers/staff-->
                  </form><a href="#" class="forgot-pass">Forgot Password?</a><br><small>Lecturer/Management/Admin? </small><button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Sign In Here</button>
                 
                  <!--Modal for admin and lecturer login -->
                  <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                      <div role="document" class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header"><strong id="exampleModalLabel" class="modal-title">Staff/Administration Log In</strong>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                          </div>
                          <div class="modal-body">
                            <p>Sign In to view your tasks and track student result reeconsiliation requests.</p>
                            <form method="POST" action="" class="form-validate">
                              <div class="form-group">
                                <label>Staff Id</label>
                                <input type="email" name="adminUsername" placeholder="Staff ID" class="form-control" required />
                              </div>
                              <div class="form-group">       
                                <label>Password</label>
                                <input type="password" name="adminPassword" placeholder="Password" class="form-control" required />
                              </div>
                             
                              <div class="form-group">       
                               <input type="submit" name ="adminSubmit" class="btn btn-primary" value="Sign In" />
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                            </div>
                        </div>
                      </div>
                    </div>
                  <!-- End of Model -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    
    </div>

                 <!--
  Script for hide / show password function
-->

<script>
                function showPassword() {
                  var x = document.getElementById("login-password");
                  if (x.type === "password") {
                    x.type = "text";
                  } else {
                    x.type = "password";
                  }
                }
              </script>
              <!--
End of script
-->
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/front.js"></script>
</body>
</html>

<?php } ?>