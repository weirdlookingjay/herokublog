var deleteBtn = document.querySelector("#commentBtn");
var deleteLink = document.querySelectorAll("#deleteComment");
var blogID = deleteBtn.dataset.blog;

deleteLink.forEach(function(el){
    el.addEventListener("click",function(e){
        e.preventDefault();
        if(confirm("Sei sicuro di voler cancellare questa bozza? ")){
            var formData  = new FormData();
            formData.append("postID", el.dataset.post);
            formData.append("commentID", el.dataset.comment);
            formData.append("blogID", blogID);
            var httpRequest = new XMLHttpRequest();
            if(httpRequest){
                httpRequest.open('POST', 'https://blog-coder.herokuapp.com/backend/ajax/removeComments.php', true);
                //httpRequest.open('POST', 'http://herokublog.local/backend/ajax/removeComments.php', true);
                httpRequest.onreadystatechange = function(){
                    if(this.readyState === 4 && this.status === 200){
                        console.log("ok ATTIVATO AJAX");
                        if(this.responseText-length !=0){
                            alert(this.responseText);
                        }
                        location.reload();
                    }
                }
                httpRequest.send(formData);

            }
        }
    });
});
///////////////////////////
deleteBtn.addEventListener("click",function(e){
    var checkBox = document.querySelectorAll(".commentCheckBox");
    var postIDs = new Array();
    var commentIDs = new Array();
    checkBox.forEach(function(el){
        if(el.checked){
            postIDs.push(el.dataset.post);
            commentIDs.push(el.dataset.comment);
        }
    });
    if(postIDs.length > 0){
        if(confirm("Sei sicuro di voler cancellare questa bozza? ")){
            var formData  = new FormData();
            formData.append("postIDs", JSON.stringify(postIDs));
            formData.append("commentIDs", JSON.stringify(commentIDs));
            formData.append("blogID", blogID);
            var httpRequest = new XMLHttpRequest();
            if(httpRequest){
                httpRequest.open('POST', 'https://blog-coder.herokuapp.com/backend/ajax/removeComments.php', true);
                //httpRequest.open('POST', 'http://herokublog.local/backend/ajax/removeComments.php', true);
                httpRequest.onreadystatechange = function(){
                    if(this.readyState === 4 && this.status === 200){
                        console.log("ok ATTIVATO AJAX");
                        if(this.responseText-length !=0){
                            alert(this.responseText);
                        }
                        location.reload();
                        //http://localhost:84/corso/Blogger/backend/ajax/addLabel.php
                    }
                }
                httpRequest.send(formData);

            }
        }
    }else{
        alert("non sono stati selezionati commenti.");
        location.reload();
    }
});
var checkAll = document.querySelector("#checkAll");
checkAll.addEventListener("change",function(e){
    var checkBox = document.querySelectorAll('.commentCheckBox');
    checkBox.forEach(function(el){
        el.checked = true;
    });
    if(this.checked === false) {
        checkBox.forEach(function(el){
            el.checked = false;
        });
    }
});

