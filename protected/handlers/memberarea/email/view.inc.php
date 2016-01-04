<?php

class MemberAreaEmailView extends ViewAjax
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function fill()
    {
        if ($_GET['action'] != 'verify')
        {
            $this->set_template('registration/email.tpl');
        }
        else
        {
            $this->set_template('registration/email_ok.tpl');
        }
    }
}
