/**
 * Created by aleks on 11.04.16.
 */
$(document).ready(function(){
    var pp     = $("#pp"),
        bg     = $("#pp-bg");

    function pp_hide(pp, bg){
        pp.animate({top: "-550px"}, 500, function(){bg.fadeOut(500);});
    }

    function pp_show(pp){
        pp.animate({top: "150px"}, 750);
        bg.fadeIn(750).click(function(){pp_hide(pp, bg)});

        $('#remove_cookie').click(function(e){
            e.preventDefault();
            $.removeCookie('visit');
            window.location = document.referrer;
        });

        $('#accept_cookie').click(function(e){
            $.cookie('visit', true);
            pp_hide(pp, bg);
        });
    }

    if ( $.cookie('visit') == undefined ){
        pp_show(pp, bg);
    }
});