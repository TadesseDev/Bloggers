<?php
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
$BR = "<br/>";
?>
<div class="container">
    <form action="./uploadNewBlogData.php" method="POST" enctype="multipart/form-data">
        <div class="row CreateBloog">
            <div class="col-sm-12 textArea">
                <div class="editPost">
                    <?php
                    $keys = array_keys($_SESSION['images']);
                    $preservkeys = array_keys($_SESSION['preserve']);
                    for ($i = 0; $i < sizeof($_SESSION['textArea']); $i++) :
                    ?>
                        <textarea name="<?php echo $i ?>" placeholder="compile your blog here and preview will be available on the bottom of this page"><?php echo $_SESSION['textArea'][$i]; ?></textarea>
                        <?php
                        foreach ($keys as $image) {
                            if (floor((float)($image)) == $i) {

                                foreach ($preservkeys as $preserve) {
                                    if (floor((float)($preserve)) == $i) {
                                        if ((float)($preserve) <= (float)($image)) {
                                            // since we are useing a time stap this is highly unlikly to become equa;
                                            //print the preserved text here 
                                            echo $_SESSION['preserve'][$preserve] . $BR;
                                        }
                                    }
                                }
                                // echo print_r($_SESSION['images'][$image]) . $BR;
                                $tmpName = $_SESSION['images'][$image]['name'];
                                echo $tmpName . $BR;
                                //
                                foreach ($preservkeys as $preserve) {
                                    if (floor((float)($preserve)) == $i) {
                                        if ((float)($preserve) > (float)($image)) {
                                            //print the preserved text here 

                                            echo $_SESSION['preserve'][$preserve] . $BR;
                                        }
                                    }
                                }
                                break;
                            }

                            foreach ($preservkeys as $preserve) {
                                if (floor((float)($preserve)) == $i) {
                                    //print the preserved text here 
                                    echo $_SESSION['preserve'][$preserve] . $BR;
                                }
                            }
                        }
                    endfor;
                    if (sizeof($_SESSION['textArea']) === 0) {
                        ?>
                        <textarea name="<?php echo sizeof($_SESSION['textArea']) ?>" placeholder="compile your blog here and preview will be available on the bottom of this page"></textarea>
                    <?php } ?>
                    <div class=" add">
                        <label for="AddPicture" class="sideButton">
                            <span id=""><img class="icon" src="./files/icons/camera-brown.png" alt="add picture"></span>
                        </label>
                        <button type="submit" name="uploadImage" class="sideButton save" id="upload">
                            <span id=""><img class="icon" src="./files/icons/Save-brown.png" alt="add picture">
                            </span></button>
                        <button type="submit" class="sideButton cancel" id="cancel" onclick="cancePhotoUpload();" name="cancelPhotoUpdate">
                            <span id=""><img class="icon" src="./files/icons/Cancel-brown.png" alt="add picture"></span></button>
                        <input type="file" accept="image/*" onchange="pictureAdded();" name="AddPicture" id="AddPicture"></input>
                        <button type="button" class="sideButton" data-toggle="modal" data-target="#exampleModalCenter">
                            <span id=""><img class="icon" src="./files/icons/code-brown.png" alt="add picture"></span>
                        </button>
                        <!-- <input type="file" id="addPreserveText"></input> -->
                        <button type="submit" name="reset" class="sideButton" id="">
                            <span id=""><img class="icon" src="./files/icons/Refresh-brown.png" alt="add picture"></span>
                        </button>
                        <button type="submit" name="preview" class="sideButton" id="">
                            <span id=""><img class="icon" src="./files/icons/Eye-brown.png" alt="add picture"></span></button>
                        <button type="clear" name="addTextArea" class="sideButton" id="">
                            <span id=""><img class="icon" src="./files/icons/Add-text-area-brown.png" alt="add picture" disabled></span></button>
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
                            echo $para . $BR . $BR;
                        }
                        foreach ($imageKeys as $image) {
                            if (floor((float)($image)) == $i) {
                                foreach ($preservkeys as $preserve) {
                                    if (floor((float)($preserve)) == $i) {
                                        if ((float)($preserve) <= (float)($image)) {
                                            // since we are useing a time stap this is highly unlikly to become equa;
                                            //print the preserved text here 
                                            echo $_SESSION['preserve'][$preserve] . $BR;
                                        }
                                    }
                                }
                                // echo print_r($_SESSION['images'][$image]) . $BR;
                                // once we found the image we will look for preserved texts which might come before 
                                // that image but are next to the same text box.
                                $tmpName = $_SESSION['images'][$image]['name'];
                                echo $tmpName . $BR;
                                // onec we print the image we will slo look for preserved texts which are in the same 
                                //text box sequence but come after the image 
                                foreach ($preservkeys as $preserve) {
                                    if (floor((float)($preserve)) == $i) {
                                        if ((float)($preserve) > (float)($image)) {
                                            //print the preserved text here 

                                            echo $_SESSION['preserve'][$preserve] . $BR;
                                        }
                                    }
                                }
                                break; // go to the next paragraph
                            }
                            // this one will be excuted if no picture were found
                            foreach ($preservkeys as $preserve) {
                                if (floor((float)($preserve)) == $i) {
                                    //print the preserved text here 
                                    echo $_SESSION['preserve'][$preserve] . $BR;
                                }
                            }
                        }
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
                            <select name="category">
                                <option value="">HTML</option>
                                <option value="">PHP</option>
                                <option value="">Java</option>
                                <option value="">SQL</option>
                                <option value="">JavaScript</option>
                                <option value="">JSON</option>
                            </select>
                        </div>
                        <button type="button" class="close ColorOrange" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <textarea name="PreservedText" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button darkBrown ColorOrange" data-dismiss="modal">cancel</button>
                        <button type="submit" class="button darkBrown ColorOrange" name="addSpecialCharacter">submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php include "footer.php"; ?>