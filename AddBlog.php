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
    $_SESSION['textArea'] = array();
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
<div class="container">
    <form action="./uploadNewBlogData.php" method="POST" enctype="multipart/form-data">
        <div class="row CreateBloog">
            <div class="col-sm-12 textArea ">
                <div class="editPost">
                    <?php
                    $keys = array_keys($_SESSION['order']);
                    $preservkeys = array_keys($_SESSION['preserve']);
                    for ($i = 0; $i < sizeof($_SESSION['textArea']); $i++) :
                    ?>
                        <div class="textareaContainer"><textarea class="" name="<?php echo $i ?>" placeholder="compile your blog here and preview will be available on the bottom of this page"><?php echo $_SESSION['textArea'][$i]; ?></textarea>
                        </div><?php
                                foreach ($keys as $key) :
                                    if (floor((float)$key) == $i) {
                                        if ($_SESSION['order'][$key][0] == 'image') {
                                            echo $_SESSION['order'][$key][1]['name'] . $BR;
                                        } else if ($_SESSION['order'][$key][0] == 'preservedText') {
                                ?>
                                    <pre class="preview">
                                <code class="language-<?php echo $_SESSION['order'][$key][1]['language']; ?>">
                                <?php echo $_SESSION['order'][$key][1]['content'] . $BR; ?>
                                </code>
                                </pre>
                        <?php
                                        }
                                    }
                                endforeach;
                            endfor;
                            if (sizeof($_SESSION['textArea']) === 0) {
                        ?>
                        <div class="textareaContainer"><textarea name="<?php echo sizeof($_SESSION['textArea']) ?>" placeholder="compile your blog here and preview will be available on the bottom of this page"></textarea></div>
                    <?php } ?>
                    <div>
                        <div class=" add">
                            <label for="AddPicture" class="sideButton">
                                <span><img class="icon" src="./files/icons/camera-brown.png" alt="add picture"></span>
                            </label>
                            <button type="submit" name="uploadImage" class="sideButton save" id="upload">
                                <span><img class="icon" src="./files/icons/Save-brown.png" alt="add picture">
                                </span></button>
                            <button type="submit" class="sideButton cancel" id="cancel" onclick="cancePhotoUpload();" name="cancelPhotoUpdate">
                                <span><img class="icon" src="./files/icons/Cancel-brown.png" alt="add picture"></span></button>
                            <input type="file" accept="image/*" onchange="pictureAdded();" name="AddPicture" id="AddPicture"></input>
                            <button type="button" class="sideButton" data-toggle="modal" data-target="#exampleModalCenter">
                                <span><img class="icon" src="./files/icons/code-brown.png" alt="add picture"></span>
                            </button>
                            <!-- <input type="file" id="addPreserveText"></input> -->
                            <button type="submit" name="reset" class="sideButton">
                                <span><img class="icon" src="./files/icons/Refresh-brown.png" alt="add picture"></span>
                            </button>
                            <button type="submit" name="preview" class="sideButton">
                                <span><img class="icon" src="./files/icons/Eye-brown.png" alt="add picture"></span></button>
                            <button type="clear" name="addTextArea" class="sideButton">
                                <span><img class="icon" src="./files/icons/Add-text-area-brown.png" alt="add picture" disabled></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="CreateBlogBotom">
                    <div class="author">
                        <p>Author</p>
                        <?php
                        if (isset($_SESSION['userId'])) :
                        ?>
                            <p><?php echo $_SESSION['userFname'] . " " . $_SESSION['userLname'] ?></p>
                        <?php endif; ?>
                    </div>
                    <label for="type">Type</label>
                    <input type="text" name="type" class="simpleTextField" value="<?php echo $_SESSION['type'] ?>">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="simpleTextField" value="<?php echo $_SESSION['title'] ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 preview">
                <?php
                if (sizeof($_SESSION['textArea']) < 1 && sizeof($_SESSION['preserve']) < 1)
                    echo "no preview yet" . $BR;
                else {
                    if ($_SESSION['title'] == null)
                        echo "no title" . $BR;
                    if ($_SESSION['type'] == null)
                        echo "no type is set" . $BR;
                    echo $_SESSION['title'] . $BR;
                    echo $_SESSION['type'] . $BR;
                    $imageKeys = array_keys($_SESSION['images']);
                    $preservkeys = array_keys($_SESSION['preserve']);
                    $i = 0;
                    foreach ($_SESSION['textArea'] as $x) {
                        $paras = explode("\n", $x);
                        foreach ($paras as $para) {
                            echo $para . $BR;
                        }
                        foreach ($keys as $key) :
                            if (floor((float)$key) == $i) {
                                if ($_SESSION['order'][$key][0] == 'image') {
                                    echo $_SESSION['order'][$key][1]['name'] . $BR;
                                } else if ($_SESSION['order'][$key][0] == 'preservedText') {
                                    // ["content" => $_POST['PreservedText'], "language" => $_POST['category']]
                ?>
                                    <pre>

                        <code class="language-<?php echo $_SESSION['order'][$key][1]['language']; ?>">
                        <?php echo $_SESSION['order'][$key][1]['content'] . $BR; ?>
                        </code>
                        </pre>
                <?php
                                }
                            }
                        endforeach;
                        // echo $x . $BR;
                        $i++;
                    }
                }
                ?>
                <button type="submit" name="upload">Publish</button>
            </div>
        </div>
        <div class=" modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="codeBlock modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header darkBrown">
                        <h5 class="modal-title ColorOrange" id="exampleModalLongTitle">chose your language</h5>
                        <div class="languageOption">
                            <input type="text" list="languages" name="category" id="lang" class="select" placeholder="select lang">
                            <datalist id="languages">
                                <option value="HTML">
                                <option value="PHP">
                                <option value="Java">
                                <option value="SQL">
                                <option value="JavaScript">
                                <option value="JSON">
                            </datalist>
                            <span class="icon" id="statusIcon">
                                <!-- <img class="icon" src="./files/icons/x-red.png" alt="add picture" disabled>
                                <img class="icon" src="./files/icons/correct-green.png" alt="correct input" disabled> -->
                            </span>
                        </div>
                        <button type="button" class="close ColorOrange" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <textarea name="PreservedText" cols="30" rows="10"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button darkBrown ColorOrange" data-dismiss="modal">cancel</button>
                        <button type="submit" class="button darkBrown ColorOrange" name="addSpecialCharacter" id="submitCodeContent">submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php include "footer.php"; ?>