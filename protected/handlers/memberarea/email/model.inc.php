<?php

require_once LAYERS_DIR . '/User/user.inc.php';

class MemberAreaEmailModel extends MainModel
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function is_code_ok()
    {
        $User = new User();
        $is_code_ok = $User->check_email_code((string)@$_GET['code']);
        if ($is_code_ok) {
            $User->set_status(0);
        }
        return $is_code_ok;
    }
}