<?php
@include_once($_SERVER['DOCUMENT_ROOT'] . "/includes/functions.php");
@require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/connection.php");
isset($_SESSION) ? "" : session_start();
// $_POST['blogId'] = 1;
if (isset($_POST['blogId']) || isset($_GET['bid'])) :
    if (isset($_POST['blogId']))
        $bid = mysqli_real_escape_string($con, $_POST['blogId']);
    else  $bid =  mysqli_real_escape_string($con, $_GET['bid']);
    // echo $bid;
    $blog = "";
    $res = getQueryResult("select b.id, b.dateTime, b.author, b.title, b.type, b.cover from blog as b where b.id=$bid;");
    if ($res)
        $blog = mysqli_fetch_assoc($res);
    if (is_array($blog)) {
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
            <a class="ColorDarkBrown" href="#" id="backToListOfBlog" onclick="displayBlogList()"><i class=" fontS-1_5em  bi bi-skip-backward-fill"></i>
                <span style="display: inline-block; font-weight: bold">Home</span>
            </a>
            <span class="">

            </span>
        </div>
        <div class="row singleBlog">
            <div class=" col-md-8">
                <div class="mainContent">
                    <div class="dateTime">
                        <span><?php echo $blog['dateTime'] ?></span>
                    </div>
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
                                $lines = explode("\n", $data['content']);
                                foreach ($lines as $p) :
                                    echo "<p>" . $p . "</p>";
                                endforeach;
                            } else if ($data['contentType'] == 2) {

                            ?>
                                <pre><code class="language-<?php echo $data['remark']; ?>"><?php echo $data['content'] . $BR; ?></code></pre>
                            <?php
                            } else if ($data['contentType'] == 3) {
                            ?>
                                <img class='MHeight-500 margin-auto display-block' src='<?php echo $data['content']; ?>'> </img>
                                <p style='text-align: center;'><?php echo $data['remark']; ?> </p>
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
                    ..
                </div>
                <div class="rightContent">
                    <div class="authorInfo">
                        <div class="authorPic">
                        </div>
                        <hr id="autorBottom">
                        <p><?php echo $AFullName; ?></p>
                        <p><?php echo $ATitle; ?></p>
                        <p><?php echo $AEmail; ?></p>
                    </div>
                </div>
                <div class="rightContent">
                    <div class="recentBlogs">
                        <p class="title"> recent blogs </p>
                        <div class="lists">

                        </div>
                    </div>

                    <script>
                        loadTopBlogs({
                            amount: 10,
                            by: "dateTime",
                            fields: ['title'],
                            target: $(".recentBlogs .lists"),
                            id: "title"
                        });
                        $(".authorInfo .authorPic").css({
                            "display": "none"
                        });
                        try {
                            console.log('');
                            let img = new Image();
                            img.src = '<?php echo $author['profilePic'] ?>';
                            img.onload = function() {
                                updateBackgroundPicture(this.src, $(".authorInfo .authorPic"))
                                $(".authorInfo .authorPic").css({
                                    "display": "block"
                                });
                            };
                        } catch (exc) {
                            console.log(exc);
                        }
                    </script>

                </div>
            </div>
        </div>
        </div>
<?php
    } else {
        echo "failed to fetch blog data";
    }
else :
    echo "no Blog Id is submitted ";
endif;
?>
<script lang="javascript" src="./javascript/prism.js"></script>