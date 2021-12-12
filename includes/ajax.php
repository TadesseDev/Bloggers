<?php
session_start();
include "../includes/functions.php";
if (isset($_POST['getProfilePicture'])) {
    $uid = $_SESSION['userId'];
    $profilePic =  mysqli_fetch_assoc(getQueryResult("select profilePic from author where id='$uid'"))['profilePic'];
    echo $profilePic;
}

if (isset($_POST['Register'])) {
    include "validateRegistration.php";
    include "registerationForm.php";
    // echo "registeration form submited";
}
