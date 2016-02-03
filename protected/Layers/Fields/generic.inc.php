<?php
/**************************************************************
* Project  : Movable-Ink Gen
* Name     : FieldGeneric
* Version  : 1.0
* Date     : 2005.03.xx
* Modified : $Id: generic.inc.php,v 0601e61b2f77 2012/01/11 19:19:18 ForJest $
* Author   : forjest@gmail.com
***************************************************************
*
*
*
*/
define('CUSTOM_ERROR_MESSAGE', 'CUSTOM_ERROR_MESSAGE');
class FieldGeneric
{
var $value = null;
var $error_code;
var $validater = null;
var $is_valid = true;
var $need_escape = true;
/////////////////////////////////////////////////////////////////////////////

function __construct($value = null)
{
     $this-> reset_error();
     if (!is_null($value))
     {
          $this-> set($value);
     }
     else
     {
          $this-> set_default();
     }
}
/////////////////////////////////////////////////////////////////////////////

function reset_error()
{
     $this-> set_error_code('');
     $this-> is_valid   = true;
}
/////////////////////////////////////////////////////////////////////////////

function raise_error($error_code)
{
     $this-> set_error_code($error_code);
     $this-> is_valid   = false;
}
/////////////////////////////////////////////////////////////////////////////

function is_valid()
{
     return $this-> is_valid;
}
/////////////////////////////////////////////////////////////////////////////

function set_not_need_escape()
{
     $this->need_escape = false;
}
/////////////////////////////////////////////////////////////////////////////

function has_error()
{
     return !$this-> is_valid();
}
/////////////////////////////////////////////////////////////////////////////

function set_error_code($error_code)
{
     $this-> error_code = $error_code; 
}
function get_error_code()
{
     return $this-> error_code;
}
////////////////////////////////////////////////////////////////////////////

function is_custom_message()
{
     return $this-> get_error_code() == CUSTOM_ERROR_MESSAGE;
}
///////////////////////////////////////////////////////////////////////////

function get_error_message()
{
     return '';
}
///////////////////////////////////////////////////////////////////////////

function set_value($value)
{
     $this-> value = $value;
}
////////////////////////////////////////////////////////////////////////////

function set_default()
{
     $this-> set($this-> get_default_value());
}
///////////////////////////////////////////////////////////////////////////

function get_default_value()
{
     return '';
}
///////////////////////////////////////////////////////////////////////////

function set($value)
{
     $this-> set_value($value);
}
/////////////////////////////////////////////////////////////////////////////

function get()
{
     return $this-> value;
}
/////////////////////////////////////////////////////////////////////////////

function set_validater($validater)
{
     $this-> validater = $validater;
     if (!empty($this-> validater))
     {
          $this-> validater-> set_parent($this);
     }
}
////////////////////////////////////////////////////////////////////////////

function set_input_data($value)
{
     $this-> set_value($value);
     $this-> filter_pre();
}
function get_form_context()
{
     return $this-> get();
}
/////////////////////////////////////////////////////////////////////////////

function get_mysql_string_context($str)
{
     /*if (!is_scalar($str) && !empty($str))
     {
          var_dump($str);
          print_r(debug_backtrace());
          die('Error in params');
     }*/
     return "'".mysql_real_escape_string($str)."'";
}
///////////////////////////////////////////////////////////////////////////

function get_db_context()
{
    if (!$this->need_escape)
    {
        return $this->get();
    }
    return $this-> get_mysql_string_context($this-> get());
}
/////////////////////////////////////////////////////////////////////////////

function set_db_context($db_value)
{
     $this-> set_value($db_value);
}
///////////////////////////////////////////////////////////////////////////

function filter_trim()
{
     $this-> set_value(trim((string)@$this-> value));
}
/////////////////////////////////////////////////////////////////////////////

function filter_pre()
{
     
}
/////////////////////////////////////////////////////////////////////////////

function is_empty()
{
     return empty($this-> value);
}
/////////////////////////////////////////////////////////////////////////////

function equal($Field)
{
     return $this-> get() == $Field-> get();
}
/////////////////////////////////////////////////////////////////////////////

function copy($Src)
{
     $this-> set($Src-> get());
}
///////////////////////////////////////////////////////////////////////////

function make_empty()
{
     $this-> set_value('');
}
///////////////////////////////////////////////////////////////////////////

function validate()
{
     if (is_object($this-> validater))
     {
          $this-> validater-> validate();
     }
     //implementation
}
/////////////////////////////////////////////////////////////////////////////
}//class ends here
?>