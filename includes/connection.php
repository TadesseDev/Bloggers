<?php
// inside a function we need this information since the connection will be closed once the function call is completed
$_SESSION['conInfo'] = ["localhost", "root", "", "blog"];
// the connection below needs to be open all the time and used outside the function without re connecting to the database 
$con = mysqli_connect("localhost", "root", "", "blog") or die("cant connect to the database");
// $_SESSION['con'] = $con;
