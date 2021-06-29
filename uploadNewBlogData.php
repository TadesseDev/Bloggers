<?php
session_start();
include "./includes/functions.php";
$BR = "<br/>";
$author_Id = null;
if (isset($_POST['upload'])) {

    echo "form submited";
} else if (isset($_POST['reset'])) {
    setNull($_SESSION['preserve'], $_SESSION['type'], $_SESSION['title'], $_SESSION['textArea'], $_SESSION['images'], $_FILES['AddPicture'], $_SESSION['content']);
    header("location: AddBlog.php");
} else if (isset($_POST['uploadImage'])) {
    $_SESSION['type'] = $_POST['type'];
    $_SESSION['title'] = $_POST['title'];
    for ($i = 0; $i < sizeof($_SESSION['textArea']); $i++) {
        $_SESSION['textArea'][$i] = strip_tags($_POST["$i"]);
        echo "processing $i" . $BR;
    }
    if (isset($_POST[sizeof($_SESSION['textArea'])])) {
        if ($_POST[sizeof($_SESSION['textArea'])] != null) {
            array_push($_SESSION['textArea'], strip_tags($_POST[sizeof($_SESSION['textArea'])]));
        }
    }
    // if ($_POST['textarea'] != null) {
    // echo str_replace($_POST['textarea'], "", $_SESSION['textArea']);
    // echo $_POST['textarea'];
    // $rep = 1;
    // array_push($_SESSION['content'], str_replace($_SESSION['textArea'], "", $_POST['textarea']));
    // excluding the previously submiting string before updating its contetnt to the content object
    // }
    // $_SESSION['textArea'] =  $_POST['textarea'];
    // echo $_SESSION['textArea'];
    // echo print_r($_FILES['AddPicture']) . $BR . $BR . $BR . $BR . $BR . $BR;
    $fileName = $_FILES['AddPicture']['name'];
    $fileType = $_FILES['AddPicture']['type'];
    $tmpName = $_FILES['AddPicture']['tmp_name'];
    $error = $_FILES['AddPicture']['error'];
    $fileSize = $_FILES['AddPicture']['size'];
    if ($fileType != "image/jpeg") :
        echo "you canot upload such files";
    elseif ($error != 0) :
        echo "something went wrong in uploading image";

    elseif (($fileSize / (1024 * 1024)) > 1.5) :
        echo "you cannot upload file morethan 1.5MB";
    else :
        // echo "uploading image";
        // array_push($_SESSION['images'], "0"=>$_FILES['AddPicture']);
        if (key_exists((sizeof($_SESSION['textArea']) - 1), $_SESSION['images'])) {
            $index = (sizeof($_SESSION['textArea']) - 1) + time() / 10000000000;
            $_SESSION['images']["$index"] = $_FILES['AddPicture'];
        } else {
            $_SESSION['images'][sizeof($_SESSION['textArea']) - 1] = $_FILES['AddPicture'];
        }
        header("location: AddBlog.php");
    endif;

    // echo $fileName, $fileType, $tmpName, $error, $fileSize;
    // foreach ($_SESSION['content'] as $x) {
    //     echo print_r($x) . $BR;
    // }
} else if (isset($_POST['preview'])) {
    $_SESSION['type'] = $_POST['type'];
    $_SESSION['title'] = $_POST['title'];
    for ($i = 0; $i < sizeof($_SESSION['textArea']); $i++) {
        $_SESSION['textArea'][$i] = strip_tags($_POST["$i"]);
        echo "processing $i" . $BR;
    }
    if ($_POST[sizeof($_SESSION['textArea'])] != null) {
        array_push($_SESSION['textArea'], strip_tags($_POST[sizeof($_SESSION['textArea'])]));
    }
    header("location: AddBlog.php");
} else if (isset($_POST['addTextArea'])) {
    $_SESSION['type'] = $_POST['type'];
    $_SESSION['title'] = $_POST['title'];
    for ($i = 0; $i < sizeof($_SESSION['textArea']); $i++) {
        $_SESSION['textArea'][$i] = strip_tags($_POST["$i"]);
        echo "processing $i" . $BR;
    }
    array_push($_SESSION['textArea'], "");
    header("location: AddBlog.php");
} else if (isset($_POST['addSpecialCharacter'])) {
    $_SESSION['type'] = $_POST['type'];
    $_SESSION['title'] = $_POST['title'];
    for ($i = 0; $i < sizeof($_SESSION['textArea']); $i++) {
        $_SESSION['textArea'][$i] = strip_tags($_POST["$i"]);
        echo "processing $i" . $BR;
    }
    if (isset($_POST[sizeof($_SESSION['textArea'])])) {
        if ($_POST[sizeof($_SESSION['textArea'])] != null) {
            array_push($_SESSION['textArea'], strip_tags($_POST[sizeof($_SESSION['textArea'])]));
        }
    }
    if (key_exists((sizeof($_SESSION['textArea']) - 1), $_SESSION['preserve'])) {
        $index = (sizeof($_SESSION['textArea']) - 1) + time() / 10000000000;
        $_SESSION['preserve']["$index"] = $_POST['PreservedText'];
    } else {
        $_SESSION['preserve'][sizeof($_SESSION['textArea']) - 1] =  $_POST['PreservedText'];
        echo $_POST['PreservedText'] . " is the special character <br/>";
    }
    foreach ($_SESSION['preserve'] as $pres) {
        echo print_r($pres);
    }
    // echo "add special character ";
} else if (isset($_POST['cancelPhotoUpdate'])) {
    header("location: AddBlog.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>