const upload = document.querySelector("#upload");
const cancel = document.querySelector("#cancel");
const selectFile = document.querySelector("label[for='AddPicture']");
const file = document.getElementById("AddPicture");
const BlogTitle = document.getElementById("title");
const BlogType = document.getElementById("type");
const BlogTypePreview = document.getElementById("BlogTypePreview");
const BlogTitlePreview = document.getElementById("BlogTitlePreview");
const BlogcoverImage = $("#blogCoverImage");
const pictureAdded = () => {
  selectFile.style = "display: none";
  upload.style = "display: inline";
  cancel.style = "display: inline";
};
const cancePhotoUpload = () => {
  selectFile.style = "display: inline";
  upload.style = "display: none";
  cancel.style = "display: none";
};
if (file) {
  file.onchange = function () {
    console.log(this.files[0]);
    const reader = new FileReader();
    reader.readAsDataURL(this.files[0]);
    reader.onload = function (e) {
      const add = document.getElementsByClassName("add")[0];
      const img = new Image();
      img.src = this.result;
      // console.log(img);
      // add.appendChild(img);
      img.onload = function () {
        img.width = 100;
        // const canvas = document.createEl
        const altImage = new File(["CONTENT"], img);
        // ement("canvas");
        // canvas.width = 100;
        // canvas.height = 100;
        // let drawer = canvas.getContext("2d");
        // drawer.drawImage(img, 0, 0, img.width, img.height, 0, 0, 100, 100);
        // console.log(drawer.getImageData(0, 0, canvas.width, canvas.height));
        // console.log(altImage);
        // add.appendChild(img);
        // file.value = img.src;
      };
      // file.value = "";
    };
  };
}
if (upload) {
  upload.onclick = function (e) {
    e.preventDefault();
    cancePhotoUpload();
    const formData = new FormData();
    // const fileData = file.files[0];
    const reader = new FileReader();
    reader.readAsDataURL(file.files[0]);
    reader.onload = function () {
      const resixzeImg = new Image();
      resixzeImg.src = reader.result;
      resixzeImg.onload = function () {
        const canvas = document.createElement("canvas");
        const width = 600;
        const scaleRatio = width / resixzeImg.width;
        const height = resixzeImg.height * scaleRatio;
        canvas.width = width;
        canvas.height = height;
        const ctx = canvas.getContext("2d");
        ctx.drawImage(resixzeImg, 0, 0, canvas.width, canvas.height);
        // document.body.appendChild(canvas);
        // const href = document.createElement("a");
        // href.href = ctx.canvas.toDataURL("image/jpeg");
        // href.download = "new file name";
        // href.click();
        // canvas.toBlob(function (e) {
        //   const val = window.URL.createObjectURL(e);
        //   console.log(val);
        // }, "image/jpeg");
        const textAreas = document.querySelectorAll(".blogCreateTA");
        let i = 0;
        textAreas.forEach((e) => {
          formData.append(`${i}`, e.value);
          i++;
        });
        formData.append("uploadImage", true);
        formData.append("AddPicture", ctx.canvas.toDataURL());
        formData.append("title", BlogTitle.value);
        formData.append("type", BlogTitle.value);
        let UniqTime = String(new Date().getTime());
        try {
          localStorage.setItem(UniqTime, ctx.canvas.toDataURL());
          formData.append("loaclSTR", UniqTime);
        } catch (e) {
          console.log("cant store to local storage " + e);
          console.log(
            "working on server data this might triger performace issue"
          );
          formData.append("loaclSTR", "workOnServerData");
        }
        console.log(UniqTime);
        // console.log(localStorage.getItem(UniqTime));
        fetch("uploadNewBlogData.php", {
          method: "POST",
          body: formData,
        })
          .then((e) => {
            console.log(e.status);
          })
          .catch((e) => {
            console.log("errore uploading form");
          });
      };
    };
    // console.log(fileData);
  };
}
if (BlogcoverImage) {
  let $modal = $("#modal");
  let image = document.getElementById("sample_image");
  var croper;
  BlogcoverImage.change(event => {
    let files = event.target.files;
    var don = (url) => {
      image.src = url;
      $modal.modal("show");
    }
    if (files && files.length > 0) {
      reader = new FileReader();
      reader.onload = (event) => {
        don(reader.result);
      };
      reader.readAsDataURL(files[0]);
      // CroperModal.modal("show");
    }
    $modal.on('shown.bs.modal', function () {
      cropper = new Cropper(image, {
        aspectRatio: 1,
        viewMode: 1,
        preview: '.preview'
      });
    }).on('hidden.bs.modal', function () {
      cropper.destroy();
      cropper = null;
    });
    // console.log(CroperModal);
    // console.log(val);
  });
  $("#crop").click(function () {
    console.log($(".cropper-crop-box").innerHTML);
    let canvase = cropper.getCroppedCanvas(
      {
        width: 400,
        height: 400
      }
    );
    // console.log(canvase);
    canvase.toBlob(function (blob) {
      url = URL.createObjectURL(blob);
      let reader = new FileReader();
      reader.readAsDataURL(blob);
      reader.onload = function () {
        let base64Image = reader.result;
        const formData = new FormData();
        const textAreas = document.querySelectorAll(".blogCreateTA");
        let i = 0;
        textAreas.forEach((e) => {
          formData.append(`${i}`, e.value);
          i++;
        });
        formData.append("uploadBlogCover", true);
        formData.append("blogCover", base64Image);
        formData.append("title", BlogTitle.value);
        formData.append("type", BlogTitle.value);
        fetch("uploadNewBlogData.php", {
          method: "POST",
          body: formData,
        })
          .then((e) => {
            console.log(e.status);
            $modal.modal("hide");
          })
          .catch((e) => {
            console.log("errore uploading form");
          });
        console.log(blob);
      }
      // image.src = url;
      // console.log(url);
    });
  });
}

