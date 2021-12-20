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
<?php
?>
</div> <!-- normal flow-->
</body>
<!-- <script> -->
<!-- <script lang="javascipt" src="./javascript/jquery-1.12.0.min.js"></script> -->
<script lang="javascipt" src="./javascript/bootstrap-4.5.3-dist/js/bootstrap.js"></script>
<script lang="javascipt" src="./javascript/cropperjs-main/cropper.min.js"></script>
<script lang="javascript" src="./javascript/resource.js"></script>
<script lang="javascript" src="./javascript/prism.js"></script>
<script lang="javascript" src="./javascript/index.js"></script>

</html>