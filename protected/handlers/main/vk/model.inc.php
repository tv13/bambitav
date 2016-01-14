<?php

class MainVkModel extends MainModel
{
    const VERSION = '5.5';
    /////////////////////////////////////////////////////////////////////////////
    
    public function __construct()
    {
        parent::__construct();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function action_get_countries()
    {
        $this->Result = $this->_load_data_by_url(
                'http://api.vk.com/method/database.getCountries?v=' . self::VERSION
                . '&need_all=1&count=1000');
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function action_get_regions()
    {
        $countryId = (string)@$_GET('country_id');
        $this->Result = $this->_load_data_by_url(
                'http://api.vk.com/method/database.getRegions?v=' . self::VERSION
                . '&need_all=1&offset=0&count=1000'
                . '&country_id=' . $countryId);
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function action_get_cities()
    {
        $countryId = (string)@$_GET('country_id');
        $regionId = (string)@$_GET('region_id');
        $this->Result = $this->_load_data_by_url(
                'http://api.vk.com/method/database.getCities?v=' . self::VERSION
                . '&offset=0&need_all=1&count=1000'
                . '&country_id=' . $countryId
                . (!empty($regionId) ? ('&region_id=' . $regionId) : ''));
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _load_data_by_url($url)
    {
        $this->is_ajax = true;
        $lang = 0; // russian
        $headerOptions = array(
            'http' => array(
                'method' => "GET",
                'header' => "Accept-language: en\r\n" .
                "Cookie: remixlang=$lang\r\n"
            )
        );
        $streamContext = stream_context_create($headerOptions);
        $json = file_get_contents($url, false, $streamContext);
        $arr = json_decode($json, true);
        return $arr['response']['items'];
    }
    /////////////////////////////////////////////////////////////////////////////
         
    public function action_default()
    {
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function run()
    {
        parent::run();
        $this->determine_action();
    }
    /////////////////////////////////////////////////////////////////////////////
};
