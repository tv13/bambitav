<?php

require_once LAYERS_DIR.'/Paging/paged_lister.inc.php';

class LegalEntityList extends PagedLister
{
    private $_category_id;
    private $_query_string;
    /////////////////////////////////////////////////////////////////////////////
    
    public function __construct($category_id, $query_string)
    {
        parent::__construct();
        $this->_category_id = $category_id;
	$this->_query_string = $query_string;
    }
    /////////////////////////////////////////////////////////////////////////////

    public function get_conditions()
    {
	$result = array();
	
	if (!empty($this->_query_string))
	{
		$q = '%' . preg_replace('/\s+/', '%', $this->_query_string) . '%';
		$result[] = '`gp_legal_entity`.`entity_address` LIKE "' . mysql_real_escape_string($q) . '"';
	}
	else if ($this->_category_id)
	{
		$result[] = '`gp_legal_entity`.`branch_id` = ' . $this->_category_id;
	}
	return $result;
    }
    ////////////////////////////////////////////////////////////////////////////

    public function get_list_tmp()
    {
        $this-> db-> exec_query("
            SELECT `gp_legal_entity`.*, `gp_legal_ckea`.`name` as `ckea_name`
            FROM `gp_legal_entity` INNER JOIN `gp_legal_branch` on `gp_legal_entity`.`branch_id` = `gp_legal_branch`.`id`
                    INNER JOIN `gp_legal_ckea` on `gp_legal_entity`.`ckea_id` = `gp_legal_ckea`.`id`
        ".$this-> get_where_part() . 'ORDER BY IF(`entity_address` = "" OR `entity_address` IS NULL, 1, 0), `entity_address`' . $this-> get_limit_part());
        return $this-> db-> get_all_data();
    }
    ////////////////////////////////////////////////////////////////////////////
    
    public function get_list()
    {
        $fio = array(
            'Иванов Иван Иванович',
            'Петров Владимир Иванович',
            'Шишкин Сергей Борисович'
        );
        $phone = array(
            '380663214567',
            '380673212345',
            '380934324344'
        );
        $result = array();
        foreach ($this->get_list_tmp() as $data)
        {
            $data['fio'] = $fio[rand(0, count($fio)-1)];
            $data['phone'] = $phone[rand(0, count($phone)-1)];
            $result[] = $data;
        }
        return $result;
    }

    public function get_results_count()
    {
         $this-> db-> exec_query("
             SELECT COUNT(*)
             FROM `gp_legal_entity` INNER JOIN `gp_legal_branch` on `gp_legal_entity`.`branch_id` = `gp_legal_branch`.`id`
                    INNER JOIN `gp_legal_ckea` on `gp_legal_entity`.`ckea_id` = `gp_legal_ckea`.`id`
        ".$this-> get_where_part());
        return $this-> db-> get_one();
    }
    /////////////////////////////////////////////////////////////////////////////

    public function delete($ids)
    {
         $this-> db-> exec_query("
         DELETE  
           FROM `gp_legal_entity` INNER JOIN `gp_legal_branch` on `gp_legal_entity`.`branch_id` = `gp_legal_branch`.`id`
                    INNER JOIN `gp_legal_ckea` on `gp_legal_entity`.`ckea_id` = `gp_legal_ckea`.`id`
         WHERE id IN (".$this-> db-> get_in_list($ids).")");
    }
    ////////////////////////////////////////////////////////////////////////////
}
