<?php

$_SESSION['success'] ="";

$con = mysqli_connect("localhost","root","root","unihub");
// Check connection
if (!$con)
  {
  die("connection failed: " .mysqli_connect_error());
  }
  
  
  ?>