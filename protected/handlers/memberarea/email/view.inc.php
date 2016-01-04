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
        $this->set_template('registration/email.tpl');
        $this->assign('is_ok', $this->Model->is_code_ok());
    }
}
