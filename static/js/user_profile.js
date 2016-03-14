
$(window).on('load', function () {
    var $preloader = $('#page-preloader'),
        $spinner   = $preloader.find('.spinner');
    $spinner.fadeOut();
    $preloader.fadeOut('slow');
});
$(document).ready(function(){
    UserProfile.init();
});

var UserProfile = {
    init: function() {

        ProfileBase.load_profile_data();
        ProfileBase.load_user_images();

        $('.carousel').carousel({
            interval: 3000
        });
    }
};
function country_show_name(result)
{
    $('#country').html(result.response[0].title);
}

function city_other_show_names(result)
{
    $('#city').html(result.response[0].title);
}