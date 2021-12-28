<?php
$_SESSION['conInfo'] = ["localhost", "root", "", "blog"];
$con = mysqli_connect("localhost", "root", "", "blog") or die("cant connect to the database");
$_SESSION['con'] = $con;
