$(document).ready(default_init);
///////////////////////////////////////////////////////////////////////////

function init_debug()
{
     $(document).keydown(function(event){
          if (event.keyCode == 192)
          {
               $('#debug-block').toggle();
          }
        }
     );
     $('.debug-hide').click(function(){$('#debug-block').hide();return false;});
     $('#debug-show').click(function(){$('#debug-block').toggle();return false;});
}
////////////////////////////////////////////////////////////////////////////

function common_initialization()
{
     init_debug();
}
////////////////////////////////////////////////////////////////////////////

function default_init()
{
     if (typeof window['sys_page_init_function'] == 'undefined')
     {
          return common_initialization();
     }
     
     if (typeof window[sys_page_init_function] != 'function')
     {
          alert('Initialization error: '+sys_page_init_function+' is not a function or undefined');
          return common_initialization();
     }
     
     if ('stop' == eval(sys_page_init_function+'();'))
     {
               return;
     }
     common_initialization();
}
//////////////////////////////////////////////////////////////////////////

function handle_response(data, status, jqXHR)
{
     eval("var response ="+data);
     jqXHR.handler(response);
}
////////////////////////////////////////////////////////////////////////////

function ajax_error_handler(jqXHR, textStatus, errorThrown)
{
     alert('ajax error!');
     console.log(jqXHR, textStatus, errorThrown);
     
     return false;
}
////////////////////////////////////////////////////////////////////////////


function get_real(sum)
{
    if (typeof sum == 'undefined' || sum == '')
    {
        return 0;
    }
    
    return parseFloat(sum).toFixed(2);
}
////////////////////////////////////////////////////////////////////////////

Number.prototype.decimalpart = function(sig)
{
    sig= sig || 12;
    return +((this % 1).toFixed(sig));
}
////////////////////////////////////////////////////////////////////////////

function is_int(n) 
{
    return n != "" && !isNaN(n) && Math.round(n) == n;
}
////////////////////////////////////////////////////////////////////////////

