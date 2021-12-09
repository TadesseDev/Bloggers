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
                        <div id="prifileImage">
                            <img src="./files/icons/anonymous_user.svg" alt="winmac Text">
                            <label for="userProfileImage"></label>
                            <input type="file" accept="image/*" name="addProfilePicture" id="userProfileImage" hidden></input>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <span>Not Signed In</span>
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
                <button class="button" type="submit" name="Register">Register</button>
                <button id="login" class="button" type="button" name="showLoginModal" data-toggle="modal" data-target="#LoginModal">Login</button>
            <?php else : ?>
                <button class="button" type="submit" name="addBlog">Add Blog</button>
                <button class="button" type="submit" name="LogOut">Logout</button>
            <?php endif; ?>
        </form>
    </div>
    <?php if (isset($_POST['Register']) || isset($_POST['RegisterNewUser'])) :
        include "./includes/registerationForm.php";
    endif; ?>
</div>
<?php include "./includes/modals.php" ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 menu">
            <a href="#">most recent</a>/
            <a href="#">most ranked</a>
        </div>
    </div>
</div>
<div class="container-fluid Home">
    <div class="row">
        <div class="col-sm-8">
            <div class="blogTitle">this is paragraph</div>
            <p> this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph </p>
        </div>
        <div class="col-sm-4 BlogSideImage">
            <img src="./files/react@2x.png" alt="angular">
        </div>
    </div>
    <div class="row align-items-center BlogList">
        <div class="col-md-6">
            <div class="row halfSide">
                <div class="col-md-8">
                    <div class="blogTitle">this is paragraph</div>
                    <p> this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is </p>
                </div>
                <div class="col-md-4 BlogSideImage">
                    <img src="./files/Angular@1x.png" alt="angular">
                </div>
            </div>
        </div>
        <div class="col-md-6 halfSide">
            <div class="row">
                <div class="col-md-8">
                    <div class="blogTitle">this is paragraph</div>
                    <p> this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is paragraph this is </p>
                </div>
                <div class="col-md-4 BlogSideImage">
                    <img src="./files/vue@2x.png" alt="angular">
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>