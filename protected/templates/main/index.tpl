{include file='./inset/header.tpl'}
<body>
    <div id="page-preloader"><span class="spinner"></span></div>

    <div class="wrapper">
    <div class="jumbotron">

    </div>
    <div class="container container-bambi">
        <div id="itemContainer" class="panel-group" role="tablist" aria-multiselectable="true">
        </div>

       <div class="show-more">
           <div class="records">Всего: <span id="totalCount"></span> записей</div>
           <button type="button" class="btn btn-primary center" id="showMore">Show More (<span id="textShowMore"></span> записи)</button>
       </div>
        <hr>

    </div>
        <div class="footer-push"></div>
    </div>

    {include file='./inset/bottom.tpl'}
    <script src="{$HTTP_STATIC_PATH}/js/vk.js"></script>
    <script src="{$HTTP_STATIC_PATH}/js/index.js"></script>
</body>
</html>
