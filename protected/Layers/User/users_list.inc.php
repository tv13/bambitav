<?php
/**************************************************************
* Project  : BambiTav
* Name     : UsersList
* Date     : 2016.01.27
* Author   : Tanya
***************************************************************
*
*/
require_once LAYERS_DIR.'/Paging/paged_lister.inc.php';

class UsersList extends PagedLister
{
    const TABLE_NAME = 'tm_users';
    /////////////////////////////////////////////////////////////////////////////

    function get_conditions()
    {
         $result = array();
         return $result;
    }
    ////////////////////////////////////////////////////////////////////////////

    function get_list()
    {
         $this-> db-> exec_query("
         SELECT * 
           FROM " . self::TABLE_NAME
         . $this-> get_where_part().$this-> get_limit_part());
         return $this-> db-> get_all_data();
    }
    ////////////////////////////////////////////////////////////////////////////

    function get_results_count()
    {
         $this-> db-> exec_query("
         SELECT COUNT(*) FROM " . self::TABLE_NAME
         . $this-> get_where_part());
         return $this-> db-> get_one();
    }
    /////////////////////////////////////////////////////////////////////////////

    /*function delete($ids)
    {
         $this-> db-> exec_query("
         DELETE  
           FROM dc_user
         WHERE id IN (".$this-> db-> get_in_list($ids).")");
    }*/
    ////////////////////////////////////////////////////////////////////////////
}//class ends here
?>