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
    const SQL_CALC_AGE = '(YEAR(CURDATE())-YEAR(birthdate)) - (RIGHT(CURDATE(),5)<RIGHT(birthdate,5))';
    /////////////////////////////////////////////////////////////////////////////
    
    public function __construct($Data)
    {
        parent::__construct();
        $this->_Data = $Data;
        if (isset($this->_Data['age_min']))
        {
            $this->_validate_filter_age($this->_get_data_field('age_min', FILTER_AGE_MIN), $this->_get_data_field('age_max', FILTER_AGE_MAX));
        }
    }
    /////////////////////////////////////////////////////////////////////////////

    function get_conditions()
    {
        $this->_Conditions = array();
        $this->_Conditions[] = 'status = -1';
        if (!empty($this->_get_data_field('page')))
        {
            $this->_Conditions[] = '(pic.main = 1 OR ISNULL(pic.main))';
        }
        $this->_add_condition('country');
        //$this->_add_condition('region');
        $this->_add_condition('city');
        $this->_add_condition('sex');
        if (!empty($this->_get_data_field('age_min')))
        {
            $this->_Conditions[] = self::SQL_CALC_AGE . ' >= ' . $this->_get_data_field('age_min');
        }
        if (!empty($this->_get_data_field('age_max')))
        {
            $this->_Conditions[] = self::SQL_CALC_AGE . ' <= ' . $this->_get_data_field('age_max');
        }

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
    
    private function _get_data_field($field, $default = '')
    {
        if (!empty($this->_Data[$field]))
        {
            return trim(html_entity_decode((string)$this->_Data[$field]));
        }
        return $default;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _validate_filter_age($minAge, $maxAge)
    {
        if (!is_numeric($minAge) || !is_numeric($maxAge)
                || ($minAge > $maxAge)
                || ((int)$minAge < FILTER_AGE_MIN || (int)$maxAge > FILTER_AGE_MAX))
        {
            throw new ExceptionProcessing(40);
        }
        return true;
    }
    ////////////////////////////////////////////////////////////////////////////

    function get_list()
    {
        $this-> db-> exec_query("
            SELECT users.name, " . self::SQL_CALC_AGE . " AS age, users.sex, pic.key_code " . self::SQL_JOIN
            . $this-> get_where_part().$this-> get_limit_part());
        return $this-> db-> get_all_data();
    }
    ////////////////////////////////////////////////////////////////////////////

    function get_results_count()
    {
        $this-> db-> exec_query("
            SELECT COUNT(*) " . self::SQL_JOIN
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

    function get_vk_data()
    {
        $this-> db-> exec_query("
            SELECT country, city FROM `tm_users`"
            . $this-> get_where_part());
        return $this-> db-> get_all_data();
    }
    ////////////////////////////////////////////////////////////////////////////
}//class ends here
?>