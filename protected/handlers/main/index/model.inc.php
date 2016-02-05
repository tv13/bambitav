<?php

require_once LAYERS_DIR . '/User/users_list.inc.php';
require_once LAYERS_DIR . '/User/image.inc.php';

class MainIndexModel extends MainModel
{
    private $_Image;
    /////////////////////////////////////////////////////////////////////////////
    
    public function __construct()
    {
        parent::__construct();
        $this->_Image = new Image();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function get_category_id()
    {
        return (int)@$_GET['category'];
    }
    /////////////////////////////////////////////////////////////////////////////

    public function get_search_string()
    {
	return preg_replace('/\s\s+/', ' ', (string)@$_GET['q']);
    }
    /////////////////////////////////////////////////////////////////////////////

    public function get_lister_instance()
    {
        return new UsersList(
		/*$this->get_category_id(),
		$this->get_search_string()*/
	);
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function action_default()
    {
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function action_content_data()
    {
        $this->is_ajax = true;
        $questionnaires = array();
        foreach ($this->get_list() as $record)
        {
            if (isset($record['key_code']))
            {
                $record['url'] = $this->_Image->get_url_by_key_and_size((string)$record['key_code'], (string)@$_GET['size']);
            }
            unset($record['key_code']);
            $questionnaires[] = $record;
        }
        $this->Result = array(
                            'navy_pages'=> $this->get_navy_pages(),
                            'records'   => $questionnaires
                        );
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function run()
    {
        parent::run();
        $this->determine_action();
    }
    /////////////////////////////////////////////////////////////////////////////
};
