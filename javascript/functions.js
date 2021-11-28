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
