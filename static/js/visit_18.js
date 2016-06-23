/**
 * Created by aleks on 11.04.16.
 */
$(document).ready(function(){
    var pp     = $("#pp"),
        bg     = $("#pp-bg");

    var cookie_18_years_val = Cookie.getCookie(Cookie.cookie_18_years);
    
    if (!cookie_18_years_val) {
        pp_show(pp, bg);
    }

    function pp_hide(pp, bg){
        pp.animate({top: "-550px"}, 500, function(){bg.fadeOut(500);});
    }

    function pp_show(pp){
        pp.animate({top: "150px"}, 750, preloader_hide);
        bg.fadeIn(750); //.click(function(){pp_hide(pp, bg)});

        $('#18_years_false').click(function(e){
            e.preventDefault();
            Cookie.setCookie(Cookie.cookie_18_years, '', -1);
            window.location = 'about:blank'; //document.referrer;
        });

        $('#18_years_true').click(function(e){
            Cookie.setCookie(Cookie.cookie_18_years, true);
            pp_hide(pp, bg);
        });
    }
});