<?php

class PurposeDating
{
    const Purposes = array(
        1 => 'Не являюсь спонсором и не ищу спонсора',
        2 => 'Являюсь спонсором',
        3 => 'Ищу спонсора'
    );
    /////////////////////////////////////////////////////////////////////////////
    
    public static function get_all_purposes()
    {
        return self::Purposes;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public static function get_purpose_by_id($id)
    {
        return self::Purposes[$id];
    }
    /////////////////////////////////////////////////////////////////////////////
}