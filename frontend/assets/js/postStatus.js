var publishBtn = document.querySelector("#publishBtn");
var draftBtn = document.querySelector("#draftBtn");

draftBtn.addEventListener("click", function(e) {
    var checkBox = document.querySelectorAll(".postCheckBox");
    var postIDs = new Array();
    var blogIDs = new Array();

    checkBox.forEach(function(el) {
        if(el.checked) {
            postIDs.push(el.value);
            blogIDs.push(el.dataset.blog);
        }
    });

    if(postIDs.length > 0) {
        if(confirm("Are you sure you want to draft this?")) {
            var formData = new FormData();

            formData.append("postIDs", JSON.stringify(postIDs));
            formData.append("blogIDs", JSON.stringify(blogIDs));

            var httpRequest = new XMLHttpRequest();

            if (httpRequest) {
                httpRequest.open('POST', 'https://blog-coder.herokuapp.com/backend/ajax/draftPosts.php', true);
                //httpRequest.open('POST', 'http://herokublog.local/backend/ajax/draftPosts.php', true);
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
        }
    } else {
        alert("No Posts are selected!");
        location.reload(true);
    }

});

publishBtn.addEventListener("click", function(event) {
    var checkBox = document.querySelectorAll(".postCheckBox");
    var postIDs = new Array();
    var blogIDs = new Array();

    checkBox.forEach(function(el) {
        if(el.checked) {
            postIDs.push(el.value);
            blogIDs.push(el.dataset.blog);
        }
    });

    if(postIDs.length > 0) {
        if(confirm("Are you sure you want to publish this?")) {
            var formData = new FormData();

            formData.append("postIDs", JSON.stringify(postIDs));
            formData.append("blogIDs", JSON.stringify(blogIDs));

            var httpRequest = new XMLHttpRequest();

            if (httpRequest) {
                //httpRequest.open('POST', 'https://blog-coder.herokuapp.com/backend/ajax/publishPosts.php', true);
                httpRequest.open('POST', 'http://herokublog.local/backend/ajax/publishPosts.php', true);
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
        }
    } else {
        alert("No Posts are selected!");
        location.reload(true);
    }
});