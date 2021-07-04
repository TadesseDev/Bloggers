<?php include "header.php";
include "./includes/validateRegistration.php";
// echo print_r(gd_info());
// $image = imagecreatefrompng("./files/3D tube WM.png");
// $rotateImage = imagerotate($image, 45, false);
// imagepng($rotateImage, "./files/createdImage.png", 9);
?>
<div class="jumbotron">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-8">
                <div class="textContent">
                    <ol>
                        <li class="title">
                            <p>what we do here ?</p>
                        </li>
                        <li>
                            <p>provide a space for anyone to share their thought. </p>
                        </li>
                        <li>
                            <p>respond for a request blog in a specific area. </p>
                        </li>
                        <li>
                            <p>subscribe to receive latest posts.</p>
                        </li>
                        <li>
                            <p>or contact us for any guidance. </p>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="col-sm-4 imageContainer">
                <img src="./files/3D tube WM.png" alt="winmac Text">
            </div>
        </div>
    </div>
</div>
<div class="container zero-top">
    <div class="userAction">
        <form action="" method="POST">
            <?php
            if (!isset($_SESSION['userId'])) :
            ?>
                <button class="button" type="submit" name="Register">Register</button>
                <button class="button" type="button" name="showLoginModal" data-toggle="modal" data-target="#exampleModalCenter">Login</button>
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
<div class=" modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header darkBrown">
                <h5 class="modal-title ColorOrange" id="exampleModalLongTitle">Login... Do More</h5>
                <button type="button" class="close ColorOrange" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="text" class="simpleTextField half" name="email" placeholder="email">
                    <input type="text" class="simpleTextField half" name="password" placeholder="password">
                </div>
                <div class="modal-footer">
                    <button type="button" class="button darkBrown ColorOrange" data-dismiss="modal">Close</button>
                    <button type="submit" class="button darkBrown ColorOrange" name="login">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class=" container Home">
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