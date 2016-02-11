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
    private $_is_main;
    const SQL_JOIN = 'FROM `tm_users` AS users LEFT JOIN `tm_user_pictures` AS pic ON users.id = pic.user_id';
    /////////////////////////////////////////////////////////////////////////////
    
    public function __construct($is_main = false)
    {
        parent::__construct();
        $this->_is_main = $is_main;
    }
    /////////////////////////////////////////////////////////////////////////////

    function get_conditions()
    {
        $result = array();

        $result[] = 'status = -1';
        if ($this->_is_main)
        {
            $result[] = 'pic.main = 1 OR ISNULL(pic.main)';
        }

        return $result;
    }
    ////////////////////////////////////////////////////////////////////////////

    function get_list()
    {
        $this-> db-> exec_query("
            SELECT users.name, users.birthdate, pic.key_code " . self::SQL_JOIN
            . $this-> get_where_part().$this-> get_limit_part());
        return $this-> db-> get_all_data();
    }
    ////////////////////////////////////////////////////////////////////////////

    function get_results_count()
    {
        $this-> db-> exec_query("
            SELECT COUNT(*) " . self::SQL_JOIN
            . $this-> get_where_part().$this-> get_limit_part());
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

    function get_vk_data()
    {
        $this-> db-> exec_query("
            SELECT country, region, city FROM `tm_users`"
            . $this-> get_where_part());
        return $this-> db-> get_all_data();
    }
    ////////////////////////////////////////////////////////////////////////////
}//class ends here
?>