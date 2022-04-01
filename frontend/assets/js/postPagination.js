var button = document.querySelector("#postJumpMenu");
var page = document.querySelector(".p-num > ul");
var pageMenu = document.querySelector(".p-num");
var postLimit = document.querySelector('#pageLimit');
var previousBtn = document.querySelector('#previousPage');
var nextBtn = document.querySelector('#nextPage');
var currentPage = document.querySelector('#currentPageNum');
var blogID = nextBtn.dataset.blog;

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
           formData.append('postLimit', postLimit);

           var httpRequest = new XMLHttpRequest();

           if (httpRequest) {
               //httpRequest.open('POST', 'https://blog-coder.herokuapp.com/backend/ajax/showNextPosts.php', true);
               httpRequest.open('POST', 'http://herokublog.local/backend/ajax/showNextPosts.php', true);
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

function enableBtn() {
    button.disabled = false;
    button.classList.remove('disabled');
}
