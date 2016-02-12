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
    private $_Data = null;
    private $_Conditions;
    const SQL_JOIN = 'FROM `tm_users` AS users LEFT JOIN `tm_user_pictures` AS pic ON users.id = pic.user_id';
    /////////////////////////////////////////////////////////////////////////////
    
    public function __construct($Data)
    {
        parent::__construct();
        $this->_Data = $Data;
    }
    /////////////////////////////////////////////////////////////////////////////

    function get_conditions()
    {
        $this->_Conditions = array();
        $this->_Conditions[] = 'status = -1';
        if (!empty($this->_get_data_field('page')))
        {
            $this->_Conditions[] = 'pic.main = 1 OR ISNULL(pic.main)';
        }
        $this->_add_condition('country');
        $this->_add_condition('region');
        $this->_add_condition('city');
        $this->_add_condition('sex');

        return $this->_Conditions;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _add_condition($field)
    {
        if (!empty($this->_get_data_field($field)))
        {
            $this->_Conditions[] = $field . ' = "' . $this->_get_data_field($field) . '"';
        }
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _get_data_field($field)
    {
        if (isset($this->_Data[$field]))
        {
            return trim(html_entity_decode((string)$this->_Data[$field]));
        }
        return '';
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