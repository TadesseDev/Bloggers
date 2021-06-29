const pictureAdded = () => {
  //   const imageElement = document.getElementById("AddPicture");
  //   console.log(imageElement);
  const selectFile = document.querySelector("label[for='AddPicture']");
  selectFile.style = "display: none";
  const upload = document.querySelector("#upload");
  upload.style = "display: inline";
  const cancel = document.querySelector("#cancel");
  cancel.style = "display: inline";
};
const cancePhotoUpload = () => {
  const selectFile = document.querySelector("label[for='AddPicture']");
  selectFile.style = "display: inline";
  const upload = document.querySelector("#upload");
  upload.style = "display: none";
  const cancel = document.querySelector("#cancel");
  cancel.style = "display: none";
};
