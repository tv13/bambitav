$(document).ready(function(){

    Questionnaires.init();
});

var Questionnaires = {
    showMore :null,
    filter_data:null,
    init: function() {

        this.showMore = $("#showMore");
        this.showMore.click(function(){
            Questionnaires.load_questionnaires.call();
        });

        this.showMore.click();

        $('#country_filter').change(function() {
            Vk.get_cities_by_id(Users_vk_data.users_vk_db_data.data[$('#country_filter').val()]);
        });

        //$('#region_filter').change(function() { Vk.load_cities(true); });
        $('form#filter_form').submit(Filter.apply_filter);
        Users_vk_data.add_vk_getCountries();
    },
    load_questionnaires_by_params: function(params) {
        $.ajax({
            url : "",
            type: "GET",
            data: params,
            success: function(data) {

                $('form#filter_form').find('button[type=submit]').removeAttr('disabled');

                if (data.status == 0)
                {
                    alert(data.statusMessage);
                    return false;
                }
                Questionnaires.show();

                Questionnaires.setNavy(data.data.navy_pages, params.page);

                $("#itemContainer").append(Questionnaires.fill(data.data.records, data.data.navy_pages));
            }
        });
    },
    fill: function(records, navy_pages){
        var strElemsAppend = "";
        var current_num = (navy_pages.page_num-1) * navy_pages.per_page;
        var i = 0;
        while (i < records.length) {
            records[i].sex_img = 'venus-mars'
            if (records[i].sex == 'm')
            {
                records[i].sex_img = 'mars';
            }
            else if (records[i].sex == 'f')
            {
                records[i].sex_img = 'venus';
            }

            if (!(current_num % 2))
            {
                strElemsAppend += '<div class="row">';
            }
            strElemsAppend += Questionnaires.build(records[i]);

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

        return strElemsAppend;
    },
    build: function(record) {

        return '<div class="col-md-6 portfolio-item thumbnail text-center">'
            +       '<a href="#">'
            +           '<img class="img-responsive"'
            +               'src="' + (record.url ? record.url : 'http://placehold.it/700x400') + '" alt="">'
            +       '</a>'
            +       '<div class="caption">'
            +           '<h3>'
            +               '<a href="#">'
            +                   '<span class="profile-left">'
            +                       record.name
            +                   '</span>'
            +                   '<span class="profile-right">'
            +                       (record.age >= 6 && record.age < 100 ? record.age + ', ' : '')
            +                       '<i class="fa fa-' + record.sex_img + ' profile_ico"></i>'
            +                   '</span>'
            +               '</a>'
            +           '</h3>'
            +       '</div>'
            + '</div>';
    },
    setNavy: function(navy_pages, page) {
        if (navy_pages.next.text != undefined)
        {
            $("#textShowMore").text(navy_pages.next.text);
        }
        else
        {
            $("#showMore").addClass("hide");
        }

        if (page == 1)
        {
            $("#totalCount").text(navy_pages.total);
        }
    },
    show: function(){
        if ($('#filterModal').hasClass('in'))
        {
            $("#itemContainer").empty();
            $('#filterModal').modal('hide');
        }
    },
    load_questionnaires: function() {
        var page_num = 0;

        var params= {
            action  : 'content_data',
            size    : '700x400',
            page    : ++page_num
        };
        $.extend(params, Questionnaires.filter_data);

        return Questionnaires.load_questionnaires_by_params(params);
    }
};

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
        }
}
function city_other_show_names(result)
{
    $('#city_filter_div').removeClass('hide');
    $('#city_filter').empty();
    $.each(result.response, function(i, item) {
        $('#city_filter').append('<option value="' + item.id + '">' + item.title + '</option>');
    });
}

/*function regions_process(result)
 {
 Vk.set_option_for_select(result.response.items, '#region_filter', true, Users_vk_data.users_vk_db_data.data[$('#country_filter').val()]);
 }*/

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

            Questionnaires.filter_data = Filter.get_filter_request_data();

            Questionnaires.showMore.click();

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