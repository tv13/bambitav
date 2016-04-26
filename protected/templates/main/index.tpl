<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>2 Col Portfolio - Start Bootstrap Template</title>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
</head>

<body>
    <div id="page-preloader"><span class="spinner"></span></div>

    {include file='./inset/header.tpl'}

    <div class="jumbotron">
      <div class="container">
        <h1>Bambita</h1>
      </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Page Heading
                    <small>Secondary Text</small>
                </h1>
            </div>
        </div>
        <div id="itemContainer">
        </div>

       <div class="show-more">
           <div class="records">Всего: <span id="totalCount"></span> записей</div>
           <button type="button" class="btn btn-primary center" id="showMore">Show More (<span id="textShowMore"></span> записи)</button>
       </div>
        <hr>

  {include file='./inset/bottom.tpl'}

    </div>
    <script src="{$HTTP_STATIC_PATH}/js/vk.js"></script>
    <script src="{$HTTP_STATIC_PATH}/js/index.js"></script>
</body>
</html>
