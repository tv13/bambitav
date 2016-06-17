<?php

require_once LAYERS_DIR . '/User/user.inc.php';

class MemberAreaEmailModel extends MainModel
{
    public function __construct()
    {
        parent::__construct();
        $this->check_email_code();
    }
    
    public function check_email_code()
    {
        $User = new User();
        $user_id = $User->get_user_id_by_check_email_code((string)@$_GET['code']);
        setcookie(PROJECT_NAME.'_res_check_email', $user_id, time() + 300);
        if (!$user_id)
        {
            $this->redirect_to_main();
            return;
        }
        $this->Customer->set_id($user_id);
        $this->Customer->set_name($User->get_name_by_user_id($user_id));
        $this->CustomerAuth->update_sessioned($this->Customer);
        $this->CustomerAuth->login();
        $User->set_status(0);
        $this->redirect_to_page('profile');
    }
}