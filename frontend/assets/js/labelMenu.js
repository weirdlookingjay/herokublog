var button = document.querySelector("#labelMenu");
var labelMenu = document.querySelector(".label-menu");
var BASE_URL_DEV = "http://herokublog.local/";
var BASE_URL_PROD = "https://blog-coder.herokuapp.com/";

button.addEventListener("click", function(event) {
    event.stopPropagation();
    labelMenu.classList.toggle("display");
    var newLabel = document.querySelector("#newLabel");

    newLabel.addEventListener("click", function(event) {
       var checkBox = document.querySelectorAll(".postCheckBox");
       var array = new Array();

       checkBox.forEach(function(el) {
           if(el.checked) {
               array.push(el.value);
           }
       });

       if(array.length > 0) {
           var newLabelValue = prompt("Enter the new label");

           if(newLabelValue != null || newLabelValue != '') {
               var regex = /^[a-z0-9]+/i;
               var label = newLabelValue.match(regex);

               if(label !== null) {
                   //Ajax request
                   var formData = new FormData();
                   formData.append('newLabel', label);
                   formData.append('postID', JSON.stringify(array));
                   formData.append('blogID', this.dataset.blog);

                   var httpRequest = new XMLHttpRequest();

                   if(httpRequest) {
                       // httpRequest.open('POST', BASE_URL_DEV+'backend/ajax/addLabel.php', true);
                       httpRequest.open('POST', BASE_URL_PROD+'backend/ajax/addLabel.php', true);
                       httpRequest.onreadystatechange = function() {
                           if(this.readyState === 4 && this.status === 200) {
                               location.reload(true);
                           }
                       }
                   }
                   httpRequest.send(formData);

               }
           }
       } else {
           alert("No posts are selected!");
           location.reload(true);
       }
    });

    document.onclick = function(e) {
        e.stopPropagation();
        if(e.target !== button && e.target.className !== "label-menu") {
            labelMenu.classList.remove("display");
        }
    }
});