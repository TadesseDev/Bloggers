<?php
@include_once("./includes/connection.php");
if (file_exists('./includes/constant.php'))
    require_once('./includes/constant.php');
else
    require_once('constant.php');
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
    // $res = mysqli_query($con, "select * from author where email='$email' and Password='$Password'");
    $namedResult = mysqli_fetch_assoc($res);
    // echo sizeof($namedResult);
    // if (sizeof($namedResult) > 0) {
    if ($namedResult) {
        $_SESSION['userId'] = $namedResult['id'];
        $_SESSION['userFname'] = $namedResult['Fname'];
        $_SESSION['userLname'] = $namedResult['Lname'];
        $_SESSION['userEmail'] = $namedResult['email'];
        $_SESSION['userTitle'] = $namedResult['Title'];
        $_SESSION['userExpertise'] = $namedResult['Experties'];
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

function processABase46ImageFile($base64, $location, $remark)
{
    $img = $base64;
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    // $imageFile = imagecreatefrompng($location);
    $success = file_put_contents($location, $data);
    if ($remark == "profilePicture") {
        $con = mysqli_connect($_SESSION['conInfo'][0], $_SESSION['conInfo'][1], $_SESSION['conInfo'][2], $_SESSION['conInfo'][3]);
        $userId = $_SESSION['userId'];
        $qry = mysqli_query($con, "update author set profilePic='$location' where author.id=$userId");
    }
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
            if (file_exists("./files/blogsData/tempoUpload/$key.png"))
                unlink("./files/blogsData/tempoUpload/$key.png");
            unset($_SESSION['order']["$key"]);
            unset($_SESSION['images']["$key"]);

        endforeach;
    }
    if (isset($_SESSION['cover'])) {
        unlink("./files/blogsData/temp-cover/" . $_SESSION['cover'] . "_cover.png");
        unset($_SESSION['cover']);
    }
    setNull($_SESSION['order'], $_SESSION['preserve'], $_SESSION['type'], $_SESSION['title'], $_SESSION['textArea'], $_SESSION['images'], $_FILES['AddPicture'], $_SESSION['content']);
}

function saveDataToDatabase()
{
    if (!isset($_SESSION['title']) || !isset($_SESSION['type'])) {
        return "requiered fileds are empity";
    }
    $author = isset($_SESSION['userId']) ? $_SESSION['userId'] : "default";
    $title = trim($_SESSION['title']);
    $type = trim($_SESSION['type']);
    // echo $title . " " . $type;
    $con = mysqli_connect($_SESSION['conInfo'][0], $_SESSION['conInfo'][1], $_SESSION['conInfo'][2], $_SESSION['conInfo'][3]);
    mysqli_query($con, " LOCK TABLES `blog` WRITE");
    $cover = "";
    if (
        isset($_SESSION['cover']) &&
        file_exists("files/blogsData/temp-cover/" . $_SESSION['cover'] . "_cover.png")
    ) {
        $cover = "file is found";
        $destination = "files/blogsData/images/blogCover/" . $_SESSION['cover'] . "_cover.png";
        $source = "files/blogsData/temp-cover/" . $_SESSION['cover'] . "_cover.png";
        try {
            rename($source, $destination);
        } catch (exception $exce) {
            echo $exce;
        };
        $cover = $destination;
    } else {
        $cover = "default";
    }
    $res = mysqli_query($con, "insert into blog(author, Title, type, cover,blogRank) values($author, '$title', '$type','$cover',0);");
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
    endfor;
    $keys = array_keys($_SESSION['order']);
    foreach ($keys as $key) :
        $content = "";
        $contentType = "";
        $remark = "not set";
        if (explode("_", $_SESSION["order"][$key][0])[0] == "image") {
            $destination = "files/blogsData/images/blogPart/$key.png";
            $source = "files/blogsData/tempoUpload/$key.png";
            $remark = $_SESSION['captions']["./" . $source];
            try {
                rename($source, $destination);
            } catch (exception $exce) {
                echo $exce;
            };
            $content = $destination;
            $contentType = 3;
        } else if ($_SESSION['order'][$key][0] == 'preservedText') {
            $content = mysqli_real_escape_string($con, $_SESSION["order"][$key][1]["content"]);
            $remark = $_SESSION["order"][$key][1]["language"];
            $contentType = 2;
        } else if ($_SESSION['order'][$key][0] == 'subTitle') {
            $content = mysqli_real_escape_string($con, $_SESSION["order"][$key][1]);
            $contentType = 0;
        }
        //  = explode("_", $_SESSION["order"][$key][0])[0] == "image" ? 3 : 2;
        $res = mysqli_query($con, "insert into content(Bid,orderOf,contentType,content,remark) values($BlogId,$key,$contentType,'$content','$remark')");
    // echo print_r($key) . "<br/>";
    endforeach;
    $result = mysqli_fetch_all(getQueryResult("select DISTINCT email from blog.subscriptions;"), 1);
    $emails = [];
    foreach ($result as $row) {
        array_push($emails, $row['email']);
    }
    $authorFullName = $_SESSION['userTitle'] . " " . $_SESSION['userFname'] . " " . $_SESSION['userLname'];
    $intro = substr($_SESSION["textArea"][0], 0, 200);
    $body = "<div style='font-size:18px; max-width: 500px;margin: auto'>
    <p style='font-size:20px; color:#340100;font-weight: bold'>New blog is published by <i><u>$authorFullName</u></i></p>
    <p> <b>title:</b>$title</p>
    <p style='font-size:16px'> <b>intro text:</b>$intro</p>
    <p> use the link to access the blog:<b> http://localhost/winmac-blog?bid=$BlogId </b></p>
</div>";
    // echo $body;
    sentMail(to: $emails, body: $body);
    $_SESSION['published'] = true;
    return "success";
}

function getQueryResult($query)
{
    $con = mysqli_connect($_SESSION['conInfo'][0], $_SESSION['conInfo'][1], $_SESSION['conInfo'][2], $_SESSION['conInfo'][3]);

    try {
        //code..
        $qry = mysqli_query($con, $query);
        return $qry;
    } catch (exception $ex) {
        return 0;
        //throw $th;
    }
}

function sentMail(
    $sender = EMAIL,
    $senderPass = EMAILPass,
    $header = 'New blog Publish',
    $emailAlias = 'Bloggers',
    $to = [],
    $body = 'click the link for the homepage http://localhost/winmac-blog/'
) {
    try {
        if (file_exists('../vendor/autoload.php'))
            require_once '../vendor/autoload.php';
        else
            require_once './vendor/autoload.php';
    } catch (Exception $exc) {
        require_once './vendor/autoload.php';
    }
    // Create the Transport
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
        ->setUsername($sender)
        ->setPassword($senderPass);

    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

    // Create a message
    // foreach ($to as $reciver) {
    $message = (new Swift_Message($header))
        ->setFrom([$sender => $emailAlias])
        ->setTo($to)
        ->setBody($body, "text/html");
    // Send the message
    $result = $mailer->send($message);
    return $result;
    // if ($result) {
    //     echo "email is sent";
    // } else {
    //     echo "sending email fails";
    // }
    // }
}
