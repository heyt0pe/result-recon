<?php 
if (isset($_POST['adminSubmit'])) {

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
}


?>