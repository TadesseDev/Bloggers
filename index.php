<?php include "header.php";
include "./includes/validateRegistration.php";
// echo print_r(gd_info());
// $image = imagecreatefrompng("./files/3D tube WM.png");
// $rotateImage = imagerotate($image, 45, false);
// imagepng($rotateImage, "./files/createdImage.png", 9);
?>
<div class="heading">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="textContent">
                    <ol>
                        <li class="title">
                            <p>you can be a bloger ?</p>
                        </li>
                        <li>
                            <p>sign in / register</p>
                        </li>
                        <li>
                            <p>compile your blog</p>
                        </li>
                        <li>
                            <p>publish / share</p>
                        </li>
                        <li>
                            <!-- <p>or contact us for any guidance. </p> -->
                        </li>
                    </ol>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="profileContainer row">
                    <div class="col-sm-6">
                        <div id="profileImage">
                            <!-- <img src="./files/icons/anonymous_user.svg" alt="winmac Text"> -->
                            <?php
                            $data_target = "";
                            $user_status = "Not Signed In";

                            if (isset($_SESSION['userId']) || isset($_POST['updateProfilePicture'])) :
                                $user_status = "<p>" . $_SESSION['userTitle'] . ", " . $_SESSION['userFname'] . " " . $_SESSION['userLname'] . "<p/>";
                                $user_status = $user_status . "<p>" . $_SESSION['userExperties'] . "</p>";
                                $user_status = $user_status . "<p>" . $_SESSION['userEmail'] . "</p>";
                                $user_status = $user_status . "<p>Rank: </p>";
                                $uid = $_SESSION['userId'];
                                $data_target = "data-userId='$uid'";
                                $profilePic =  mysqli_fetch_assoc(getQueryResult("select profilePic from author where id='$uid'"))['profilePic'];
                                if (!$profilePic == "") {
                            ?>
                                    <script lang="javascript" type="text/javascript">
                                        const profilePicture = document.getElementById("profileImage");
                                        // console.log(profilePicture);
                                        updateAbackgroundPicture(`<?php echo  $profilePic ?>`,
                                            profilePicture);
                                    </script>
                            <?php
                                }
                            endif;
                            ?>
                            <label for="userProfileImage" <?php echo $data_target ?>></label>
                            <input type="file" accept="image/*" name="addProfilePicture" id="userProfileImage" hidden></input>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <span class="userDetil"><?php echo $user_status; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="userAction">
        <form action="" method="POST">
            <?php
            if (!isset($_SESSION['userId'])) :
            ?>
                <button class="button" type="submit" name="Register" id="registerUserButton">Register</button>
                <button id="login" class="button" type="button" name="showLoginModal" data-toggle="modal" data-target="#LoginModal">Login</button>
            <?php else : ?>
                <button class="button" type="button" name="addBlog" onclick="clickObject('addBlog');">Add Blog</button>
                <button class="button" type="submit" name="LogOut">Logout</button>
            <?php endif; ?>
        </form>
    </div>
    <div id="registrationFormPlace">
        <?php if (isset($_POST['Register']) || isset($_POST['RegisterNewUser'])) :
            include "./includes/registerationForm.php";
        endif; ?>
    </div>
</div>
<?php include "./includes/modals.php" ?>

<div class="container-fluid Home">
    <div class="row ">
        <div class="col-xs-12 menu">
            <a href="#" class="blog-selection">most recent</a>|
            <a href="#" class="blog-selection">most ranked</a>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-sm-8">
            <div class="blogTitle">this is paragraph</div>
            <p> this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph </p>
        </div>
        <div class="col-sm-4 BlogSideImage topImage">
            <img src="./files/react@2x.png" alt="angular">
        </div>
    </div> -->

    <div id="HomePagecontainer">
        <?php
        include "./pages/ListOfBlog.php";
        // include "./pages/singleBlog.php";
        ?>
    </div>
</div>
<?php include "footer.php";
// sentMail(to: ['itsamateroflife@gmail.com']);
// require_once './vendor/autoload.php';
// // Create the Transport
// $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
//     ->setUsername('blog.ers.cf@gmail.com')
//     ->setPassword('grymunfgfggfzflf');

// // Create the Mailer using your created Transport
// $mailer = new Swift_Mailer($transport);

// // Create a message
// $message = (new Swift_Message('New Blog is published'))
//     ->setFrom(['blog.ers.cf@gmail.com' => 'Bloggers'])
//     ->setTo(['itsamateroflife@gmail.com'])
//     ->setBody('click the link to get there http://localhost/winmac-blog/');
// // Send the message
// $result = $mailer->send($message);
// if ($result) {
//     echo "email is sent";
// } else {
//     echo "sending email fails";
// }
?>