$(document).ready(function(){
    $.get( "index.php", { go: "content_data"} )
  .done(function( data ) {
    alert( "Data Loaded: " + data );
  });
});
