$(document).ready(function(){
    
    var show_more = load_questionnaires();
    show_more();
    $("#showMore").click(show_more);
    $('#country_filter').change(function() {
        if ($('#country_filter').val() > 0)
        {
            Vk.get_cities_by_id(Users_vk_data.users_vk_db_data.data[$('#country_filter').val()]);
        }
        else
        {
            $('#city_filter_div').addClass('hide');
            $('#city_filter').empty();
        }
    });
    //$('#region_filter').change(function() { Vk.load_cities(true); });
    $('form#filter_form').submit(Filter.apply_filter);
    Users_vk_data.add_vk_getCountries();
});

function load_questionnaires_by_params(params) {
    $.ajax({
        url : "",
        type: "GET",
        data: params,
        beforeSend: function () {

        },
        success: function(data) {
            preloader_close();
            $('form#filter_form').find('button[type=submit]').removeAttr('disabled');
            
            if (data.status != 1)
            {
                alert(data.statusMessage);
                return false;
            }
            if ($('#filterModal').hasClass('in'))
            {
                $("#itemContainer").empty();
                $('#filterModal').modal('hide');
            }
            
            // show more button + text
            var navy_pages = data.data.navy_pages;
            if (navy_pages.next.text != undefined)
            {
                $("#textShowMore").text(navy_pages.next.text);
                $("#showMore").removeClass("hide");
            }
            else
            {
                $("#showMore").addClass("hide");
            }
            // total count records
            if (params.page == 1)
            {
                $("#totalCount").text(data.data.navy_pages.total);
            }
            
            
            var records = data.data.records;
            var current_num = (navy_pages.page_num-1) * navy_pages.per_page;
            var i = 0;
            var strElemsAppend = "";
            var sex_img;
            while (i < records.length) {
                // records[i].sex_img = 'venus-mars';
                if (records[i].sex == 'm')
                {
                    sex_img = 'mars';
                }
                else if (records[i].sex == 'f')
                {
                    sex_img = 'venus';
                }
                
                if (!(current_num % 2))
                {
                    strElemsAppend += '<div class="row">';
                }
                strElemsAppend += '<div class="col-md-6 portfolio-item thumbnail text-center">'
                                +       '<a href="profile.php?id=' + records[i].id + '">'
                                +           '<img class="img-responsive"'
                                +               'src="' + (records[i].url ? records[i].url : 'static/img/no-photo_700x400.jpg') + '" alt="">'
                                +       '</a>'
                                +       '<div class="caption">'
                                +           '<h3>'
                                +               '<a href="#">'
                                +                   '<span class="profile-left">'
                                +                       records[i].name
                                +                   '</span>'
                                +                   '<span class="profile-right">'
                                +                       (records[i].age >= 14 && records[i].age < 100 ? records[i].age + ', ' : '')
                                +                       '<i class="fa fa-' + sex_img + ' profile_ico"></i>'
                                +                   '</span>'
                                +               '</a>'
                                +           '</h3>'
                                +       '</div>'
                                + '</div>';
                            
                if (current_num % 2)
                {
                    strElemsAppend += '</div>';
                }
                if (!i && current_num % 2)
                {
                    $("#itemContainer div.row:last").append(strElemsAppend);
                    strElemsAppend = "";
                }
                ++i;
                ++current_num;
            }
            $("#itemContainer").append(strElemsAppend);
        }
    });
}

function load_questionnaires(filter_data)
{
    var page_num = 0;
    
    return function() {
        var params= {
                        action  : 'content_data',
                        size    : '700x400',
                        page    : ++page_num  
                    };
        $.extend(params, filter_data);
        load_questionnaires_by_params(params);
    }
}

var Users_vk_data = {
    vk_response: {},
    users_vk_db_data: {},
    
    add_vk_getCountries:
        function()
        {
            Vk.add_script('http://api.vk.com/method/database.getCountries?v=' + Vk.vk_version
                        + '&need_all=1&count=1000&callback=Users_vk_data.process_users_vk_data');
        },
    
    process_users_vk_data:
        function(response_vk) 
        {
            $.get('',
            {
                action: 'get_users_vk_data'
            }, handle_response).error(ajax_error_handler).handler = Users_vk_data.get_users_vk_data_ajax_handler;

            Users_vk_data.vk_response = response_vk;
        },

    get_users_vk_data_ajax_handler:
        function(response)
        {
            Vk.set_option_for_select(Users_vk_data.vk_response.response.items, '#country_filter', response.data);
            Users_vk_data.users_vk_db_data = response;
            $('#filter_btn').removeClass('hide');
            Filter.set_filter_from_cookie();
        }
}

function city_other_show_names(result)
{
    $('#city_filter_div').removeClass('hide');
    $('#city_filter').empty();
    $.each(result.response, function(i, item) {
        $('#city_filter').append('<option value="' + item.id + '">' + item.title + '</option>');
    });
    if ($('#city_filter').attr('filter'))
    {
        $('#city_filter').val($('#city_filter').attr('filter'));
        $('#city_filter').removeAttr('filter');
    }
}

/*function regions_process(result)
{
    Vk.set_option_for_select(result.response.items, '#region_filter', true, Users_vk_data.users_vk_db_data.data[$('#country_filter').val()]);
}

function cities_process(result)
{
    var region_val = !$('#region_filter_div').hasClass('hide') ? $('#region_filter').val() : 0;
    Vk.set_option_for_select(result.response.items, '#city_filter', false, Users_vk_data.users_vk_db_data.data[$('#country_filter').val()][region_val]);
}*/

var Filter = {
    cookie_name: PROJECT_NAME + '_filter',
    
    apply_filter:
        function()
        {
            $('form#filter_form').find('button[type=submit]').attr('disabled','disabled');
            var filter_request_data = Filter.get_filter_request_data();
            var show_more = load_questionnaires(filter_request_data);
            show_more();
            $("#showMore")
                    .unbind('click')
                    .bind('click', show_more);
            Filter.setCookie(Filter.cookie_name, JSON.stringify(filter_request_data));
            return false;
        },

    get_filter_request_data:
        function()
        {
            var request_data = {};
            var param_name;
            $('#filter_form .filter').each(function(){
                param_name = $(this).attr('id').replace('_filter', '');
                request_data[param_name] = $(this).attr('type') != 'checkbox'
                                            ? $(this).val()
                                            : $(this).prop('checked') ? 1 : 0;
            });
            return request_data;
        },
        
    set_filter_from_cookie:
        function()
        {
            var cookie_filter = Filter.getCookie(Filter.cookie_name);
            var $form_field;
            if (cookie_filter)
            {
                $.each(JSON.parse(cookie_filter), function(name, value)
                {
                    $form_field = $('#filter_form #'+name+'_filter');
                    if ($form_field.attr('type') != 'checkbox')
                    {
                        $form_field.val(value);
                        if (name == 'country')
                        {
                            $form_field.change();
                        }
                        else if (name == 'city')
                        {
                            $form_field.attr('filter', value);
                        }
                    }
                    else
                    {
                        $form_field.prop('checked', value);
                    }
                });
            }
        },
        
    setCookie:
        function(cname, cvalue, expires_days)
        {
            if (expires_days == undefined)
            {
                expires_days = 3 * 30;  // 3 monthes
            }
            var d = new Date();
            d.setTime(d.getTime() + (expires_days*24*60*60*1000));
            var expires = "expires="+d.toUTCString();
            document.cookie = cname + "=" + cvalue + "; " + expires;
        },
        
    getCookie:
        function(cname)
        {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i=0; i<ca.length; i++)
            {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1);
                if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
            }
            return "";
        }
}