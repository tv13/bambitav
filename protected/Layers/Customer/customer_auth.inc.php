<?php

require_once dirname(__FILE__).'/customer.inc.php';
require_once LAYERS_DIR.'/UserSession/auth.inc.php';

class CustomerAuth extends UserSessionAuth
{
    public function create_child_objects()
    {
        $this-> set_info_key('admin');
    }
    ////////////////////////////////////////////////////////////////////////////

    public function get_entity_instance()
    {
        return new Customer();
    }
    ////////////////////////////////////////////////////////////////////////////
}
