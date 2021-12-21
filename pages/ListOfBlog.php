<?php
@include_once("../includes/functions.php");
isset($_SESSION) ? "" : session_start();
$getAllBlogs = mysqli_fetch_all(getQueryResult("select b.id, b.timeOf, b.author, b.title, b.type, b.cover from blog as b;"), 1);
// echo print_r($getAllBlogs);
$blogDetail = [[[], [], []]];

for ($i = 0; $i < count($getAllBlogs); $i++) {
    // echo $i . "<br/>";
    // echo print_r($getAllBlogs[$i]) . "<br/>";
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
        $auuthorInfo = ["id" => $bAId, "fname" => $author['fname'], "lname" => $author['lname'], "title" => $author['title']];
        // $blogDetail[$i][1] = [];
        $blogDetail[$i][1] = $auuthorInfo;
    } else {
        $blogDetail[$i][1] = null;
    }
    $content =  mysqli_fetch_all(getQueryResult("select c.orderOf, c.contentType, c.content, c.remark from content as c where c.bid=$bId;"), 1);
    // $blogDetail[$i][2] = [];
    $blogDetail[$i][2] = $content;
    // echo $key . "<br/>";
    // echo print_r($content) . "<br/>";
} ?>
<div class="row align-items-center justify-content-center BlogList ">
    <?php
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
    ?>
    <!--
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
        </div> -->
    </div>