// special character or code will be submited with only a valid language
let ValidLanguage = false;
const lang = document.getElementById("lang");
// lang.oninput;
let submitCodeContent = document.getElementById("submitCodeContent");
let statusIcon = document.getElementById("statusIcon");

submitCodeContent && [
  (submitCodeContent.disabled = true),
  (submitCodeContent.style.backgroundColor = "#886A6C"),
];
lang
  ? (lang.oninput = function () {
    const exist = suportedLanguage.indexOf(this.value);
    if (exist != -1) {
      ValidLanguage = true;
      submitCodeContent.disabled = false;
      statusIcon.innerHTML = `<img class="icon" src="./files/icons/correct-green.png" alt="correct input">`;
      submitCodeContent.style.backgroundColor = "#340100";
      submitCodeContent.style.color = "white";
    } else {
      ValidLanguage = false;
      submitCodeContent.disabled = true;
      statusIcon.innerHTML = `<img class="icon" src="./files/icons/x-red.png" alt="add picture" disabled>`;
      submitCodeContent.style.backgroundColor = "#886A6C";
    }
  })
  : lang;
submitCodeContent
  ? (submitCodeContent.onclick = function (x) {
    if (!ValidLanguage) x.preventDefault();
  })
  : submitCodeContent;

let textAreaContainer = $(".textareaContainer")[0];
let textArea = $(".textareaContainer textarea")[0];
document.addEventListener(
  "DOMContentLoaded",
  function () {
    const languages = document.getElementById("languages");
    suportedLanguage.forEach((x) => {
      let newel = document.createElement("option");
      newel.value = `${x}`;
      languages ? languages.appendChild(newel) : languages;
    });
    if (textArea) {
      if (textArea.scrollHeight > textAreaContainer.scrollHeight - 5) {
        // console.log(textArea.scrollHeight + "is the scrol height");
        const oldWidth = textArea.scrollHeight + 10;
        textAreaContainer.style.height = `${oldWidth}.px`;
      }
    }
  },
  false
);
textArea
  ? (textArea.oninput = function () {
    if (this.scrollHeight > textAreaContainer.scrollHeight - 5) {
      const oldWidth = this.scrollHeight + 10;
      textAreaContainer.style.height = `${oldWidth}.px`;
    } else {
      console.log("function call");
      textAreaContainer.style.height = "fit-contjlent";
    }
  })
  : textArea;
// reset our created blog page by removing session and other data related to it.
window.onunload = function () {
  let form = new FormData();
  form.append("reset", null);
  fetch("uploadNewBlogData.php", { method: "POST", body: form });
  return null;
};

// this will manage the shadow adding on scroling for the element of author information in uploading a new blog

let headerContainer = document.querySelector("header");
let authorInfo = $("#authorInfo");
let option = {};
let observer = new IntersectionObserver(function (entries, observer) {
  entries.forEach((entrie) => {
    if (entrie.intersectionRatio == 0) authorInfo.addClass("bottom-boxShadow");
    else if (entrie.intersectionRatio > 0)
      authorInfo.removeClass("bottom-boxShadow");
  });
}, option);
observer.observe(headerContainer);

if (BlogTitle) {
  BlogTitle.oninput = (x) => {
    BlogTitlePreview.getElementsByTagName("p")[0].innerText = x.target.value;
  }
  BlogType.oninput = (x) => {
    BlogTypePreview.getElementsByTagName("p")[0].innerText = x.target.value;
  }
  BlogTypePreview.getElementsByTagName("p")[0].innerText = BlogType.value;
  BlogTitlePreview.getElementsByTagName("p")[0].innerText = BlogTitle.value;
}

$(document).ready(function () {
  if (window.location.pathname == '/winmac-blog/AddBlog.php') {
    scrollWindowToBottom();
  }
  console.log("ready!");
});






