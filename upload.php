<?php if (isset($_POST['upload'])) {
    $br = "<br/>";
    $file = $_FILES['file'];
    echo '<pres>', print_r($_FILES), '</pres>';
    $fileSize = $file['size'] / 1024 / 1024;
    $fileName = explode(".", $file["name"]);
    $fileExt = strtolower(end($fileName));
    $validExt = array('jpg', 'png', 'gif');
    // echo (join(".", $fileName)) . $br . ($fileSize) . $br . ($fileExt) . $br;
    if (in_array($fileExt, $validExt, true)) {
        if ($fileSize < 1.5) {
            $newFileName = uniqid(' ') . "." . $fileExt;
            $fileName = $fileName[0] . $newFileName;
            echo $fileName;
            if (move_uploaded_file($file['tmp_name'], 'files/' . $fileName)) {
                $connection = mysqli_connect("localhost", "wp_first", "wp_first", "ecommerece") or die("cant connect");
                if ($connection) {
                    $res = mysqli_query($connection, "update user_info set pofilePicture='$fileName' where user_id=15");
                    echo $res . $br;
                    if ($res) {
                        echo "upload completed success";
                    }
                }
            } else echo "cant upload the file";
            // echo $file['tmp_name'];
        } else
            echo "you canot upload files more than 1.5MB";
    } else        echo "invalid format";
}
