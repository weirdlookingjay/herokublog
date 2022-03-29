var button = document.querySelector("#labelMenu");
var labelMenu = document.querySelector(".label-menu");

button.addEventListener("click", function(event) {
    event.stopPropagation();
    labelMenu.classList.toggle("display");

    document.onclick = function(e) {
        e.stopPropagation();
        if(e.target !== button && e.target.className !== "label-menu") {
            labelMenu.classList.remove("display");
        }
    }
});