<?php
/**************************************************************
* Project  : 
* Name     : SimpleController
* Version  : 1.0
* Date     : 2005.10.26
* Modified : $Id$
* Author   : forjest@gmail.com
***************************************************************
*
*
*
*/
require_once HANDLERS_DIR.'/view_templated.inc.php';
require_once HANDLERS_DIR.'/list_view.inc.php';
require_once HANDLERS_DIR.'/redirect_view.inc.php';
require_once HANDLERS_DIR.'/location_view.inc.php';
require_once HANDLERS_DIR.'/data_model.inc.php';
require_once LAYERS_DIR.'/Forms/form.inc.php';

class SimpleController
{
protected $redirect_url = HTTP_ABS_PATH;
/////////////////////////////////////////////////////////////////////////////

function __construct()
{
     
}
///////////////////////////////////////////////////////////////////////////

function is_precheck_passed()
{   
     return true;
}

function precheck_failed_action()
{
     $this-> redirect($this-> redirect_precheck);
}
///////////////////////////////////////////////////////////////////////////

function get_redirect_url()
{
     return $this-> redirect_url;
}

function redirect($url)
{
     $this-> redirect_url = $url;
     $View = $this-> get_redirect_view();
     $View-> set_model($this);
     $View-> display();
}
///////////////////////////////////////////////////////////////////////////

function get_model()
{
     return null;
}
////////////////////////////////////////////////////////////////////////////

function get_view()
{
     return null;
}
/////////////////////////////////////////////////////////////////////////////

function get_redirect_view()
{
     return new LocationView();
}
///////////////////////////////////////////////////////////////////////////

function select_run_model()
{
    $this-> Model = $this-> get_model();
    if (is_object($this-> Model))
    {
        $this-> Model-> run();
    }
}
///////////////////////////////////////////////////////////////////////////

function link_display_view()
{
     if (!is_object($this-> Model) || !$this-> Model-> need_redirect())
     {
          $this-> View  = $this-> get_view();
     }
     else
     {
          $this-> View  = $this-> get_redirect_view();
     }

     if ($this-> View)
     {
          $this-> View-> set_model($this-> Model);
          $this-> View-> display();
     }
}
///////////////////////////////////////////////////////////////////////////

function run()
{
     if (!$this-> is_precheck_passed())
     {
          $this-> precheck_failed_action();
          return;
     }
     try
     {
        $this-> select_run_model();
        $this-> link_display_view();
     }
     catch(Exception $e)
     {
        var_dump($e->getMessage(), $e->getCode());
        die();
     }
}
/////////////////////////////////////////////////////////////////////////////
}//class ends here
?>