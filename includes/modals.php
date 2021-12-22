<div class="modal fade" id="registration-status-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header darkBrown <?php echo $text_color; ?> ">
                <h5 class="modal-title" id=""><?php echo $modal_title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="ColorLightOrange">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span aria-hidden="true"><?php echo $modalBodyText; ?></span>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" type="submit" class="btn <?php echo $buttonBackground . " " . $bottom_text_color ?> "><?php echo $bottom_text; ?></button>
            </div>
        </div>
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
                    </datalist>
                    <span class="icon" id="statusIcon">
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
                <button type="submit" class="button darkBrown ColorOrange" name="addSpecialCharacter" id="submitCodeContent">submit</button>
                <button type="button" class="button darkBrown Lired" data-dismiss="modal">cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="BlogTitle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header darkBrown ColorOrange">
                <h5 class="modal-title" id="">Type your Blog sub title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="ColorLightOrange">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span aria-hidden="true">
                    <input type="text" name="subTitle" class="simpleTextField fontS-1_5em" value="" placeholder="this is my subtitle">
                </span>
            </div>
            <div class="modal-footer">
                <button type="submit" name="addSubTitle" class="btn button">submit</button>
                <button type="button" class="button darkBrown ColorOrange" data-dismiss="modal">cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="BlogCoverModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Image Before Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="sample_image" />
                        </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="crop" class="btn btn-primary">Crop</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="imageCaption" tabindex="-1" role="dialog" aria-labelledby="imageCaptionReader" aria-hidden="true">
    <!-- <div class="modal fade" id="imageCaption" tabindex="-1" role="dialog" aria-labelledby="imageCaptionReader"> -->
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content ">
            <div class="modal-header darkBrown">
                <h5 class="modal-title ColorOrange">pleas enter cation for your image</h5>
                <button type="button" class="close ColorOrange" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="simpleTextField fullWidth" name="pictureCaption" placeholder="name your picture">
            </div>
            <div class="modal-footer">
                <button type="submit" name="uploadImage" class="button save" id="upload">
                    <span>Save</span>
                </button>
                <button type="button" class="button cancel Lired ColorDarkBrown" id="cancel" data-dismiss="modal">
                    <span>Cancel</span>
                </button>
            </div>
        </div>
    </div>
</div>