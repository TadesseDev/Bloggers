<?php
function logout()
{
    session_destroy();
}
function setNull(&...$args)
{
    foreach ($args as &$arg) {
        $arg = null;
    }
}
function login($email, $Password)
{
    $res = mysqli_query($_SESSION['con'], "select * from author where email='$email' and Password='$Password'");
    $namedResult = mysqli_fetch_assoc($res);
    // echo sizeof($namedResult);
    if (sizeof($namedResult) > 0) {
        $_SESSION['userId'] = $namedResult['id'];
        $_SESSION['userFname'] = $namedResult['Fname'];
        $_SESSION['userLname'] = $namedResult['Lname'];
        $_SESSION['userEmail'] = $namedResult['email'];
        $_SESSION['userTitle'] = $namedResult['Title'];
        $_SESSION['userExperties'] = $namedResult['Experties'];
        $_SESSION['userPassword'] = $namedResult['Password'];
        unset($_POST['RegisterNewUser']);
    }
    // echo "use is loged in";
}
function processMyimage($source, $destination, $width, $height)
{
    list($w, $h) = getimagesize($source);
    $oldRatio = $w / $h;
    // echo $oldRatio;
    $newRatio = $width / $height;
    // echo $newRatio;
    echo print_r($source);
    if ($newRatio > $oldRatio) {
        $width = $height * $oldRatio;
    } else {
        $height = $width / $oldRatio;
    }
}
