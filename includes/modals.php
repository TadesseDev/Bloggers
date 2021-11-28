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