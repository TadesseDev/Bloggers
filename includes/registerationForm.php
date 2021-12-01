<div class="registration">
    <form action="" method="POST">
        <p class="formTitle">registr and post, comment, request and more...</p>
        <label for="firstName">
            first name
        </label>
        <input type="text" id="firstName" name="firstName" placeholder="Author first name" required="true">
        <label for="lastName">
            last name
        </label>
        <input type="text" id="lastName" name="lastName" placeholder="Author last ame" required="true">
        <label for="email">
            author email
        </label>
        <input type="email" id="email" name="email" placeholder="author@domain.com">
        <label for="title">
            author title
        </label>
        <input type="text" id="title" name="title" placeholder="M'r, Engineer, DR, Pro...">
        <label for="expertie">
            author profession
        </label>
        <input type="text" id="experties" name="experties" placeholder=" your profession">
        <label for="password">
            password
        </label>
        <input type="password" id="password" name="password" placeholder="password" required="true">
        <input type="password" id="confirmationPassword" name="confirmationPassword" placeholder="confirmation Password" required="true">
        <button class="button darkBrown ColorOrange" type="submit" name="RegisterNewUser">Register</button>
        <button class="button darkBrown ColorOrange" type="reset" name="cancel">Reset</button>
        <a class="button darkBrown ColorOrange" onclick="window.location='index.php'">cancel</a>
        <span><?php echo "<span class='simpleErrore'>" . $message . "</span>" ?></span>
    </form>
</div>
<!-- Button trigger modal -->
<button id="showRegistrationFail" dtype="button" class="btn btn-primary" data-toggle="modal" data-target="#registration-status-modal" hidden>
</button>
<?php if (isset($_SESSION['registrationStatus'])) :
    //after validation registration is completed we wil check for ststus here and allow user to see 
    //what happens, 
    // but for the time beeing only on registration failure this will be visisble since on sucess 
    // this page wouldnt even be included in the index 
    echo "<script>console.log(`" . $_SESSION['registrationStatus'] . "`);</script>";
    if ($_SESSION['registrationStatus'] == 1) :
        $modal_title = 'Congrats';
        $text_color = 'ColorLiGreen';
        $buttonBackground = 'green';
        $bottom_text = 'Log me in';
        $bottom_text_color = 'ColorDarkBrown';
        $modalBodyText = 'you have been registered as bloger';
    else :
        $modal_title = 'sorry registration failed';
        $text_color = 'ColorLiRed';
        $buttonBackground = 'red';
        $bottom_text = 'Retry';
        $bottom_text_color = 'ColorLightOrange';
        $modalBodyText = 'pleas make sure <br><ul class="half margin-auto"><li>email is not used before</li><li>password is valid</li><li>validate firs and last name</li></ul> ';
    endif;
    // $_SESSION["Account-success"]=array(
    //     "modal_title"=> $modal_title, 
    //     "text_color"=>$text_color ,
    //     "buttonBackgr"=>$buttonBackgr,
    //     "bottom_text"=>$bottom_text ,
    //     "bottom_text_color"=>$bottom_text_color ,
    //     "modalBodyText"=>$modalBodyText );
    echo "<script>clickObject(`showRegistrationFail`);</script>";
    unset($_SESSION["registrationStatus"]);
endif;
?>
<?php include "./includes/modals.php" ?>
<!-- Modal -->