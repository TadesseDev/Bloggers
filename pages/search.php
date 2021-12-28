<?php
@include_once("../includes/connection.php");
if (isset($_POST['loadGrid'])) {
    $searchFor = mysqli_real_escape_string($con, $_POST['searchFor']);
?>
    <div class="searchDisplay">
        <div class="blogs">
            <p class="title1"> Blogs</p>
            <hr>
            <div class="result">
                <p>loading blogs for <?php echo $searchFor ?></p>
            </div>
        </div>
        <div class="authors">
            <p class="title1"> Bloggers</p>

            <hr>
            <div class="result">
                <p>loading bloggers for <?php echo $searchFor ?></p>
            </div>
        </div>
    </div>
<?php
}
if (isset($_POST['search'])) {
    $searchIn = mysqli_real_escape_string($con, $_POST['searchIn']);
    $searchFor = mysqli_real_escape_string($con, $_POST['searchFor']);
    echo print_r($_POST);
}
