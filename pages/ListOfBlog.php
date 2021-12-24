<?php
@include_once("../includes/functions.php");
isset($_SESSION) ? "" : session_start();
$limitBottom = 0;
$topLimit = 1;
$filter = "timeof";
if (isset($_GET['limitId']))
    $limitBottom = is_numeric($_GET['limitId']) ? ($_GET['limitId'] - 1) * $topLimit : 0;
if (isset($_POST['filterId']))
    $filter = $_POST['filterId'];
$query = "select * from (select b.id, b.timeOf, b.author, b.title, b.type, b.cover from blog as b order by($filter) DESC)as res limit $limitBottom,$topLimit;";
// $query = "select b.id, b.timeOf, b.author, b.title, b.type, b.cover from blog as b order by($filter) DESC;";

$result = getQueryResult($query);
if (is_numeric($result) || mysqli_num_rows($result) < 1) {
    echo "error fetching blogs";
    return;
}
$getAllBlogs = mysqli_fetch_all($result, 1);
// echo print_r($getAllBlogs);
$blogDetail = [[[], [], []]];

for ($i = 0; $i < count($getAllBlogs); $i++) {
    $blog = $getAllBlogs[$i];
    // echo print_r($blog['timeOf']) . "<br/>";
    $bId = $blog['id'];
    $bAId = $blog['author'];
    $blogInfo = ["id" => $bId, "time" => $blog['timeOf'], "author" => $bAId, "title" => $blog['title'], "type" => $blog['type'], "cover" => $blog['cover']];
    // $blogDetail[$i][0] = [];
    $blogDetail[$i][0] = $blogInfo;
    $res = getQueryResult("select a.fname, a.lname, a.title from author as a where a.id=$bAId;");
    // echo print_r($res) . "<br/>";
    if ($res) {
        $author = mysqli_fetch_assoc($res);
        $authorInfo = ["id" => $bAId, "fname" => $author['fname'], "lname" => $author['lname'], "title" => $author['title']];
        // $blogDetail[$i][1] = [];
        $blogDetail[$i][1] = $authorInfo;
    } else {
        $blogDetail[$i][1] = null;
    }
    $content =  mysqli_fetch_all(getQueryResult("select c.orderOf, c.contentType, c.content, c.remark from content as c where c.bid=$bId;"), 1);
    // $blogDetail[$i][2] = [];
    $blogDetail[$i][2] = $content;
} ?>
<div class="row align-items-center justify-content-center BlogList ">
    <?php
    // if (is_array($blogDetail[0][0])) {
    foreach ($blogDetail as $key => $blog) :
        $preview = "";
        // echo print_r($blog[0]['title']) . "<br/>";
        for ($i = 0; $i < count($blog[2]) && strlen($preview) < 300; $i++) {
            if ($blog[2][$i]['contentType'] == 1) {
                $preview = $preview . $blog[2][$i]['content'];
            }
        }
        $preview = substr($preview, 0, 300) . "....";
    ?><?php if (strlen($blog[0]['title']) > 45) { ?>
    <div class="col-md-11">
    <?php } else {
    ?>
        <div class="col-md-6">
        <?php
        } ?>
        <div class="row halfSide">
            <div class="col-md-12">
                <div class="blogPreviewTitle">
                    <p><?php echo $blog[0]['title'] ?></p>
                </div>
                <div class="previewContetn">
                    <div class="BlogSideImage">
                        <img src="<?php echo $blog[0]['cover'] ?>" alt="angular">
                    </div>
                    <span class="textContent">
                        <div class="blogPreviewInfo">
                            <p> About: <?php echo $blog[0]['type'] ?></p>
                            <a href="#">
                                <p> By: <?php echo  $blog[1] != null ? $blog[1]['title'] . ", " . $blog[1]['fname'] . $blog[1]['lname'] : "anonymous" ?></p>
                            </a>
                        </div>
                        <p><?php echo $preview ?></p>
                    </span>
                </div>
                <div class="halfsideFooter">
                    <a href="#" id="<?php echo $blog[0]['id'] ?>" onclick="displaySingleBlog({bid: <?php echo $blog[0]['id'] ?>})">read more...</a>
                    <p>published: <?php echo $blog[0]['time'] ?></p>
                </div>
            </div>
        </div>
        </div>
    <?php
    endforeach;
    // } else {
    //     echo "there is no blog yet";
    // } 
    // display slider based on the available data
    $query = "select * from blog as b order by($filter)";
    $result = getQueryResult($query);
    $pages = ceil(mysqli_num_rows($result) / $topLimit);
    if ($pages > 1) {
    ?>
        <div class="slider col-xs-12">
            <img class="back" src="./files/icons/double_left.svg"></img>
            <div class="elements">
                <a href="" class="item active" id="1">1</a>
                <?php
                for ($i = 2; $i <= $pages; $i++) {

                    echo "<a href='' class='item' id='$i'>$i</a>";
                }
                ?>
                <!-- <a href="" class="item ">2</a>
                <a href="" class="item ">3</a> -->
            </div>
            <img class="next" src="./files/icons/double_right.svg"></img>
        </div>
    </div>
<?php
    }
?>