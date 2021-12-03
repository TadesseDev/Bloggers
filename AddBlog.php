<?php

use function PHPSTORM_META\type;

include "header.php";
if (!isset($_SESSION['type'])) {
    $_SESSION['type'] = null;
}
if (!isset($_SESSION['title'])) {
    $_SESSION['title'] = null;
}
if (!isset($_SESSION['textArea'])) {
    $_SESSION['textArea'] = array("");
}
if (!isset($_SESSION['images'])) {
    $_SESSION['images'] = array();
}
if (!isset($_SESSION['preserve'])) {
    $_SESSION['preserve'] = array();
}
if (!isset($_SESSION['order'])) {
    $_SESSION['order'] = array();
}
$BR = "<br/>";
?>
<form action="uploadNewBlogData.php" method="POST" enctype="multipart/form-data">
    <div class="fullContainer" id="authorInfo">
        <div class="CreateBlogHeader container ">
            <div class="author">
                <p>Author
                    <?php
                    if (isset($_SESSION['userId'])) :
                        echo "<p>" . $_SESSION['userFname'] . " " . $_SESSION['userLname'] . "</p>";
                    else :
                        echo "uknown user... pleas sign in";
                    endif; ?>
                </p>
            </div>
            <label for="type" class="fontS-1_5em ">Blog Type</label>
            <input type="text" id="type" name="type" class="simpleTextField fontS-1_5em" value="<?php echo $_SESSION['type'] ?>" required>
            <label for="title" class="fontS-1_5em ">Blog Title</label>
            <input type="text" id="title" name="title" class="simpleTextField fontS-1_5em" value="<?php echo $_SESSION['title'] ?> " required>
        </div>
    </div>
    <div class="container">
        <div class="row CreateBloog">
            <div class="col-sm-12 textArea ">
                <div class="editPost">
                    <div id="BlogTypePreview">
                        <p class="font-open-sans fontS-1_5em"></p>
                    </div>
                    <div id="BlogTitlePreview">
                        <p class="font-open-sans fontS-2em"></p>
                    </div>
                    <?php
                    $keys = array_keys($_SESSION['order']);
                    // echo print_r($_SESSION['order']);
                    $preservkeys = array_keys($_SESSION['preserve']);
                    for ($i = 0; $i < sizeof($_SESSION['textArea']); $i++) :
                    ?>
                        <div class="textareaContainer"><textarea class="blogCreateTA" name="<?php echo $i ?>" placeholder="compile your blog here and preview will be available on the bottom of this page"><?php echo $_SESSION['textArea'][$i]; ?></textarea>
                        </div><?php
                                foreach ($keys as $key) :
                                    if (floor((float)$key) == $i) {
                                        $vals = explode("_", $_SESSION['order'][$key][0]);
                                        if ($vals[0] == 'image') {
                                            // echo "<h3>image is here...</h3>";
                                            if ($vals[1] !== "workOnServerData") {
                                                echo "<img class='MHeight-500 margin-auto display-block' id='" . $key . "'> </img>";
                                                echo "<script>upFromLST($vals[1]," . $key . ")</script>";
                                            } else {
                                                echo "<img class='MHeight-500 margin-auto display-block' id='" . $key . "' src='./files/blogsData/tempoUpload/$key.png'> </img>";
                                            }
                                        } else if ($_SESSION['order'][$key][0] == 'preservedText') {
                                ?>
                                    <!-- echo "<h3>programing code is here...</h3>"; -->
                                    <pre>
                                            <code class="language-<?php echo $_SESSION['order'][$key][1]['language']; ?>">
                                            <?php echo $_SESSION['order'][$key][1]['content'] . $BR; ?>
                                            </code>
                                            </pre>
                        <?php
                                        } else if ($_SESSION['order'][$key][0] == 'subTitle') {
                                            echo "<h2>" . $_SESSION['order'][$key][1] . "</h2>";
                                        }
                                    }
                                endforeach;
                            endfor;
                            if (sizeof($_SESSION['textArea']) === 0) {
                        ?>
                        <div class="textareaContainer"><textarea class="blogCreateTA" name="<?php echo sizeof($_SESSION['textArea']) ?>" placeholder="compile your blog here and preview will be available on the bottom of this page"></textarea></div>
                    <?php } ?>
                    <div>
                        <div class=" add">
                            <label for="AddPicture" class="sideButton">
                                <span><img class="icon" src="./files/icons/camera-brown.png" alt="add picture"></span>
                            </label>
                            <button type="submit" name="uploadImage" oninput="cancePhotoUpload();" class="sideButton save" id="upload">
                                <span><img class="icon" src="./files/icons/Save-brown.png" alt="save picture">
                                </span></button>
                            <button type="submit" class="sideButton cancel" id="cancel" onclick="cancePhotoUpload();" name="cancelPhotoUpdate">
                                <span><img class="icon" src="./files/icons/Cancel-brown.png" alt="dont save"></span></button>
                            <input type="file" accept="image/*" oninput="pictureAdded();" name="AddPicture" id="AddPicture"></input>
                            <button type="button" class="sideButton" data-toggle="modal" data-target="#exampleModalCenter">
                                <span><img class="icon" src="./files/icons/code-brown.png" alt="add programing code"></span>
                            </button>
                            <button type="button" name="addsubTitle" class="sideButton" data-toggle="modal" data-target="#BlogTitle">
                                <span><img class="icon" src="./files/icons/title.svg" alt="add a title" disabled></span>
                            </button>
                            <button type="clear" name="addTextArea" class="sideButton">
                                <span><img class="icon" src="./files/icons/Add-text-area-brown.png" alt="create text area here" disabled></span>
                            </button>
                            <button type="submit" name="reset" class="sideButton">
                                <span><img class="icon" src="./files/icons/Refresh-brown.png" alt="reset everything"></span>
                            </button>
                            <button type="submit" name="preview" class="sideButton">
                                <span><img class="icon" src="./files/icons/Eye-brown.png" alt="preview your compose"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 preview">
                <?php
                // if (sizeof($_SESSION['textArea']) < 1 && sizeof($_SESSION['preserve']) < 1)
                //     echo "no preview yet" . $BR;
                // else {
                //     echo !$_SESSION['type'] ? "no type is set" . $BR : $_SESSION['type'] . $BR;
                //     echo !$_SESSION['title'] ? "no title" . $BR : $_SESSION['title'] . $BR;
                //     // echo $_SESSION['type'] . $BR;
                //     $imageKeys = array_keys($_SESSION['images']);
                //     $preservkeys = array_keys($_SESSION['preserve']);
                //     $i = 0;
                //     foreach ($_SESSION['textArea'] as $x) {
                //         $paras = explode("\n", $x);
                //         foreach ($paras as $para) {
                //             echo $para . $BR;
                //         }
                //         foreach ($keys as $key) :
                //             if (floor((float)$key) == $i) {
                //                 $vals = explode("_", $_SESSION['order'][$key][0]);
                //                 if ($vals[0] == 'image') {
                //                     // echo $_SESSION['order'][$key][1]['name'] . $BR;
                //                     if ($vals[1] !== "workOnServerData") {
                //                         echo "<img class='MHeight-500 margin-auto display-block' id='" . $key . "'> </img>";
                //                         echo "<script>upFromLST($vals[1]," . $key . ")</script>";
                //                     } else {
                //                         echo "<img class='MHeight-500 margin-auto display-block' id='" . $key . "' src='./files/blogsData/tempoUpload/$key.png'> </img>";
                //                     }
                //                 } else if ($_SESSION['order'][$key][0] == 'preservedText') {
                ?>
                <!-- <pre> -->
                <!-- <code class="language-<?
                                            // php echo $_SESSION['order'][$key][1]['language']; 
                                            ?>"> -->
                <?php
                // echo $_SESSION['order'][$key][1]['content'] . $BR; 
                ?>
                <!-- </code>
                        </pre> -->
                <?php
                //                 }
                //             }
                //         endforeach;
                //         $i++;
                //     }
                // }
                ?>
                <button type="submit" name="upload">Publish</button>
            </div>
        </div>
        <?php include "./includes/modals.php"; ?>
</form>
</div>
<?php
include "footer.php"; ?>