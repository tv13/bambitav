<?php

class MemberAreaRegistrationView extends ViewTemplated
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function fill()
    {
        parent::fill();
        $this->set_template('registration/registration.tpl');
        $this->assign('email_was_sended', $this->Model->was_email_sended());
    }
}
