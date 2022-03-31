var search = document.querySelector("#postSearch");
var blogID = document.querySelector("#postSearch").dataset.blog;

search.addEventListener("keyup", function(event) {
    if(event.which == 13) {

        var formData = new FormData();

        formData.append("search", search.value.trim());
        formData.append("blogID", blogID);

        var httpRequest = new XMLHttpRequest();

        if (httpRequest) {
            httpRequest.open('POST', 'https://blog-coder.herokuapp.com/backend/ajax/searchPosts.php', true);
            //httpRequest.open('POST', 'http://herokublog.local/backend/ajax/searchPosts.php', true);
            httpRequest.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    if(this.responseText.length != 0) {
                        document.querySelector("#posts").innerHTML = this.responseText;
                    }
                }
            }
            httpRequest.send(formData);
        }
    }
});