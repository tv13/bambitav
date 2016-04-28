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
        return new UsersList($_GET);
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function action_default()
    {
        $this->_set_cookie_for_get_param('country');
        $this->_set_cookie_for_get_param('city');
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _set_cookie_for_get_param($param_name)
    {
        if (isset($_GET[$param_name]) && $this->_is_natural_number(@$_GET[$param_name]))
        {
            $this->_set_cookie_by_name_time($param_name, 60); //sec
        }
        else
        {
            $this->_set_cookie_by_name_time($param_name, -1); //delete
        }
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _is_natural_number($value)
    {
        return is_numeric($value) && (int)$value == $value && (int)$value > 0;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _set_cookie_by_name_time($name, $time)
    {
        setcookie(PROJECT_NAME.'_'.$name, $_GET[$name], time() + $time);
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
    
    public function action_get_users_vk_data()
    {
        $this->is_ajax = true;
        $vk_data = array();
        foreach ($this->Lister->get_vk_data() as $value) {
            if (!$value['country'])
            {
                continue;
            }
            if (!isset($vk_data[$value['country']]))
            {
                $vk_data[$value['country']] = array($value['city']);
            }
            else
            {
                $country = $value['country'];
                if (!in_array($value['city'], $vk_data[$country]))
                {
                    $vk_data[$country][] = $value['city'];
                }
            }
        }
        $this->Result = $vk_data;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    /*public function action_get_users_vk_data()
    {
        $this->is_ajax = true;
        $vk_data = array();
        foreach ($this->Lister->get_vk_data() as $value) {
            if (!$value['country'])
            {
                continue;
            }
            if (!isset($vk_data[$value['country']]))
            {
                $vk_data[$value['country']] =
                                array(
                                    $value['region'] => $this->_get_City($value)
                                );
            }
            else
            {
                $country = $value['country'];
                $region = $value['region'];
                if (!isset($vk_data[$country][$region]))
                {
                    $vk_data[$country][$region] = $this->_get_City($value);
                }
                else
                {
                    $Region_val = $vk_data[$country][$region];
                    if (!isset($Region_val[$value['city']]))
                    {
                        $Region_val[$value['city']] = 1;
                        $vk_data[$country][$region] = $Region_val;
                    }
                }
            }
        }
        $this->Result = $vk_data;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _get_City($value)
    {
        return array(
                    $value['city']  => 1
                );
    }*/
    /////////////////////////////////////////////////////////////////////////////
    
    public function run()
    {
        parent::run();
        $this->determine_action();
    }
    /////////////////////////////////////////////////////////////////////////////
};
