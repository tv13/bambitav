$(document).ready(function(){
    

    
    $.get( "index.php", { action: "content_data"} )
  .done(function( data ) {
      var dataJson = $.parseJSON(data);
      var maxLenth = 10;
      for ( var i = 0, l = dataJson.data.length; i < l; i++ ) {
        var string = "";
        var  string2 = string.concat("<div class=\"row\">", "<div class=\"col-md-6 portfolio-item\">");
        var  string3 = string2.concat("<a href=\"#\">", "<img class=\"img-responsive\" src=\"http://placehold.it/700x400\" alt=\"\">",
          "</a>", "<h3>", "<a href=\"#\">",dataJson.data[i].id,", " ,dataJson.data[i].name , ", ",dataJson.data[i].birthdate,"</a>", "</h3>", "</div>");
          i++;
          if(i < l){
         var string4 = string3.concat("<div class=\"col-md-6 portfolio-item\">", "<a href=\"#\">", "<img class=\"img-responsive\" src=\"http://placehold.it/700x400\" alt=\"\">", "</a>", "<h3>",
          "<a href=\"#\">",dataJson.data[i].id,", ",dataJson.data[i].name ,", ",dataJson.data[i].birthdate,"</a></h3>", "</div>");
                      var string5 = string4.concat("</div>");
          }
          else
          {
            var string5 = string3.concat("</div>");
          }
           $("#itemContainer").append(string5);
        }
  });
});




                
                    
                
                    
                
                
                    
                
                    
                
            
        