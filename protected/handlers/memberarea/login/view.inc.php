<?php

class MemberAreaLoginView extends ViewTemplated
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function fill()
    {
        $this->set_template('admin/login.tpl');
    }
}
