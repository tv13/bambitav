<?php

class MemberAreaLogoutModel extends MainModel
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function action_default()
    {
        $this->CustomerAuth->logout();
        throw new ExceptionProcessing(23, 1);
    }
    
    public function run()
    {
        parent::run();
        $this->determine_action();
    }
}