var search = document.querySelector("#postSearch");
var blogID = document.querySelector("#postSearch").dataset.blog;
var page = document.querySelector(".p-num > ul");
var pageMenu = document.querySelector(".p-num");
var postLimit = document.querySelector('#pageLimit');
var previousBtn = document.querySelector('#previousPage');
var nextBtn = document.querySelector('#nextPage');
var currentPage = document.querySelector('#currentPageNum');
var active = document.querySelector("#active");
var postStatus = '';

if(window.location.href.indexOf('draft') > -1) {
    active.classList.remove('active');
    document.querySelector("#draft").classList.add('active');
    postStatus = 'draft';
} else if(window.location.href.indexOf('published') > -1) {
    active.classList.remove('active');
    document.querySelector("#published").classList.add('active');
    postStatus = 'published';
}

search.addEventListener("keyup", function(event) {
    if(event.which == 13) {

        var formData = new FormData();

        formData.append("search", search.value.trim());
        formData.append("blogID", blogID);

        var httpRequest = new XMLHttpRequest();

        if (httpRequest) {
            httpRequest.open('POST', 'https://blog-coder.herokuapp.com/backend/ajax/searchPosts.php', true);
            //httpRequest.open('POST', 'http://herokublog.local/backend/ajax/searchPosts.php', true);
            httpRequest.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    if(this.responseText.length != 0) {
                        document.querySelector("#posts").innerHTML = this.responseText;
                        disableBtn();
                    }

                    if(search.value === '') {
                        enableBtn();
                    }
                }
            }
            httpRequest.send(formData);
        }
    }
});

function enableBtn() {
    postLimit.disabled = false;
    button.disabled = false;
    button.classList.remove('disabled');
    nextBtn.disabled = false;
    nextBtn.classList.remove('disabled');
}

function disableBtn() {
    postLimit.disabled = true;
    button.disabled = true;
    button.classList.add('disabled');
    nextBtn.disabled = true;
    nextBtn.classList.add('disabled');
}