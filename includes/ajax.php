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

if (isset($_POST['getTopBlog'])) {
    $by = $_POST['by'];
    $amount = $_POST['amount'];
    // echo $by;
    $blogs =  mysqli_fetch_all(getQueryResult("select * from blog order by($by) LIMIT $amount;"), 1);
    echo json_encode($blogs);
    // foreach ($blogs as $blog) : 
    // echo print_r($blog); 
    // endforeach; 
    // echo "gettin top blogs"; 
}

if (isset($_POST['executeQuery'])) {
    if ($_POST['id'] == 'emailSubscription') {
        $value = $_POST['email'];
        $res = getQueryResult("insert into subscriptions (id,email)value(default,'$value');");
        // echo $res;
        // echo $value;
        echo sentMail(
            to: $value,
            header: 'successful subscription to the bloggers page.',
            body: '<span style="font-size: 20px">
            <p style="color: #340100">you are one of us now!!</p>
            <p>we are <b>delighted</b> to assure you that you are now a part of our growing platform!</p>
            <p>use the link to head to the homepage http://localhost/winmac-blog/</p>
            </span>'
        );
    }
}
