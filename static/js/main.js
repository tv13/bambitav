function main_page_init()
{
    $('.nav_menu >div').click(menu_item_load);
    autocomplete('.address');
    $('.table_content').find('>div:last-child').hide();
    $('.table_content').click(table_set_slide);
    $('select').selectbox();
    parent.postMessage('gpay' + $(document).height(), '*');
}

function menu_item_load()
{
    var id = $(this).find('a').attr('id').split('_').pop();
    window.location.href = ABS_PATH + '?category=' + id;
    table_set_slide();
}

function autocomplete(class_input)
{
    $(class_input).autocomplete(
    {
        serviceUrl:'autocomplete.php?action=suggest',
        minChars:2,
        selectFirst: false,
        delimiter: /(,|;)\s*/,
        onSelect: search_address
    });
}

function search_address(string_search)
{
    window.location.href = ABS_PATH + '?q=' + string_search.value;
}

function table_set_slide()
{
    $('.table_content').find('>div:first-child').removeClass('clicked_table');
    $('.table_content').find('>div.clicked_toggle').removeClass('clicked_toggle');
    $(this).find('>div:first-child').addClass('clicked_table');
    $(this).find('>div:last-child').addClass('clicked_toggle');
    $('.table_content').find('>div:not(.clicked_toggle):last-child').hide();
    $(this).find('>div:last-child').toggle();
}