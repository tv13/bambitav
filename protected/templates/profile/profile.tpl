<body>

{include file='./inset/header.tpl'}      
      <div class="jumbotron">
    <div class="container">
        <div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-12">
                                    <h2>Heading</h2>
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="http://placehold.it/600x600" alt="">
      <div class="carousel-caption">
        Photo1
      </div>
    </div>
    <div class="item">
      <img src="http://placehold.it/600x600" alt="">
      <div class="carousel-caption">
        Photo2
      </div>
    </div>
    <div class="item">
      <img src="http://placehold.it/600x600" alt="">
      <div class="carousel-caption">
        Photo3
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">                  
                <h2>Heading</h2>
                <form onsubmit="return false">
                    <fieldset enable>
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="city">Город</label>
                            <input type="text" id="city" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="birsday">Дата рождения</label>
                            <input type="date" id="birsday" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="sex">Пол</label>
                            <select id="sex" class="form-control" required>
				<option value="">Не указан</option>
				<option value="m">Мужской</option>
                                <option value="f">Женский</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="phoneNumber">Номер телефона</label>
                            <input type="text" id="phoneNumber" class="form-control" required>

                        </div>
                        <div class="form-group">
                            <label for="description">Текст объявления</label>
                            <textarea class="form-control" id="description" rows="3"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </fieldset>
                </form>  
		</div>
	</div>
    </div>    
      <hr>
  {include file='./inset/bottom.tpl'}

    </div> <!-- /container -->

    <script src="{$HTTP_STATIC_PATH}/js/profile.js"></script>
  </body>
</html>