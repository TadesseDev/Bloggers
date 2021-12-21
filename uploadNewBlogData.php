<?php
session_start();
include "./includes/functions.php";
$BR = "<br/>";
$author_Id = null;
// preserve user intered data 
if (true) {
    $_SESSION['type'] = $_POST['type'];
    $_SESSION['title'] = $_POST['title'];
    for ($i = 0; $i < sizeof($_SESSION['textArea']); $i++) {
        if ($_SESSION['textArea'][$i] == "") {
            array_splice($_SESSION['textArea'], $i, 1);
            continue;
        }
        $_SESSION['textArea'][$i] = strip_tags($_POST["$i"]);
    }
    if (isset($_POST[sizeof($_SESSION['textArea'])])) {
        if ($_POST[sizeof($_SESSION['textArea'])] != null) {
            array_push($_SESSION['textArea'], strip_tags($_POST[sizeof($_SESSION['textArea'])]));
        }
    }
}
function updatePreviewOrder($id, $type, $element)
{
    // adds element to the order array so can be used latter in preview to preserve the order of user entered data 
    $_SESSION['order']["$id"] = [$type, $element];
}
if (isset($_POST['upload'])) {
    $ret = saveDataToDatabase();
    if ($ret == "success") {
        echo "success";
        clearBlogTempData();
        session_regenerate_id();
        $result = mysqli_fetch_all(getQueryResult("select DISTINCT email from blog.subscriptions;"), 1);
        $emails = [];
        foreach ($result as $row) {
            array_push($emails, $row['email']);
        }
        sentMail(to: $emails);
        $_SESSION['published'] = true;
        header("location: ./AddBlog.php");
    } else {
        echo $ret;
    }
} else if (isset($_POST['reset'])) {
    clearBlogTempData();
    header("location: ./AddBlog.php");
} else if (isset($_POST['uploadImage'])) {
    $img = $_POST['AddPicture'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $index = (sizeof($_SESSION['textArea']) - 1) + time() / 10000000000;
    $location = "./files/blogsData/tempoUpload/$index.png";
    $imageFile = imagecreatefrompng($location);
    $_SESSION['images']["$index"] = $imageFile;
    updatePreviewOrder($index, "image_" . $_POST['loaclSTR'], $_SESSION['images']["$index"]);
    $success = file_put_contents($location, $data);
} else if (isset($_POST['preview'])) {
    header("location: ./AddBlog.php");
} else if (isset($_POST['addTextArea'])) {
    if (!isset($_POST[sizeof($_SESSION['textArea'])]) && ($_POST[sizeof($_SESSION['textArea']) - 1] != null)) {
        array_push($_SESSION['textArea'], "");
    }
    header("location: ./AddBlog.php");
} else if (isset($_POST['addSpecialCharacter'])) {
    $index = (sizeof($_SESSION['textArea']) - 1) + time() / 10000000000;
    $_SESSION['preserve']["$index"] = ["content" => htmlspecialchars($_POST['PreservedText']), "language" => $_POST['category']];
    updatePreviewOrder($index, "preservedText", $_SESSION['preserve']["$index"]);
    header("location: ./AddBlog.php");
} else if (isset($_POST['cancelPhotoUpdate'])) {
    header("location: ./AddBlog.php");
} else if (isset($_POST['addSubTitle'])) {
    if ($_POST['subTitle'] == "") {
        header("location: ./AddBlog.php");
    } else {
        $index = (sizeof($_SESSION['textArea']) - 1) + time() / 10000000000;
        updatePreviewOrder($index, "subTitle", $_POST['subTitle']);
        header("location: ./AddBlog.php");
    }
} else if (isset($_POST['uploadBlogCover'])) {
    $img = $_POST['blogCover'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $newImage = imagecreatefromstring($data);
    if (isset($_SESSION['cover'])) {
        unlink("./files/blogsData/temp-cover/" . $_SESSION['cover'] . "_cover.png");
    }
    $_SESSION['cover'] = time();
    $location = "./files/blogsData/temp-cover/" . $_SESSION['cover'] . "_cover.png";
    createTumnbnail($newImage, $location, 200);
}
