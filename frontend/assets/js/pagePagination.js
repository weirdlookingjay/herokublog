var button = document.querySelector("#postJumpMenu");
var page = document.querySelector(".p-num > ul");
var pageMenu = document.querySelector(".p-num");
var postLimit = document.querySelector('#pageLimit');
var previousBtn = document.querySelector('#previousPage');
var nextBtn = document.querySelector('#nextPage');
var currentPage = document.querySelector('#currentPageNum');
var active = document.querySelector("#active");
var postStatus = '';
var blogID = nextBtn.dataset.blog;

if(window.location.href.indexOf('draft') > -1) {
    active.classList.remove('active');
    document.querySelector("#draft").classList.add('active');
    postStatus = 'draft';
} else if(window.location.href.indexOf('published') > -1) {
    active.classList.remove('active');
    document.querySelector("#published").classList.add('active');
    postStatus = 'published';
}

if(page.lastElementChild != null) {
    if(page.lastElementChild.innerHTML.trim() > 1) {
        enableBtn();
    }
}

button.addEventListener("click", function(event) {
    event.preventDefault();
    event.stopPropagation();

    pageMenu.classList.toggle('display');
    var pages = document.querySelectorAll('.pageNum');

    pages.forEach(function(el) {
        el.addEventListener("click", function(event) {
            var page = document.querySelector('.p-num > ul').lastElementChild.innerHTML.trim();

            //Ajax request
            var formData = new FormData();
            formData.append('blogID', blogID);
            formData.append('nextPage', el.innerHTML.trim());
            formData.append('postLimit', postLimit.value);
            formData.append('postStatus', postStatus);

            var httpRequest = new XMLHttpRequest();

            if (httpRequest) {
                httpRequest.open('POST', 'https://blog-coder.herokuapp.com/backend/ajax/showNextPages.php', true);
                //httpRequest.open('POST', 'http://herokublog.local/backend/ajax/showNextPages.php', true);
                httpRequest.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        document.querySelector('#posts').innerHTML = this.responseText;
                        currentPage.innerHTML = el.innerHTML;

                        if(el.innerHTML !== '1') {
                            previousBtn.disabled = false;
                            previousBtn.classList.remove('disabled');
                        } else {
                            previousBtn.disabled = true;
                            previousBtn.classList.add('disabled');
                        }

                        if(el.innerHTML === page) {
                            nextBtn.disabled = true;
                            nextBtn.classList.add('disabled');
                        } else {
                            nextBtn.disabled = false;
                            nextBtn.classList.remove('disabled');
                        }
                    }
                }
            }

            httpRequest.send(formData);
        });
    });

    document.onclick = function(e) {
        if (e.target !== button) {
            pageMenu.classList.remove('display');
        }
    }
});

nextBtn.addEventListener("click", function(event) {
    var currentNum = currentPage.innerHTML.trim();
    var lastPageNum = document.querySelector(".p-num > ul").lastElementChild.innerHTML.trim();
    previousBtn.disabled = false;
    previousBtn.classList.remove('disabled');

    if(lastPageNum > currentNum) {
        currentNum++;

        var page = document.querySelector('.p-num > ul').lastElementChild.innerHTML.trim();

        //Ajax request
        var formData = new FormData();
        formData.append('blogID', blogID);
        formData.append('nextPage', currentNum);
        formData.append('postLimit', postLimit.value);
        formData.append('postStatus', postStatus);

        var httpRequest = new XMLHttpRequest();

        if (httpRequest) {
            httpRequest.open('POST', 'https://blog-coder.herokuapp.com/backend/ajax/showNextPages.php', true);
            //httpRequest.open('POST', 'http://herokublog.local/backend/ajax/showNextPages.php', true);
            httpRequest.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    document.querySelector('#posts').innerHTML = this.responseText;
                    currentPage.innerHTML = currentNum;
                }
            }
        }

        httpRequest.send(formData);
    }

    if(lastPageNum-1 < currentNum) {
        nextBtn.disabled = true;
        nextBtn.classList.add('disabled');
    }
});

previousBtn.addEventListener("click", function(event) {
    var currentNum = currentPage.innerHTML.trim();
    var lastPageNum = document.querySelector(".p-num > ul").lastElementChild.innerHTML.trim();


    if(currentNum > '1') {
        currentNum--;

        var page = document.querySelector('.p-num > ul').lastElementChild.innerHTML.trim();

        //Ajax request
        var formData = new FormData();
        formData.append('blogID', blogID);
        formData.append('previousPage', currentNum);
        formData.append('postLimit', postLimit.value);
        formData.append('postStatus', postStatus);

        var httpRequest = new XMLHttpRequest();

        if (httpRequest) {
            httpRequest.open('POST', 'https://blog-coder.herokuapp.com/backend/ajax/showPreviousPages.php', true);
            //httpRequest.open('POST', 'http://herokublog.local/backend/ajax/showPreviousPages.php', true);
            httpRequest.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    document.querySelector('#posts').innerHTML = this.responseText;
                    currentPage.innerHTML = currentNum;
                }
            }
        }

        httpRequest.send(formData);
    }

    if(currentNum == '1') {
        previousBtn.disabled = true;
        previousBtn.classList.add('disabled');
    }
});

postLimit.addEventListener("change", function(e) {
    var jumpTo = this.value;

    //Ajax request
    var formData = new FormData();
    formData.append('blogID', blogID);
    formData.append('postLimit', jumpTo);
    formData.append('postStatus', postStatus);

    var httpRequest = new XMLHttpRequest();

    if (httpRequest) {
        httpRequest.open('POST', 'https://blog-coder.herokuapp.com/backend/ajax/jumpToPage.php', true);
        //httpRequest.open('POST', 'http://herokublog.local/backend/ajax/jumpToPage.php', true);
        httpRequest.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                document.querySelector('#posts').innerHTML = this.responseText;
                currentPage.innerHTML = 1;
                getPagesNumbers(jumpTo);
            }
        }
    }

    httpRequest.send(formData);
});

function getPagesNumbers(jumpTo) {
    //Ajax request
    var formData = new FormData();
    formData.append('blogID', blogID);
    formData.append('postLimit', jumpTo);
    formData.append('postStatus', postStatus);

    var httpRequest = new XMLHttpRequest();

    if (httpRequest) {
        httpRequest.open('POST', 'https://blog-coder.herokuapp.com/backend/ajax/getPagesNumbers.php', true);
        //httpRequest.open('POST', 'http://herokublog.local/backend/ajax/getPagesNumbers.php', true);
        httpRequest.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                var regex = /(25|50|100)/g;
                var number = jumpTo.match(regex);
                var page = document.querySelector("#page-num");

                if(number) {
                    page.innerHTML = this.responseText;

                    if(page.textContent === "1") {
                        disableBtn();
                    } else {
                        enableBtn();
                    }
                }
            }
        }
    }

    httpRequest.send(formData);
}


function enableBtn() {
    postLimit.disabled = false;
    button.disabled = false;
    button.classList.remove('disabled');
    nextBtn.disabled = false;
    nextBtn.classList.remove('disabled');
}

function disableBtn() {
    button.disabled = true;
    button.classList.add('disabled');
    nextBtn.disabled = true;
    nextBtn.classList.add('disabled');
}
