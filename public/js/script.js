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
    $('#contact').find('form').on('submit', function(e) {
        e.preventDefault();
        var dataForm = $(this).serialize();
        var infoForm = $('#infoForm');
        $.ajax({
            url: "ajax/contact.php",
            method: "post",
            data: dataForm,
            dataType: 'json'
        })
            .done(function(data) {
                infoForm.html(data['infoForm']);
                if(data['formOk'] && data['returnEmail']){
                    infoForm.addClass('valid').removeClass('invalid');
                }else {
                    infoForm.addClass('invalid').removeClass('valid');
                }
            })
            .fail(function() {
                infoForm.html("Erreur de communication avec le serveur<br>Merci de réessayer plus tard").addClass('invalid').removeClass('valid');
            })
            .always(function() {
                infoForm.css({'display' : 'block'});
            });
    });
    /****** Fin Formulaire contact submit en AJAX *************************/
    /**********************************************************************/
});