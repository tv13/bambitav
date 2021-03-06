
var Vk = {
    vk_version: '5.5',
    callback_cities_by_name: undefined,
    max_other_cities_autocomplete: 10,
    
    add_script:
        function(src)
        {
            var elem = document.createElement('script');
            elem.src = src;
            document.head.appendChild(elem);
        },
        
    set_option_for_select:
        function(items, select_id, db_data)
        {
            var user_db_value,
                isset_user_db_value = false;
                
            if (items.length) {
                user_db_value = $(select_id).attr('user_val');
                $(select_id).removeAttr('user_val');
                $(select_id).append('<option value="0">Выберите...</option>');
                $.each(items, function(i, val) {
                    if (!db_data || db_data && db_data[val.id])
                    {
                        $(select_id).append('<option value="'+val.id+'">' + val.title + '</option>');
                        if (user_db_value > 0 && val.id == user_db_value)
                        {
                            isset_user_db_value = true;
                        }
                    }
                });
                if (select_id.indexOf('city_main') >= 0)
                {
                    $(select_id).append('<option value="0">Другой город...</option>');
                }
                $(select_id + '_div').removeClass('hide');
                if (isset_user_db_value)
                {
                    $(select_id).val(user_db_value).change();
                }
                else if (user_db_value > 0)
                {
                    $(select_id).val(0).change();
                    Vk.get_cities_by_id(user_db_value);
                }
            }
        },

    /*load_regions:
        function(from_filter)
        {
            var elem_id_part = Vk.get_elem_id_part(from_filter);
            $('#region' + elem_id_part + '_div').addClass('hide');
            $('#region' + elem_id_part).empty();
            $('#city' + elem_id_part + '_div').addClass('hide');
            $('#city' + elem_id_part).empty();
            if ($('#country' + elem_id_part).val() > 0)
            {
                Vk.add_script('http://api.vk.com/method/database.getRegions?v=' + Vk.vk_version
                            + '&need_all=0&offset=0&count=1000&callback=regions_process'
                            + '&country_id=' + $('#country' + elem_id_part).val());
            }
        },

    load_cities:
        function(from_filter)
        {
            var elem_id_part = Vk.get_elem_id_part(from_filter);
            $('#city' + elem_id_part + '_div').addClass('hide');
            $('#city' + elem_id_part).empty();
            if (!$('#region' + elem_id_part + '_div').hasClass('hide') ? $('#region' + elem_id_part).val() > 0 : $('#country' + elem_id_part).val() > 0)
            {
                Vk.add_script('http://api.vk.com/method/database.getCities?v=' + Vk.vk_version
                            + '&offset=0&need_all=0&count=1000&callback=cities_process'
                            + '&country_id=' + $('#country' + elem_id_part).val()
                            + (!$('#region' + elem_id_part + '_div').hasClass('hide') ? '&region_id=' + $('#region' + elem_id_part).val() : ''));
            }
        },*/

    load_main_cities:
        function(from_filter)
        {
            var elem_id_part = Vk.get_elem_id_part(from_filter);
            $('#city_main' + elem_id_part + '_div').addClass('hide');
            $('#city_main' + elem_id_part).empty();
            Vk.clear_div_city_other(elem_id_part);
            if ($('#country' + elem_id_part).val() > 0)
            {
                Vk.add_script('http://api.vk.com/method/database.getCities?v=' + Vk.vk_version
                            + '&offset=0&need_all=0&count=1000&callback=cities_process'
                            + '&country_id=' + $('#country' + elem_id_part).val());
            }
        },
            
    load_other_cities:
        function(from_filter)
        {
            var elem_id_part = Vk.get_elem_id_part(from_filter);
            if ($('#city_main' + elem_id_part).val() == 0)
            {
                $('#city_other' + elem_id_part + '_div').removeClass('hide');
            }
            else
            {
                Vk.clear_div_city_other(elem_id_part);
            }
        },
        
    clear_div_city_other:
        function(elem_id_part)
        {
            $('#city_other' + elem_id_part + '_div').addClass('hide')
                .find('input').removeAttr('city_id').val('');
        },
            
    get_elem_id_part:
        function(from_filter)
        {
            if (Vk.is_bool(from_filter) && from_filter)
            {
                return '_filter';
            }
            return '';
        },
        
    is_bool:
        function(variable)
        {
            return typeof(variable) === 'boolean';
        },
        
    get_cities_by_name:
        function(request, callback)
        {
            Vk.callback_cities_by_name = callback;
            
            var searchStr  = request.term;
            Vk.add_script('http://api.vk.com/method/database.getCities?v=' + Vk.vk_version
                        + '&offset=0&need_all=0&count=1000&callback=cities_other_process'
                        + '&q=' + searchStr
                        + '&country_id=' + $('#country' /*+ elem_id_part*/).val());
        },
        
    get_cities_by_id:
        function(city_ids)
        {
            Vk.add_script('http://api.vk.com/method/database.getCitiesById?v=' + Vk.vk_version
                        + '&city_ids=' + city_ids.toString() + '&callback=city_other_show_names');
        },

    get_countries_by_id: function(country_ids)
        {
            Vk.add_script('http://api.vk.com/method/database.getCountriesById?v=' + Vk.vk_version
                        + '&country_ids=' + country_ids.toString() + '&callback=country_show_name');
        },
        
    show_cities_by_name:
        function(items)
        {
            var list_results = [];
            $.each(items, function(i, item) {
                if (i >= Vk.max_other_cities_autocomplete)
                {
                    return false;
                }
                
                var title = item.title;
                if (item.region != undefined)
                {
                    title += ', ' + item.region;
                }
                if (item.area != undefined)
                {
                    title += ', ' + item.area;
                }
                var title_decode_html = $('<div />').html(title).text();
                list_results.push({value: title_decode_html, id: item.id});
            });
            Vk.callback_cities_by_name(list_results);
        },
        
    process_autocomplete:
        function(event, ui) {
            $('#city_other').attr('city_id', ui.item.id);
        }
}