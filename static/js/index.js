$(document).ready(function(){
    
    if (!Cookie.getCookie(Cookie.cookie_filter))
    {
        var show_more = load_questionnaires();
        show_more();
        $("#showMore").click(show_more);
    }
    else
    {
        Filter.set_filter_from_cookie();
        if (!$('#country_filter').attr('filter'))
        {
            Filter.apply_filter();
        }
    }
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
        url : ".",
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

                var ab="Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged'"
;
                strElemsAppend += '<div class="col-md-6 portfolio-item thumbnail text-center header-col">'
                                +    '<div class="caption top">'
                                +           '<div class="panel-heading" role="tab" id="record-' + records[i].id + '">'

                                +                   '<a role="button" data-toggle="collapse"'
                                +     'data-parent="#itemContainer" href="#collapse' + records[i].id + '"'
                                +       'aria-expanded="true" aria-controls="collapseOne" class="hoverExpand">'

                                +                          'Объявление'
                    +                           '<br><i class="glyphicon glyphicon-triangle-bottom glyphicon glyphicon-o"></i>'

                    +                   '</a>'
                                +           '</div>'
                                +           '<div id="collapse' + records[i].id + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="record' + records[i].id + '">'
                                +               '<div class="panel-body">'
                                +                   ab + '<br>'
                                +                   ab
                                +                   '<img src="static/img/grad.png" alt="Read More" class="text-overflow">'
                                +               '</div>'
                                +           '</div>'
                                +       '</div>'
                                +       '<a href="profile.php?id=' + records[i].id + '" >'
                                +           '<img class="img-responsive"'
                                +               'src="' + (records[i].url ? records[i].url : 'static/img/no-photo_700x400.jpg') + '" alt="">'
                                +       '</a>'
                + '<div class="caption">'
                +           '<h3>'
                +                   '<span class="profile-left">'
                +                       records[i].name
                +                   '</span>'
                +                   '<span class="profile-right">'
                +                       (records[i].age >= 14 && records[i].age < 100 ? records[i].age + ', ' : '')
                +                       '<i class="fa fa-' + sex_img + ' profile_ico"></i>'
                +                   '</span>'
                +           '</h3>'
                +       '</div>'
                                +   '</div>';

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
            $.get('.',
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
            if (!$('#city_filter').attr('filter') && $('#country_filter').attr('filter'))
            {
                Filter.apply_filter();
                Cookie.setCookie(Cookie.cookie_filter, JSON.stringify(Filter.get_filter_request_data()));
            }
            $('#country_filter').removeAttr('filter');
        }
}

function city_other_show_names(result)
{
    $('#city_filter_div').removeClass('hide');
    $('#city_filter').empty();
    $('#city_filter').append('<option value="0">Выберите...</option>');
    $.each(result.response, function(i, item) {
        $('#city_filter').append('<option value="' + item.id + '">' + item.title + '</option>');
    });
    if ($('#city_filter').attr('filter'))
    {
        var city_filter_val = $('#city_filter').attr('filter');
        if ($('#city_filter option[value="'+city_filter_val+'"]').length > 0)
        {
            $('#city_filter').val(city_filter_val);
        }
        $('#city_filter').removeAttr('filter');
        Filter.apply_filter();
        Cookie.setCookie(Cookie.cookie_filter, JSON.stringify(Filter.get_filter_request_data()));
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
    
    apply_filter:
        function(is_not_load_page)
        {
            var filter_request_data = Filter.get_filter_request_data();
            var show_more = load_questionnaires(filter_request_data);
            show_more();
            $("#showMore")
                    .unbind('click')
                    .bind('click', show_more);
            if (is_not_load_page)
            {
                Cookie.setCookie(Cookie.cookie_filter, JSON.stringify(filter_request_data));
                $('form#filter_form').find('button[type=submit]').attr('disabled','disabled');
                return false;
            }
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
            var cookie_filter_val = Cookie.getCookie(Cookie.cookie_filter);
            var $form_field;
            if (cookie_filter_val)
            {
                $.each(JSON.parse(cookie_filter_val), function(name, value)
                {
                    $form_field = $('#filter_form #'+name+'_filter');
                    if ($form_field.attr('type') != 'checkbox')
                    {
                        $form_field.val(value);
                        if (name == 'country'
                            && !Cookie.getCookie(Cookie.cookie_pref + 'country')
                            && value > 0)
                        {
                            $form_field.attr('filter', value);
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
            Filter.set_form_field_value('country');
            Filter.set_form_field_value('city');
        },
        
    set_form_field_value:
        function(name)
        {
            if (Cookie.getCookie(Cookie.cookie_pref + name))
            {
                var GET_value = Cookie.getCookie(Cookie.cookie_pref + name);
                $('#'+name+'_filter').attr('filter', GET_value);
                if (name == 'country')
                {
                    $('#'+name+'_filter')
                        .val(GET_value)
                        .change();
                }
            }
            else if (name == 'city' && Cookie.getCookie(Cookie.cookie_pref + 'country'))
            {
                $('#city_filter').removeAttr('filter');
            }
        }
}