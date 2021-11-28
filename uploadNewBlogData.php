<?php
session_start();
include "./includes/functions.php";
$BR = "<br/>";
$author_Id = null;
// preserve user intered data 
if (true) {
    // if (isset($_POST['uploadImage'])) {
    $_SESSION['type'] = $_POST['type'];
    $_SESSION['title'] = $_POST['title'];
    // }
    for ($i = 0; $i < sizeof($_SESSION['textArea']); $i++) {
        $_SESSION['textArea'][$i] = strip_tags($_POST["$i"]);
        // echo "processing $i" . $BR;
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
// preserveuserData($_POST);
if (isset($_POST['upload'])) {
    echo "form submited";
    saveDataToDatabase();
} else if (isset($_POST['reset'])) {
    // echo "<script lang='javascript'>localStorage.clear();alert('cleared')</script>";
    // $_SESSION['images']["$index"] = $imageFile;
    clearBlogTempData();
    // echo "<pre>" . print_r($keys) . "</pre>";
    header("location: ./AddBlog.php");
} else if (isset($_POST['uploadImage'])) {
    $img = $_POST['AddPicture'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $newImage = imagecreatefromstring($data);
    // $fileName = $_FILES['AddPicture']['name'];
    // $tmpName = $_FILES['AddPicture']['tmp_name'];
    // $error = $_FILES['AddPicture']['error'];
    // $fileSize = $_FILES['AddPicture']['size'];
    // $validExt = ['jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'wbmp', 'WBMP', 'bmp', 'BMP', 'webp', 'WEBP'];
    // $ext = explode(".", $fileName);
    // $ext = end($ext);
    // // echo $ext;
    // if (!in_array($ext, $validExt)) :
    //     echo "you canot upload such files as this are not image files";
    // elseif ($error != 0) :
    //     echo "something went wrong in uploading image";
    // // elseif (($fileSize / (1024 * 1024)) > 1.5) :
    // //     echo "you cannot upload file morethan 1.5MB";
    // else :
    $index = (sizeof($_SESSION['textArea']) - 1) + time() / 10000000000;
    $location = "./files/blogsData/tempoUpload/$index.png";
    $imageFile = imagecreatefrompng($location);
    $_SESSION['images']["$index"] = $imageFile;
    updatePreviewOrder($index, "image_" . $_POST['loaclSTR'], $_SESSION['images']["$index"]);
    $success = file_put_contents($location, $data);
    // updatePreviewOrder("index6", "thi is image value", "this is value");
    // move_uploaded_file($tmpName, "./files/blogsData/$fileName");
    // processMyimage($imageFile, "./files/blogsData/W-200/$index.png", 200, 150, "png");
    createTumnbnail($newImage, "./files/blogsData/W-200/$index.png", 200);
    // unlink("./files/blogsData/$fileName");
    // echo "upload complet";
    // endif;
    // header("location: ./AddBlog.php");
    // echo "<script> console.log('updating order');</script>";
} else if (isset($_POST['preview'])) {
    header("location: ./AddBlog.php");
    // echo "this is preview page";
    // echo $_SESSION['type'];
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
}
