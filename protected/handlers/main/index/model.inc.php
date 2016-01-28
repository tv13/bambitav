<?php

require_once LAYERS_DIR . '/User/users_list.inc.php';

class MainIndexModel extends MainModel
{
    /////////////////////////////////////////////////////////////////////////////
    
    public function __construct()
    {
        parent::__construct();
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
        $this->Result = array(
                            'navy_pages'=> $this->get_navy_pages(),
                            'records'   => $this->get_list()
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
