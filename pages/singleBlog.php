<?php
@include_once("../includes/functions.php");
isset($_SESSION) ? "" : session_start();
$_POST['blogId'] = 1;
if (isset($_POST['blogId'])) :
    $bid = $_POST['blogId'];
    // echo $bid;
    $blog = mysqli_fetch_assoc(getQueryResult("select b.id, b.timeOf, b.author, b.title, b.type, b.cover from blog as b where b.id=$bid;"));
    $bAId = $blog['author'];
    $author = null;
    if ($bAId) {
        $author = mysqli_fetch_assoc(getQueryResult("select a.fname, a.lname, a.title, a.experties, a.email, a.profilePic from author as a where a.id=$bAId;"));
        // $auuthorInfo = ["id" => $bAId, "fname" => $author['fname'], "lname" => $author['lname'], "title" => $author['title'], "expertise" => $author['experties'], "email" => $author['email'], "profilePic" => $author['profilePic']];
    }
    if ($author != null) {
        $AFullName = $author['title'] . ", " . $author['fname'] . " " . $author['lname'];
        $ATitle = $author['experties'];
        $AEmail = $author['email'];
    } else {
        $AFullName = "unregisterd";
        $ATitle = "";
        $AEmail = "";
    }

    $contents = mysqli_fetch_all(getQueryResult("select c.orderOf, c.contentType, c.content, c.remark from content as c where c.bid=$bid order by(orderOf);"), 1);
?>
    <div class="row ">
        <a class="ColorDarkBrown" href="#" id="backToListOfBlog" onclick="displayBlogList()"><i class=" fontS-1_5em  bi bi-skip-backward-fill"></i></a>
    </div>
    <div class="row singleBlog">
        <div class=" col-md-8">
            <div class="mainContent">
                <div class="about">
                    <p><?php echo $blog['type'] ?></p>
                </div>
                <div class="title">
                    <p><?php echo $blog['title'] ?></p>
                </div>
                <div class="body">
                    <?php
                    foreach ($contents as $data) :
                        if ($data['contentType'] == 0) {
                    ?>
                            <p class="subTitle"><?php echo $data['content']; ?></p>
                        <?php
                        } else if ($data['contentType'] == 1) {
                        ?>
                            <p class="subTitle"><?php echo $data['content']; ?></p>
                        <?php
                        } else if ($data['contentType'] == 2) {

                        ?>
                            <pre>
                            <code class="language-<?php echo $data['remark']; ?>">
                            <?php echo $data['content'] . $BR; ?>
                            </code>
                            </pre>
                        <?php
                        } else if ($data['contentType'] == 3) {
                        ?>
                            <img class='MHeight-500 margin-auto display-block' src='<?php echo $data['content']; ?>'> </img>

                    <?php
                        }
                    // echo $data['contentType'];
                    // echo $data['orderOf'] . "<br/>";
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
        <div class=" col-md-4">
            <div class="rightContent">
                <div class="authorInfo">
                    <p class="title"> made possible by</p>
                    <p><?php echo $AFullName; ?></p>
                    <p><?php echo $ATitle; ?></p>
                    <p><?php echo $AEmail; ?></p>
                </div>
            </div>
            <div class="rightContent">
                xx
            </div>
        </div>
    </div>
    </div>
<?php
else :
    echo "no Blog Id is submited ";
endif;
?>