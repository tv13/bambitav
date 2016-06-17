<?php

class MemberAreaEmailView extends ViewAjax
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function fill()
    {
        parent::fill();
        $this->set_template('main/index.tpl');
    }
}
