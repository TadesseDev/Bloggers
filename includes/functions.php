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
function processMyimage($source, $destination, $w, $h, $ext)
{
    list($w_original, $h_original) = getimagesize($source);
    $scale_ratio = $w_original / $h_original;
    // $oldRatio = $w / $h;
    // echo $oldRatio;
    // $newRatio = $width / $height;
    // echo $newRatio;
    // echo print_r($source);
    // echo $ext;
    if (($w / $h) > $scale_ratio) {
        $w = $h * $scale_ratio;
    } else {
        $h = $w / $scale_ratio;
    }
    // echo "<br/>" . $ext;
    // exif_read_data($source);
    $img = "";
    if (strcasecmp($ext, "jpeg") == 0 || strcasecmp($ext, "jpg") == 0) :
        $img = imagecreatefromjpeg($source);
    elseif (strcasecmp($ext, "webp") == 0) :
        $img = imagecreatefromwebp($source);
    elseif (strcasecmp($ext, "bmp") == 0) :
        $img = imagecreatefrombmp($source);
    elseif (strcasecmp($ext, "gif") == 0) :
        $img = imagecreatefromgif($source);
    elseif (strcasecmp($ext, "png") == 0) :
        $img = imagecreatefrompng($source);
    elseif (strcasecmp($ext, "wbmp") == 0) :
    endif;
    $im = imagescale($img, 150);
    // $newImg = imagecreatetruecolor($w, $h);
    // echo $w, " ", $h;
    // imagecopyresampled($newImg, $img, 0, 0, 0, 0, $w, $h, $w_original, $h_original);
    imagejpeg($im, $destination);
}
