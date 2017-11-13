document.addEventListener("DOMContentLoaded", function() {

    var btnMenu = document.querySelector("a.btn-menu");
    var menu = document.querySelector("nav");

    btnMenu.addEventListener("click", function () {
        menu.style.transform = "translateX(0)";

    });
    menu.addEventListener("click", function () {
        if (window.matchMedia("(max-width: 720px)").matches) {
            menu.style.transform = "translateX(-100%)";
        }
    });




});