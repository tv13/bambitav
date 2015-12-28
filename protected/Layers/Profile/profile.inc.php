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
     $this->db = produce_db();
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

function update_info($userInfo)
{
     $this->db->exec_query("INSERT INTO user_info"
             . "(name, birthday, sex, phone_number, description) "
             . "VALUES "
             . "("
             . $userInfo["name"]
             . ","
             . $userInfo["birthday"]
             . ","
             . $userInfo["sex"]
             . ","
             . $userInfo["phoneNumber"]
             . ","
             . $userInfo["description"]
             . ");");
     var_dump($this->db->get_data());
     die();
     return $this->db->get_all_data();
}

}//class ends here
?>