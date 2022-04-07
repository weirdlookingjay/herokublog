var button = document.querySelector("#titleBtn");
var block = document.querySelector("#titleBlock");
var cancelBtn = document.querySelector("#titleCancelBtn");
var saveBtn = document.querySelector("#titleSaveBtn");
var titleBox = document.querySelector("#titleBox");
var blogID = saveBtn.dataset.blog;

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
         formData.append("blogID", blogID);

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

var descBtn = document.querySelector("#descBtn");
var descBlock = document.querySelector("#descBlock");
var descCancelBtn = document.querySelector("#descCancelBtn");
var descSaveBtn = document.querySelector("#descSaveBtn");
var descBox = document.querySelector("#descBox");

descBtn.addEventListener("click",function(event){
   descBlock.style.display="block";
   descCancelBtn.addEventListener("click",function(event){
      descBlock.style.display="none";

   });

   descSaveBtn.addEventListener("click",function(event){
      descText =document.querySelector("#descInput");
      if(descText.value.trim().length <'500'){
         var formData  = new FormData();
         formData.append("description", descText.value.trim());
         formData.append("blogID", blogID);
         var httpRequest = new XMLHttpRequest();
         if(httpRequest){
            httpRequest.open('POST', 'https://blog-coder.herokuapp.com/backend/ajax/updateDescription.php', true);
            //httpRequest.open('POST', 'http://herokublog.local/backend/ajax/updateDescription.php', true);
            httpRequest.onreadystatechange = function(){
               if(this.readyState === 4 && this.status === 200){
                  if(/OwnnerError$/i.exec(this.responseText)){
                     alert("You cannot perform this action!");
                     location.reload();
                  }else{
                     this.value=this.responseText;
                  }
                  descBlock.style.display="none";
                  descBox.innerHTML = descText.value;
               }
            }
            httpRequest.send(formData);
         }
      }else{
         document.querySelector("#descError").innerHTML="Must be at most 500 characters!";  //<div class="bt-error" id="descError">
      }


   });

});

