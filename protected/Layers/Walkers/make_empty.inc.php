<?php
/**************************************************************
* Project  : Movable-Ink Gen
* Name     : WalkerMakeEmpty
* Version  : 1.0
* Date     : 2005.03.xx
* Modified : $Id: make_empty.inc.php,v 0601e61b2f77 2012/01/11 19:19:18 ForJest $
* Author   : forjest@gmail.com
***************************************************************
*
*
*
*/
require_once dirname(__FILE__).'/walker.inc.php';
class WalkerMakeEmpty extends Walker
{
/////////////////////////////////////////////////////////////////////////////

function walk()
{
     foreach (array_keys($this-> Targets) as $key)
     {
          $this-> Targets[$key]-> make_empty();
     }
}
/////////////////////////////////////////////////////////////////////////////
}//class ends here
?>