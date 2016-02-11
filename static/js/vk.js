
var vk = {
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
            if (items.length) {
                $(select_id).append('<option value="0">Выберите...</option>');
                $.each(items, function(i, val) {
                    if (!db_data || db_data && db_data[val.id])
                    {
                        $(select_id).append('<option value="'+val.id+'">' + val.title + '</option>');
                    }
                });
                $(select_id + '_div').removeClass('hide');
                if ($(select_id).attr('val') > 0)
                {
                    $(select_id).val($(select_id).attr('val')).change();
                }
            }
            else if (is_region)  {
                vk.load_cities();
            }
        },

    load_regions:
        function(elem_id_part)
        {
            var elem_id_part = vk.get_elem_id_part(elem_id_part);
            $('#region' + elem_id_part + '_div').addClass('hide');
            $('#region' + elem_id_part).empty();
            $('#city' + elem_id_part + '_div').addClass('hide');
            $('#city' + elem_id_part).empty();
            if ($('#country' + elem_id_part).val() >= 0)
            {
                vk.add_script('http://api.vk.com/method/database.getRegions?v=' + vk.vk_version
                            + '&need_all=1&offset=0&count=1000&callback=regions_process'
                            + '&country_id=' + $('#country' + elem_id_part).val());
            }
        },

    load_cities:
        function(event)
        {
            var elem_id_part = vk.get_elem_id_part(event);
            $('#city' + elem_id_part + '_div').addClass('hide');
            $('#city' + elem_id_part).empty();
            if (!$('#region' + elem_id_part + '_div').hasClass('hide') ? $('#region' + elem_id_part).val() >= 0 : $('#country' + elem_id_part).val() >= 0)
            {
                vk.add_script('http://api.vk.com/method/database.getCities?v=' + vk.vk_version
                            + '&offset=0&need_all=1&count=1000&callback=cities_process'
                            + '&country_id=' + $('#country' + elem_id_part).val()
                            + (!$('#region' + elem_id_part + '_div').hasClass('hide') ? '&region_id=' + $('#region' + elem_id_part).val() : ''));
            }
        },

    get_elem_id_part:
        function(elem_id_part)
        {
            if ($.type(elem_id_part) === "string")
            {
                return '_' + elem_id_part;
            }
            return '';
        }
}