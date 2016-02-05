$(document).ready(function(){
    
    var show_more = load_questionnaires();
    show_more();
    $("#showMore").click(show_more);
    
});

function load_questionnaires_by_params(params) {
    $.ajax({
        url : "",
        type: "GET",
        data: params,
        beforeSend: function () {

        },
        success: function(data) {
            // show more button + text
            var navy_pages = data.data.navy_pages;
            if (navy_pages.next.text != undefined)
            {
                $("#textShowMore").text(navy_pages.next.text);
            }
            else
            {
                $("#showMore").addClass("hide");
            }
            // total count records
            if (params.page == 1)
            {
                $("#totalCount").text(data.data.navy_pages.total);
            }
            
            
            var records = data.data.records;
            var current_num = (navy_pages.page_num-1) * navy_pages.per_page;
            var i = 0;
            var strElemsAppend = "";
            while (i < records.length) {
                if (!(current_num % 2))
                {
                    strElemsAppend += '<div class="row">';
                }
                strElemsAppend += '<div class="col-md-6 portfolio-item">'
                                + '     <a href="#">'
                                + '         <img class="img-responsive" style="outline: 2px solid #000; width="700"; height="400";"'
                                + '             src="' + (records[i].url ? records[i].url : 'http://placehold.it/700x400') + '"'
                                + '             width="700" height="400" alt="">'
                                + '     </a>'
                                + '     <h3>'
                                + '         <a href="#">' + records[i].name + ", " + records[i].birthdate + '</a>'
                                + '     </h3>'
                                + '</div>';
                            
                if (current_num % 2)
                {
                    strElemsAppend += '</div>';
                }
                if (!i && current_num % 2)
                {
                    $("#itemContainer div.row:last").append(strElemsAppend);
                    strElemsAppend = "";
                }
                ++i;
                ++current_num;
            }
            $("#itemContainer").append(strElemsAppend);
        }
    });
}

function load_questionnaires()
{
    var page_num = 0;
    
    return function() {
        var params= {
                        action  : 'content_data',
                        size    : '700x400',
                        page    : ++page_num  
                    };
        load_questionnaires_by_params(params);
    }
}