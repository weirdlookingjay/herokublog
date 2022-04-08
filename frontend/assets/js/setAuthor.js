var formBtn = document.querySelector("#authorBtn");

formBtn.addEventListener("click", function(event) {
   document.querySelector(".au-main").style.display = "block";
   var formSaveBtn = document.querySelector("#formSave");

   formSaveBtn.addEventListener("click", function(event) {
      var blogID = this.dataset.blog;
      var email = document.querySelector("#emailInput");
      var name = document.querySelector("#nameInput");
      var pass = document.querySelector("#passInput");
      var passRe = document.querySelector("#passReInput");
      var file = document.querySelector("#file").files[0];

      if(email.value === '') {
          document.querySelector("#emailError").innerHTML = "required field must not be blank";
      }

      if(name.value === '') {
          document.querySelector("#nameError").innerHTML = "required field must not be blank";
      }

      if(pass.value === '') {
          document.querySelector("#passError").innerHTML = "required field must not be blank";
      }

      if(passRe.value === '') {
          document.querySelector("#passReError").innerHTML = "required field must not be blank";
      }

      if(email.value && name.value && pass.value && passRe.value !== '') {
          if(pass.value === passRe.value) {
              if(pass.value.length > 4) {
                  //AJAX Request
                  var formData = new FormData();

                  formData.append("blogID", blogID);
                  formData.append("email", email.value);
                  formData.append("name", name.value);
                  formData.append("pass", pass.value);
                  formData.append("passRe", passRe.value);
                  formData.append("file", file);

                  var httpRequest = new XMLHttpRequest();

                  if (httpRequest) {
                      httpRequest.open('POST', 'https://blog-coder.herokuapp.com/backend/ajax/createAuthor.php', true);
                      //httpRequest.open('POST', 'http://herokublog.local/backend/ajax/createAuthor.php', true);
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
                  document.querySelector("#passReError").innerHTML = "Password length is too short";
              }
          } else {
              document.querySelector("#passReError").innerHTML = "Password does not match!";
          }
      }
   });

   document.querySelector('#file').addEventListener("change", function(event) {
      var regex = /(\.jpg|\.jpeg|\.png)$/i;
      if(!regex.exec(this.value)) {
          alert("Only '.jpg', '.jpeg', '.png' formats are allowed");
          this.value = '';
          return false;
      } else {
          if(this.files && this.files[0]) {
              var reader = new FileReader();
              reader.onload = function(event) {
                  document.querySelector("#previewImage").src = event.target.result;
              }
              reader.readAsDataURL(this.files[0]);
          }
      }
   });

   document.querySelector("#formClose").addEventListener("click", function(event) {
       document.querySelector(".au-main").style.display = "none";
       document.querySelector("#emailInput").value = '';
       document.querySelector("#nameInput").value = '';
       document.querySelector("#passInput").value = '';
       document.querySelector("#passReInput").value = '';
       document.querySelector("#file").value = '';
       return false;
   });
});