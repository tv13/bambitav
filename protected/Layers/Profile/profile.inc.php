<?php
require_once LAYERS_DIR.'/DB/mysql.inc.php';

class Profile
{
////////////////////////////////////////////////////////////////////////////
    
function __construct()
{
     $this-> create_db();
     $this-> set_sql_pager(new SQLPager());
}
///////////////////////////////////////////////////////////////////////////

function create_db()
{
     $this-> db = produce_db();
}

function set_sql_pager(&$SQLPager)
{
     $this-> SQLPager = &$SQLPager;
}
    
function get_info()
{
//     $this-> db-> exec_query("
//     SELECT * 
//       FROM dc_user
//     ".$this-> get_where_part().$this-> get_limit_part());
//     return $this-> db-> get_all_data();
        return true;
}

function update_info()
{
//     $this-> db-> exec_query("
//     SELECT * 
//       FROM dc_user
//     ".$this-> get_where_part().$this-> get_limit_part());
//     return $this-> db-> get_all_data();
    return true;
}

}//class ends here
?>