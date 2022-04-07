var button = document.querySelector("#titleBtn");
var block = document.querySelector("#titleBlock");
var cancelBtn = document.querySelector("titleCancelBtn");
var saveBtn = document.querySelector("titleSaveBtn");
var titleBox = document.querySelector("titleBox");

button.addEventListener("click", function(event) {
   block.style.display = "block";

   cancelBtn.addEventListener("click", function(event) {
      block.style.display = "none";
   });

   saveBtn.addEventListener("click", function(event) {
      var title = document.querySelector("#titleInput");

      if(title.value.trim() !== "") {
         var formData = new FormData();

         formData.append("title", title.value.trim());
         formData.append("blogID", this.dataset.blog);

         var httpRequest = new XMLHttpRequest();

         if (httpRequest) {
            httpRequest.open('POST', 'https://blog-coder.herokuapp.com/backend/ajax/updateTitle.php', true);
            //httpRequest.open('POST', 'http://herokublog.local/backend/ajax/updateTitle.php', true);
            httpRequest.onreadystatechange = function () {
               if (this.readyState === 4 && this.status === 200) {

                  if(/OwnerError$/i.exec(this.responseText)) {
                     alert("You cannot perform this action!");
                     location.reload(true);
                  } else {
                     this.value = this.responseText;
                  }

                  block.style.display = "none";
                  titleBox.innerHTML = title.value;
               }
            }
            httpRequest.send(formData);
         }
      } else {
          document.querySelector("#titleError").innerHTML = "Required fields must not be blank";
      }
   });
});