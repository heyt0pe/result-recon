<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "unihub";

$rec_id = $_POST['id'];
 $conn = mysqli_connect($servername, $username, $password, $dbname);
 

$sql = "select * from reconcile where id='".$rec_id."'";
$result = mysqli_query($conn, $sql);

 

   while($row = mysqli_fetch_assoc($result)) {
 
$output .= "<div class='row'><div class='col-sm-6'>Id: ".$row["id"]."</div><div class='col-sm-6'>Name ".$row["studentName"]."</div></div><div class='row'> <div class='col-sm-6'>Level: ".$row["studentLevel"]."</div></div><div class='row'><div class='col-sm-6'>Department: ".$row["studentDepartment"]."</div><div class='col-sm-6'>Affected Semester: ".$row["affectedSemester"]."</div></div>";

 }
echo $output;
 
mysqli_close($conn);
?>