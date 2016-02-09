
function set_option_for_select(response, id_select, is_region)
{
    if (response.length) {
        $(id_select).append('<option value="0">Выберите...</option>');
        $.each(response, function(i, val) {
            $(id_select).append('<option value="'+val.id+'">' + val.title + '</option>');
        });
        $(id_select + '_div').removeClass('hide');
        if ($(id_select).attr('val') > 0)
        {
            $(id_select).val($(id_select).attr('val')).change();
        }
    }
    else if (is_region)  {
        load_cities();
    }
}