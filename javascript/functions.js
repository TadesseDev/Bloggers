// this file containes function which will be loaded to the header of the page
// and can be loaded befor the DOM is ready so on the DOM loading function here can be called.

const upFromLST = (localStorageName, id) => {
  let img = document.getElementById(id);
  img.src = localStorage.getItem(localStorageName);
  console.log(img);
  return img;
};
const clickObject = (id) => {
  $(document).ready(() => {
    element = document.getElementById(id);
    console.log(element);
    element.click()
  }
  );
};

const scrollWindowToBottom = () => {
  let body = document.getElementsByTagName("body")[0];
  let scrolHeight = window.outerHeight > body.scrollHeight ? window.outerHeight : body.scrollHeight;
  window.scrollBy(0, scrolHeight);
}

const updateAbackgroundPicture = (img, element) => {
  $(document).ready(function () {
    if (!element[0]) {
      element = $(element);
    }
    element.css({
      "background-image": "none",
    });
    element.css({
      "background-image": `url("${img}")`
    });
  });
}

const displaySingleBlog = (coming) => {
  $("#HomePagecontainer").load("./pages/singleBlog.php", {
    blogId: coming.bid
  }, function () {
    // console.log("returned");
  });
  // console.log(bid);
}
const displayBlogList = () => {
  $("#HomePagecontainer").load("./pages/ListOfBlog.php", {}, function () {
    console.log("returned");
  });
  // console.log(bid);
}
const loadTopBlogs = (coming) => {
  $(document).ready(() => {
    // console.log(coming.amount);
    $.ajax({
      url: './includes/ajax.php',
      type: 'POST',
      dataType: 'JSON',
      data: {
        getTopBlog: true,
        amount: coming.amount,
        by: coming.by,
      },
      success: function (response) {
        if (coming.id == "title") {
          response.forEach(blog => {
            let ele = document.createElement("p");
            ele.innerText = blog.title;
            ele.setAttribute("id", blog.id);
            ele.setAttribute("class", "list");
            // ele.setAttribute("onclick", () =>);
            $(ele).on("click", () => {
              displaySingleBlog({ bid: blog.id });
            });
            // console.log(ele);
            coming.target.append(ele);
          })
        }
        // console.log(coming.fields);
      }
    });
  });
}

const showModal = (coming) => {
  let modal = $(`#${coming.modalId}`);
  modal.modal("show");
}

const updateDom = (coming) => {
  $(document).ready(() => {
    let element = $(`#${coming.elementId}`);
    let content = coming.content;
    element.html(content);
  });
}

const excuteQuery = (coming) => {
  if (coming.id === 'emailSubscription') {
    console.log(coming.value);
    $.post('./includes/ajax.php', { 
      executeQuery: true,
      id: "emailSubscription",
      email: coming.value
     }, (data, response) => {
      console.log(data);
    });
  }

}