{include file='./inset/header.tpl'}
<body>
    <div id="page-preloader"><span class="spinner"></span></div>

    <div class="wrapper">
		<div class="jumbotron" style="padding-bottom:0px;">

		</div>
		<div class="container container-bambi">
			<div id="itemContainer" class="panel-group" role="tablist" aria-multiselectable="true">

			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="show-more">
						{*<div class="records">Всего: <span id="totalCount"></span> записей</div>*}
						<button type="button" class="btn btn-primary center" id="showMore">Показать больше (<span id="textShowMore"></span> записи)</button>
					</div>
				</div>
			</div>
		</div>
    </div>

    {include file='./inset/footer.tpl'}
    {include file='./inset/bottom.tpl'}
    <script src="{$HTTP_STATIC_PATH}/js/vk.js"></script>
    <script src="{$HTTP_STATIC_PATH}/js/index.js"></script>
</body>
</html>
