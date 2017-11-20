$(function(){

    /**********************************************************************/
    /****** Menu en mode mobile *******************************************/
    var btnMenu = document.querySelector("a.btn-menu");
    var menu = document.querySelector("nav");
    btnMenu.addEventListener("click", function () {
        menu.style.transform = "translateX(0)";

    });
    menu.addEventListener("click", function () {
        if (window.matchMedia("(max-width: 720px)").matches) {
            menu.style.transform = "translateX(-100%)";
        }
    });/* Menu en mode mobile *********************************************/
    /**********************************************************************/


    /**********************************************************************/
    /****** SmoothScroll **************************************************/
    $('nav [href^="#"]').on("click", function(e) {
        e.preventDefault();
        var leHref = $(this).attr("href");
        var decalage = $(leHref).offset().top - 50;
        $("body, html").animate({
            "scrollTop": decalage
        }, 600);
    }); /* Fin SmoothScroll ***********************************************/
    /**********************************************************************/


    /**********************************************************************/
    /****** Timeline Arrivée **********************************************/
    $(document).on("scroll", function() { //j'écoute le scroll
        var hauteur = $(this).scrollTop();
        var myItems = $(".item");
        var bullets = $(".bullet");
        for (var i = 0; i < myItems.length; i++) {
            currentItem = $(myItems[i]);
            bullet = $(bullets[i]);
            if ( hauteur > ( currentItem.offset().top - ($(window).height()/1.2 ) )) {
                currentItem.removeClass("item-hide");
                bullet.delay( 800 ).fadeIn( 400 );
                //bullet.css( "display", "block" );
            }
        }
    });/****** Fin Timeline Arrivée ***************************************/
    /**********************************************************************/


    /**********************************************************************/
    /****** particlesJS.load **********************************************/
    /* (@dom-id, @path-json, @callback (optional)); */
    particlesJS.load('header-background', 'js/particles.json');
    /****** Fin particlesJS.load ******************************************/
    /**********************************************************************/


    /**********************************************************************/
    /****** Formulaire contact submit en AJAX *****************************/
    var myFormContact = $('#contact form');

    function contactForm(e) {
        e.preventDefault();

        //todo recupérer les données en javascript
        var dataForm = $(this).serialize();

        //todo envoyer un appel ajax vers contact.php
        $.ajax({
            url: "ajax/contact.php",
            method: "post",
            data: dataForm,
            datatype: 'json'
        })
            .done(function(data) {
                console.log(data);
                console.log(data['formOk']);
                $('#infoForm').html(data['infoForm']);
            })
            .fail(function() {
                alert( "bad news... ERROR !" );
            })
            .always(function() {
            });
    }

    myFormContact.on('submit', contactForm);
    /****** Fin Formulaire contact submit en AJAX *************************/
    /**********************************************************************/
});