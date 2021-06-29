<?php
$message = "";
if (isset($_POST['RegisterNewUser'])) :
    $firstName = mysqli_real_escape_string($_SESSION['con'], $_POST['firstName']);
    $lastName = mysqli_real_escape_string($_SESSION['con'], $_POST['lastName']);
    $email = mysqli_real_escape_string($_SESSION['con'], $_POST['email']);
    $title = mysqli_real_escape_string($_SESSION['con'], $_POST['title']);
    $experties = mysqli_real_escape_string($_SESSION['con'], $_POST['experties']);
    $password = mysqli_real_escape_string($_SESSION['con'], $_POST['password']);
    $confirmationPassword = mysqli_real_escape_string($_SESSION['con'], $_POST['confirmationPassword']);
    if ($password != $confirmationPassword) {
        $message = "password does not match";
    } else {
        $res = mysqli_query($_SESSION['con'], "insert into author values(default,'$firstName','$lastName','$title','$experties','$email','$password')");
        if ($res > 0) {
            $_SESSION['userId'] = mysqli_fetch_assoc(mysqli_query($_SESSION['con'], "select max(id) as id from AUTHOR"))['id'];
            $_SESSION['userFname'] = $firstName;
            $_SESSION['userLname'] = $lastName;
            $_SESSION['userEmail'] = $email;
            $_SESSION['userTitle'] = $title;
            $_SESSION['userExperties'] = $experties;
            $_SESSION['userPassword'] = $password;
            unset($_POST['RegisterNewUser']);
            echo "registration till going on";
        } else
            echo $res . "<br/>problem occures";
    }
endif;
