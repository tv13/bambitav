$(document).ready(function(){
    
    var show_more = load_questionnaires();
    show_more();
    $("#showMore").click(show_more);
    $('#country_filter').change(function() { Vk.load_regions(true); });
    $('#region_filter').change(function() { Vk.load_cities(true); });
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
            if (data.status == 0)
            {
                return false;
            }
            if ($('#filterModal').hasClass('in'))
            {
                $("#itemContainer").empty();
                $('#filterModal').modal('hide');
                $('form#filter_form').find('button[type=submit]').removeAttr('disabled');
            }
            
            // show more button + text
            var navy_pages = data.data.navy_pages;
            if (navy_pages.next.text != undefined)
            {
                $("#textShowMore").text(navy_pages.next.text);
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
            while (i < records.length) {
                if (!(current_num % 2))
                {
                    strElemsAppend += '<div class="row">';
                }
                strElemsAppend += '<div class="col-md-6 portfolio-item">'
                                + '     <a href="#">'
                                + '         <img class="img-responsive" style="outline: 2px solid #000; width="700"; height="400";"'
                                + '             src="' + (records[i].url ? records[i].url : 'http://placehold.it/700x400') + '"'
                                + '             width="700" height="400" alt="">'
                                + '     </a>'
                                + '     <h3>'
                                + '         <a href="#">' + records[i].name + ", " + records[i].birthdate + '</a>'
                                + '     </h3>'
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
            Vk.set_option_for_select(Users_vk_data.vk_response.response.items, '#country_filter', false, response.data);

            Users_vk_data.users_vk_db_data = response;
        }
}

function regions_process(result)
{
    Vk.set_option_for_select(result.response.items, '#region_filter', true, Users_vk_data.users_vk_db_data.data[$('#country_filter').val()]);
}

function cities_process(result)
{
    var region_val = !$('#region_filter_div').hasClass('hide') ? $('#region_filter').val() : 0;
    Vk.set_option_for_select(result.response.items, '#city_filter', false, Users_vk_data.users_vk_db_data.data[$('#country_filter').val()][region_val]);
}

var Filter = {
    apply_filter:
        function()
        {
            $('form#filter_form').find('button[type=submit]').attr('disabled','disabled');
            var show_more = load_questionnaires(Filter.get_filter_request_data());
            show_more();
            $("#showMore")
                    .unbind('click')
                    .bind('click', show_more);
            return false;
        },

    get_filter_request_data:
        function()
        {
            var request_data = {};
            var param_name;
            $('#filter_form .filter').each(function(){
                param_name = $(this).attr('id').replace('_filter', '');
                request_data[param_name] = $(this).val();
            });
            return request_data;
        }
}