$(document).ready(function(){
    $.get( "index.php", { action: "content_data"} )
  .done(function( data ) {
      
      
      var dataJson = $.parseJSON(data);
      for ( var i = 0, l = dataJson.data.length; i < l; i++ ) {
          var string = "".concat("<div class=\"row\">", "<div class=\"col-md-6 portfolio-item\">", "<a href=\"#\">", "<img class=\"img-responsive\" src=\"http://placehold.it/700x400\" alt=\"\">",
          "</a>", "<h3>", "<a href=\"#\">",i++,"</a>", "</h3>", "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>",
          "</div>", "<div class=\"col-md-6 portfolio-item\">", "<a href=\"#\">", "<img class=\"img-responsive\" src=\"http://placehold.it/700x400\" alt=\"\">", "</a>", "<h3>",
          "<a href=\"#\">",(i < l)? i :"null" ,"</a></h3><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>",
          "</div>", "</div>");
           $("#itemContainer").append(string);
}
  });
});




                
                    
                
                    
                
                
                    
                
                    
                
            
        