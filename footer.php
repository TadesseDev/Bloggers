<?php
?>

<div class="footer">
    <div class="top">
        <div class="container-fluid align-items-center">
            <div class="row">
                <div class="searchBox col-xs-12">
                    <input type="text" name="search" id="searchText" />
                    <button type="submit" name="search" id="searchButton">search</button>
                </div>
            </div>
        </div>
    </div>
    <div class="middle">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-between">
                <div class="logo col-sm-4 align-self-baseline">
                    <img src="./files/icons/logo.png" alt="WinMac-Logo">
                    <h6>WinMac</h6>
                    <h6>Digital Marketing</h6>
                </div>
                <div class="footerNavigation col-sm-4">
                    <h3>BLOGGERS.</h3>
                    <ul>
                        <li>Home</li>
                        <li>Blogs</li>
                        <li>Search</li>
                        <li>About Us</li>
                    </ul>
                </div>
                <siv class="whatWeDo col-sm-4">
                    <h3>WHAT WE DO.</h3>
                    <ul>
                        <li>FullStack Web-app development</li>
                        <li>Digital Advertising</li>
                        <li>Logo and Graphics Design</li>
                        <li>more...</li>
                    </ul>
                </siv>
            </div>
        </div>
    </div>
    <div class="bottom">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-8 legal-content">
                    <span class="legalDoc">TERMS AND CONDITIONS</span>
                    <span class="legalDoc">PRIVACY POLICES</span>
                    <span class="legalDoc">SITE MAP</span>
                </div>
                <div class="col-md-4 contact">
                    <strong>CONTACT</strong>
                    <ul class="title">
                        <li>blog-ers.cf@gmail.com</li>
                        <li>+251921577930</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

</div> <!-- normal flow-->
</body>
<div class=" modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <input type="email" class="simpleTextField " name="email" placeholder="email" required>
                    <input type="password" class="simpleTextField " name="password" placeholder="password" required>
                    <?php if (isset($_GET['cantSignIn'])) {
                        echo "<script>clickObject('login')</script>";
                        echo "<span class='simpleErrore'>user name or Password is wrong</span>";
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="button darkBrown ColorOrange" data-dismiss="modal">Close</button>
                    <button type="submit" class="button darkBrown ColorOrange" name="login">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- <script> -->
<!-- <script lang="javascipt" src="./javascript/jquery-1.12.0.min.js"></script> -->
<script lang="javascript" src="./javascript/bootstrap-4.5.3-dist/js/bootstrap.js"></script>
<script lang="javascript" src="./javascript/cropperjs-main/cropper.min.js"></script>
<script lang="javascript" src="./javascript/resource.js"></script>
<script lang="javascript" src="./javascript/prism.js"></script>
<script lang="javascript" src="./javascript/index.js"></script>

</html>