var button = document.querySelector(#publishBtn);
var blogID = button.dataset.blog;

button.addEventListener("click", function(event) {
   var checkBox = document.querySelectorAll(".commentCheckBox");
   var postIDs = new Array();
   var commentIDs = new Array();

   checkBox.forEach(function(el) {
      if(el.checked) {
          postIDs.push(el.dataset.post);
          commentIDs.push(el.dataset.comment);
      }
   });

   if(postIDs.length > 0) {
       var formData = new FormData();

       formData.append("postIDs", JSON.stringify(postIDs));
       formData.append("commentIDs", JSON.stringify(commentIDs));
       formData.append("blogID", blogID);

       var httpRequest = new XMLHttpRequest();

       if (httpRequest) {
           httpRequest.open('POST', 'https://blog-coder.herokuapp.com/backend/ajax/publishComments.php', true);
           //httpRequest.open('POST', 'http://herokublog.local/backend/ajax/publishComments.php', true);
           httpRequest.onreadystatechange = function () {
               if (this.readyState === 4 && this.status === 200) {
                   if(this.responseText.length != 0) {
                       alert(this.responseText);
                   }
                   location.reload(true);
               }
           }
           httpRequest.send(formData);
       }
   } else {
       alert("No posts are selected!");
       location.reload(true);
   }
});