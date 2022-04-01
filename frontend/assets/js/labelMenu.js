var button = document.querySelector("#labelMenu");
var labelMenu = document.querySelector(".label-menu");
var label = document.querySelectorAll(".label");
var blogID = document.querySelector("#newLabel").dataset.blog;
var checkAll = document.querySelector("#checkAll");

button.addEventListener("click", function(event) {
    event.stopPropagation();
    labelMenu.classList.toggle("display");

    var newLabel = document.querySelector("#newLabel");
    newLabel.addEventListener("click", function(event) {
        var checkBox = document.querySelectorAll(".postCheckBox");
        var array = new Array();

        checkBox.forEach(function(el) {
            if (el.checked) {
                array.push(el.value);
                console.log(el.value);
            }
        });

        if (array.length > 0) {
            var newLabelValue = prompt("Enter the new label");

            if (newLabelValue != null || newLabelValue != '') {
                var regex = /^[a-z0-9]+/i;
                var label = newLabelValue.match(regex);

                if (label !== null) {
                    //Ajax request
                    var formData = new FormData();
                    formData.append('newLabel', label);
                    formData.append('postID', JSON.stringify(array));
                    formData.append('blogID', this.dataset.blog);

                    var httpRequest = new XMLHttpRequest();

                    if (httpRequest) {
                        //httpRequest.open('POST', 'https://blog-coder.herokuapp.com/backend/ajax/addLabel.php', true);
                        httpRequest.open('POST', 'http://herokublog.local/backend/ajax/addLabel.php', true);
                        httpRequest.onreadystatechange = function() {
                            if (this.readyState === 4 && this.status === 200) {
                                location.reload(true);
                            }
                        }
                    }

                    httpRequest.send(formData);
                }
            }
        } else {
            alert("No posts are selected");
            location.reload(true);
        }
    });

    document.onclick = function(e) {
        if (e.target !== button && e.target.className !== "label-menu") {
            labelMenu.classList.remove("display");
        }
    }
});

label.forEach(function (el) {
    el.addEventListener("click", function (event) {
        event.preventDefault();
        event.stopPropagation();
        var checkBox = document.querySelectorAll(".postCheckBox");
        var array = new Array();
        checkBox.forEach(function (el) {
            if (el.checked) {
                array.push(el.value);
            }
        });
        if (array.length > 0) {
            //ajax
            var formData = new FormData();
            formData.append("newLabel", el.textContent);
            formData.append("postID", JSON.stringify(array));
            formData.append("blogID", blogID);
            var httpRequest = new XMLHttpRequest();

            if (httpRequest) {
                httpRequest.open('POST', 'https://blog-coder.herokuapp.com/backend/ajax/addLabel.php', true);
                //httpRequest.open('POST', 'http://herokublog.local/backend/ajax/addLabel.php', true);
                httpRequest.onreadystatechange = function () {
                    if (this.readyState === 4 && this.status === 200) {
                        location.reload();
                    }
                }
                httpRequest.send(formData);
            }

        } else {
            alert("No posts are selected!");
            location.reload(true);
        }
    });
});

checkAll.addEventListener("change", function(e) {
    var checkBox = document.querySelectorAll(".postCheckBox");

    checkBox.forEach(function(el) {
        el.checked = true;
    });

    if (this.checked === false) {
        checkBox.forEach(function(el) {
            el.checked = false;
        });
    }
});
