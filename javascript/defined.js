const infoModal = document.createElement("div");
$(infoModal).attr({
    "class": " modal fade",
    "id": "infoModal",
    "tabindex": "-1",
    "role": "dialog",
    "aria-labelledby": "exampleModalCenterTitle",
    "aria-hidden": "true"
});
infoModal.innerHTML = `  
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
    <div class="modal-header green">
        <h5 class="modal-title ColorDarkBrown" id="modalTitle">Information Modal</h5>
        <button type="button" class="close ColorOrange" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="" method="">
        <div class="modal-body" id="imfoBody">
        </div>
        <div class="modal-footer">
            <button type="button"  data-dismiss="modal" class="button green ColorDarkBrown" name="" onclick="(x)=>{console.log(x)}">okay</button>
        </div>
    </form>
</div>
</div>
"`;
// console.log(infoModal);
// $(infoModal).modal("show");

