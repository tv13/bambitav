<?php
/**************************************************************
* Project  :
* Name     : InterfaceSQLPager
* Version  : 1.0
* Date     : 2005.03.xx
* Modified : $Id$
* Author   : forjest@gmail.com
***************************************************************
*
*
*
*/
class InterfaceSQLPager
{
var $count;
var $from;
/////////////////////////////////////////////////////////////////////////////

function InterfaceSQLPager()
{
     $this-> set_from(0);
     $this-> set_count(10);
}
/////////////////////////////////////////////////////////////////////////////

function set_from($from)
{
     $this-> from = $from;
}
/////////////////////////////////////////////////////////////////////////////

function set_count($count)
{
     $this-> count = $count;
}
/////////////////////////////////////////////////////////////////////////////

function get_count()
{
     return $this-> count;
}
/////////////////////////////////////////////////////////////////////////////

function get_from()
{
     return $this-> from;
}
/////////////////////////////////////////////////////////////////////////////

function get_limit_part()
{
     return ' LIMIT '.$this-> get_from(). ', '.$this-> get_count();
}
////////////////////////////////////////////////////////////////////////////
}//class ends here
?>