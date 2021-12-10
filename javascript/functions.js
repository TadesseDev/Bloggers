// this file containes function which will be loaded to the header of the page
// and can be loaded befor the DOM is ready so on the DOM loading function here can be called.

const upFromLST = (localStorageName, id) => {
  let img = document.getElementById(id);
  img.src = localStorage.getItem(localStorageName);
  console.log(img);
  return img;
};
const clickObject = (id) => {
  element = document.getElementById(id);
  document.addEventListener("DOMContentLoaded", function () {
    element.click();
  });
  // alert(element.id);
};

const scrollWindowToBottom = () => {
  let body = document.getElementsByTagName("body")[0];
  let scrolHeight = window.outerHeight > body.scrollHeight ? window.outerHeight : body.scrollHeight;
  window.scrollBy(0, scrolHeight);
}

const updateAbackgroundPicture = (img, element) => {
  if (!element[0]) {
    ele = $(element);
  }
  ele.css({
    "background-image": "none",
  });
  ele.css({
    "background-image": `url("${img}")`
  });
}


