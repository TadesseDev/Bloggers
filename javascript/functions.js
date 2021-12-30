// this file containes function which will be loaded to the header of the page
// and can be loaded befor the DOM is ready so on the DOM loading function here can be called.
let orderBy = 'dateTime';
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

const updateBackgroundPicture = (img, element) => {
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
  $("#HomepageContainer").load("./pages/singleBlog.php", {
    blogId: coming.bid
  }, function () {
    // console.log("returned");
  });
  // console.log(bid);
}
const displayBlogList = () => {
  let url = "./pages/ListOfBlog.php?orderId=" + orderBy;
  $("#HomepageContainer").load(url, {}, function () {
    let footerSlide = $(".slider")[0];
    if (footerSlide) {
      footerSlider();
    }
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
    // console.log(coming.value);
    $.post('./includes/ajax.php', {
      executeQuery: true,
      id: "emailSubscription",
      email: coming.value
    }, (data, response) => {
      if (response) {
        if (Number(data) === 1) {
          console.log(data);
          showSuccessModal({ title: "Success", body: "pleas check your email for confirmation" });
          // $(infoModal).find('#modalTitle').text('Success');
          // $(infoModal).find('#imfoBody').html('<h4>pleas check your email for confirmation</h4>');
        }
        else {
          console.log(data);
          showfailerModal({ title: "failed", body: "subscription fails pleas try again" });
          console.log('subscription fails');
          // $(infoModal).find('#modalTitle').text('failer');
          // $(infoModal).find('#imfoBody').html('<h4>subscription fails pleas try again</h4>');
          // $(infoModal).modal('show');
        }
      }
    });
  }
}
// showSuccessModal({ title: 'sucess', body: 'Now your blog is published<br/> we will notify others about your blog' })
function showSuccessModal(coming) {
  infoModal.innerHTML = `  
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
      <div class="modal-header green">
          <h5 class="modal-title ColorDarkBrown" id="modalTitle">${coming.title}</h5>
          <button type="button" class="close ColorOrange" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form action="" method="">
          <div class="modal-body" id="imfoBody">
          ${coming.body}
          </div>
          <div class="modal-footer">
              <button type="button"  data-dismiss="modal" class="btn green ColorDarkBrown" name="" onclick="(x)=>{console.log(x)}">okay</button>
          </div>
      </form>
  </div>
  </div>
  "`;
  $(document).ready(function () {
    $(infoModal).modal("show");
  })
  // $(infoModal).modal('show');
}
function showfailerModal(coming) {
  infoModal.innerHTML = `  
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
      <div class="modal-header Lired">
          <h5 class="modal-title ColorDarkBrown" id="modalTitle">${coming.title}</h5>
          <button type="button" class="close ColorOrange" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form action="" method="">
          <div class="modal-body" id="imfoBody">
          ${coming.body}
          </div>
          <div class="modal-footer">
              <button type="button"  data-dismiss="modal" class="btn Lired ColorLightOrange" name="" onclick="(x)=>{console.log(x)}">okay</button>
          </div>
      </form>
  </div>
  </div>
  "`;
  $(document).ready(function () {
    $(infoModal).modal("show");
  })
}
const footerSlider = (activeId = 1) => {
  // console.log(orderBy);
  let footerSlide = $(".slider")[0];
  let back = $(footerSlide).find(".back");
  let next = $(footerSlide).find(".next");
  let items = $(footerSlide).find(".item");
  // let activeId = active ? active : 1;
  const activeElement = $(footerSlide).find(`#${activeId}`);
  activeElement.addClass("active");
  if (activeElement[0] === items[0]) {
    back.addClass('disable');
  }
  if (activeElement[0] === items[items.length - 1]) {
    next.addClass('disable');
  }
  activeElement.css({

  });

  for (let i = 0; i < items.length; i++) {
    $(items[i]).on("click", (x) => {
      x.preventDefault();
      activeId = x.target.id;
      let para = "limitId=" + activeId;
      $.get("./pages/ListOfBlog.php?" + para + "&orderId=" + orderBy, {}, function (data, status) {
        $("#HomepageContainer").html(data);
        footerSlider(activeId);
      });
      // displayBlogList({ para: para });
    })
  }
  // for the next and back items
  next.on("click", (x) => {
    activeId++;
    let para = "limitId=" + activeId;
    $.get("./pages/ListOfBlog.php?" + para + "&orderId=" + orderBy, {}, function (data, status) {
      $("#HomepageContainer").html(data);
      footerSlider(activeId);
    });
  });
  back.on("click", (x) => {
    activeId--;
    let para = "limitId=" + activeId;
    $.get("./pages/ListOfBlog.php?" + para + "&orderId=" + orderBy, {}, function (data, status) {
      $("#HomepageContainer").html(data);
      footerSlider(activeId);
    });
  });
}
const reorderBlogs = () => {
  let orderings = $($(".blog-orderings")[0]).find(".blog-ordering");
  for (let i = 0; i < orderings.length; i++) {
    $(orderings[i]).on("click", (x) => {
      x.preventDefault();
      activeId = x.target.id;
      $(`#${orderBy}`).removeClass("active");
      orderBy = activeId;
      $(`#${orderBy}`).addClass("active");
      let para = "orderId=" + activeId;
      $.get("./pages/ListOfBlog.php?" + para, {}, function (data, status) {
        $("#HomepageContainer").html(data);
        footerSlider();
      });
    })
  }
}
const searchForContent = (element) => {
  let searchIn = $(element).find(".searchType").val();
  if (searchIn === "Everything") {
    // console.log("searching for everyting");
    searchIn = ['Blog', 'Author']
  }
  const searchFor = $(element).find(".searchText").val();
  let searchContainer = $("#searchContainer");
  $.post("./pages/search.php", {
    loadGrid: true,
    searchIn: searchIn,
    searchFor: searchFor
  }, (data, status) => {
    if (status) {
      searchContainer.html(data);
      // append the empty html to the DOM 
      // console.log(data);
    }
  }, "html").done(() => {
    // once empty grid is loaded we can load for searched data 
    let searchContainer = $("#searchContainer");
    if (Array.isArray(searchIn)) {
      searchIn.forEach(se => {
        // console.log("searching in" + se);
        $.post("./pages/search.php", {
          search: true,
          searchIn: se,
          searchFor: searchFor
        }, (data, status) => {
          if (status) {
            console.log("result is ready in: " + se);
            const result = $($(`#` + se).find(`.result`)[0])
            result.append(data);
            // console.log(result);
            // console.log(data);
          }
        }, "html").done((data) => {
          if (se.toLowerCase() == ("blog")) {
            let button = searchContainer.find(".btn");
            console.log(button);
            for (let i = 0; i < button.length; i++) {
              button[i].onclick = (x) => {
                displaySingleBlog({ bid: x.target.id });
                console.log(searchContainer[0].scrollHeight);
                window.scrollBy(0, 1000);
              };
            }
          }

        });
      });
    } else {
      $.post("./pages/search.php", {
        search: true,
        searchIn: searchIn,
        searchFor: searchFor
      }, (data, status) => {
        if (status) {
          console.log("result is ready in: " + searchIn);
          const result = $($(`#` + searchIn).find(`.result`)[0])
          result.append(data);
          // console.log(result);
          // console.log(data);
        }
      }, "html").done((data) => {


        console.log("button");
        let button = $(data).find(".btn");
        for (let i = 0; i < button.length; i++) {
          $(button[i]).on("click", (x) => {
            console.log(x);
          })
        }

      });
    }
  });
}
