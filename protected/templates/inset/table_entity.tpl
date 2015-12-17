{*<div class="search">
    <form>
        <input type="text" placeholder="Поиск"/>
        <input type="submit" value="Поиск"/>
    </form>
</div>*}
<div class="content_data">
    <div class="table_title">
        <div>
            <div>Название</div>
            <div>Адрес</div>
            <div>Вид деятельности</div>
        </div>
    </div>

    <div class="num_page">
        Всего: {$NavyPages.total|default:0}, страницы: {include file='inset/page_navigation.tpl.htm'}
    </div>

    <div id="main_table_content">
    </div>
    {foreach from=$List item="row"}
      <div class="table_content">
        <div>
            <div>{$row.entity_name}</div>
            <div>{$row.entity_address}</div>
            <div>{$row.ckea_name}</div>
        </div>
        <div>
            <p><span class="bold">{$row.entity_name}</span> </p>
            <p><span>{$row.entity_address}</span></p>
            <p><span>{$row.ckea_name}</span></p>
            <p><span>Контактное лицо: </span><span class="bold">{$row.fio}</span></p>
            <p><span>Телефон: </span><span class="bold">{$row.phone}</span></p>
        </div>
    </div>
    {/foreach}
</div>
{*
<div class="counter">
    <h3>Уважаемый клиент!</h3>
    <p>Данный справочник содержит информацию о предприятиях, которые готовы выступать получателями гарантированных платежей.</p>
    <p>В настоящее время зарегистрировано <span> </span>получателей.</p>
    <p>Для перехода к списку предприятий выберите регион или вид деятельности.</p>
</div>
*}
<div class="num_page">
    Всего: {$NavyPages.total|default:0}, страницы: {include file='inset/page_navigation.tpl.htm'}
</div>