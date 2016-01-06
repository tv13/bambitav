<?php

class MemberAreaLogoutModel extends MainModel
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function close_promin_session()
    {
        /*
        $url = 'https://10.1.246.11:9097/ChameleonServer/UA/sessions/close/sid='
            . $this->Customer->get_session_hash_value();
        $content = file_get_contents($url);
        var_dump($content);
        die();*/
    }
    
    public function run()
    {
        #$this->close_promin_session();
        parent::run();
        $this->CustomerAuth->logout();
        throw new ExceptionProcessing(13, 1);
    }
}