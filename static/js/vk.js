
var Vk = {
    vk_version: '5.5',
    
    add_script:
        function(src)
        {
            var elem = document.createElement('script');
            elem.src = src;
            document.head.appendChild(elem);
        },
        
    set_option_for_select:
        function(items, select_id, is_region, db_data)
        {
            var user_db_value,
                isset_user_db_value = false;
                
            if (items.length) {
                user_db_value = $(select_id).attr('user_val');
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
                $(select_id + '_div').removeClass('hide');
                if (isset_user_db_value)
                {
                    $(select_id).val(user_db_value).change();
                }
            }
            else if (is_region)  {
                Vk.load_cities(db_data != undefined ? true : false);
            }
        },

    load_regions:
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
        }
}