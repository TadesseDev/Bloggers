<?php
function logout()
{
    clearBlogTempData();
    session_destroy();
    echo "<script>window.location='./';</script>";
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
    // if (sizeof($namedResult) > 0) {
    if ($namedResult) {
        $_SESSION['userId'] = $namedResult['id'];
        $_SESSION['userFname'] = $namedResult['Fname'];
        $_SESSION['userLname'] = $namedResult['Lname'];
        $_SESSION['userEmail'] = $namedResult['email'];
        $_SESSION['userTitle'] = $namedResult['Title'];
        $_SESSION['userExperties'] = $namedResult['Experties'];
        $_SESSION['userPassword'] = $namedResult['Password'];
        unset($_POST['RegisterNewUser']);
        echo "<script>window.location='http://localhost/winmac-blog/';</script>";
    } else {
        echo "<script>window.location='http://localhost/winmac-blog/?cantSignIn=1';</script>";
    }
    // echo "use is loged in";
}


// not used for the time beeing
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
    elseif (strcasecmp($ext, "string") == 0) :
        $img = imagecreatefromstring($source);
    endif;
    $newImg = imagecreatetruecolor($w, $h);
    // echo $w, " ", $h;
    imagecopyresampled($newImg, $img, 0, 0, 0, 0, $w, $h, $w_original, $h_original);
    imagejpeg($newImg, $destination);
}

function createTumnbnail($source, $destination, $TumbWidth)
{
    $im = imagescale($source, $TumbWidth);
    imagejpeg($im, $destination);
}
function clearBlogTempData()
{
    // echo "<script lang='javascript'>localStorage.clear();alert('cleared')</script>";
    if (isset($_SESSION['images'])) {
        $keys = array_keys($_SESSION['images']);
        foreach ($keys as $key) :
            if (unlink("./files/blogsData/tempoUpload/$key.png")) :
                unset($_SESSION['order']["$key"]);
                unset($_SESSION['images']["$key"]);
            endif;
        endforeach;
    }
    setNull($_SESSION['order'], $_SESSION['preserve'], $_SESSION['type'], $_SESSION['title'], $_SESSION['textArea'], $_SESSION['images'], $_FILES['AddPicture'], $_SESSION['content']);
}

function saveDataToDatabase()
{
    if (!isset($_SESSION['title']) || !isset($_SESSION['type'])) {
        return "requiered fileds are empity";
    }
    $author = isset($_SESSION['userId']) ? $_SESSION['userId'] : "default";
    $title = $_SESSION['title'];
    $type = $_SESSION['type'];
    // echo $title . " " . $type;
    $con = mysqli_connect($_SESSION['conInfo'][0], $_SESSION['conInfo'][1], $_SESSION['conInfo'][2], $_SESSION['conInfo'][3]);
    mysqli_query($con, " LOCK TABLES `blog` WRITE");
    $res = mysqli_query($con, "insert into blog(author, Title, type) values($author, '$title', '$type');");
    if ($res != 1) {
        mysqli_query($con, " UNLOCK TABLES");
        return "cant write to the database";
    }
    $res = mysqli_query($con, "select max(id) as thisBlogId from  blog");
    mysqli_query($con, "UNLOCK TABLES");
    $BlogId = mysqli_fetch_assoc($res)["thisBlogId"];

    for ($i = 0; $i < sizeof($_SESSION["textArea"]); $i++) :
        $text = $_SESSION["textArea"][$i];
        $res = mysqli_query($con, "insert into content(Bid,orderOf,contentType,content) values($BlogId,$i,1,'$text')");
    // insert into content(Bid,orderOf,contentType,content) values(1,-0.8361730166,1,"When ");
    // echo $_SESSION["textArea"][$i] . "<br/>";
    endfor;
    $keys = array_keys($_SESSION['order']);
    foreach ($keys as $key) :
        $content = "";
        $contentType = 2;
        $remark = "not set";
        if (explode("_", $_SESSION["order"][$key][0])[0] == "image") {
            $content = "files/blogsData/tempoUpload/$key.png";
            $contentType = 3;
        } else {
            $content = mysqli_real_escape_string($con, $_SESSION["order"][$key][1]["content"]);
            $remark = $_SESSION["order"][$key][1]["language"];
        }
        //  = explode("_", $_SESSION["order"][$key][0])[0] == "image" ? 3 : 2;
        $res = mysqli_query($con, "insert into content(Bid,orderOf,contentType,content,remark) values($BlogId,$key,$contentType,'$content','$remark')");
        echo print_r($key) . "<br/>";
    endforeach;
    return "sucess";
}
