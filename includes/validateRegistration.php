<?php
// @include_once("./includes/connection.php");
if (file_exists('./includes/connection.php'))
    require_once('./includes/connection.php');
else
    require_once('../includes/connection.php');
$message = "";
if (isset($_POST['RegisterNewUser'])) :
    $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $experties = mysqli_real_escape_string($con, $_POST['experties']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmationPassword = mysqli_real_escape_string($con, $_POST['confirmationPassword']);
    if ($password != $confirmationPassword) {
        $message = "password does not match";
    } else {
        $res = mysqli_query($con, "insert into author(id,Fname,Lname,Title,Experties,email,`Password`,profilePic)
         values(default,'$firstName','$lastName','$title','$experties','$email','$password',default)");
        if ($res > 0) {
            $_SESSION['userId'] = mysqli_fetch_assoc(mysqli_query($con, "select max(id) as id from AUTHOR"))['id'];
            $_SESSION['userFname'] = $firstName;
            $_SESSION['userLname'] = $lastName;
            $_SESSION['userEmail'] = $email;
            $_SESSION['userTitle'] = $title;
            $_SESSION['userExpertise'] = $experties;
            $_SESSION['userPassword'] = $password;
            $_SESSION['registrationStatus'] = 1;
            unset($_POST['RegisterNewUser']);
            echo "<script>window.location='./';</script>";
        } else
            $_SESSION['registrationStatus'] = -1;
    }
endif;

// echo "<script>window.location='./?success=1';</script>";
// } else
//     echo "<script>window.location='./?registrationFail=1';</script>";
