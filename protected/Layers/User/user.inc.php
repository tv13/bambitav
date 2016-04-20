<?php

require_once LAYERS_DIR . '/Entity/entity_with_db.inc.php';
require_once LAYERS_DIR . '/User/purpose_dating.inc.php';
//require_once LIB_DIR . '/Mailer/sendmail.php';

class User extends EntityWithDB
{
    private $_Data = null;
    /////////////////////////////////////////////////////////////////////////////
    
    public function __construct()
    {
        parent::__construct();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function &get_all_fields_instances()
    {
        $result['id']           = new FieldInt();
        $result['email']        = new FieldString();
        $result['password']     = new FieldString();
        $result['status']       = new FieldInt();
        $result['balance']      = new FieldAmount();
        $result['name']         = new FieldString();
        $result['phone']        = new FieldString();
        $result['sex']          = new FieldString();
        $result['birthdate']    = new FieldDate();
        $result['services']     = new FieldInt();
        $result['country']      = new FieldInt();
        //$result['region']       = new FieldInt();
        $result['city']         = new FieldInt();
        $result['purpose']      = new FieldInt();
        $result['text']         = new FieldString();
        $result['size']         = new FieldInt();
        $result['height']       = new FieldInt();
        $result['weight']       = new FieldInt();
        $result['rating']       = new FieldInt();
        $result['dt_create']    = new FieldDateTime();
        $result['dt_publish']   = new FieldDateTime();
        
        $result['email']->set_max_length(255);
        $result['password']->set_max_length(20);
        $result['name']->set_max_length(50);
        $result['phone']->set_max_length(13);
        $result['sex']->set_max_length(1);
        
        return $result;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function create_child_objects()
    {
        $this->create_standart_db_handler('tm_users');
        $this->create_tuple();
        $this->DBHandler-> set_primary_key('id');
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function set_data($Data)
    {
        $this->_Data = $Data;
        return $this;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _get_data_field($field)
    {
        if (isset($this->_Data[$field]))
        {
            return trim(html_entity_decode((string)$this->_Data[$field]));
        }
        return '';
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function registration()
    {
        $user_id = $this->_create();
        /*if ($this->_send_validate_email($user_id))
        {
            throw new ExceptionProcessing(9);
        }*/
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _create()
    {
        $this->_add();
        return (int)@$this->Fields['id']->get();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function login($email, $password)
    {
        if (empty($email) || empty($password))
        {
            throw new ExceptionProcessing(21);
        }
        
        $user_id = $this->_get_user_id_by_email($email);
        if ($password == $this->get_password_by_user_id($user_id))
        {
            return $user_id;
        }
        throw new ExceptionProcessing(22);
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _send_validate_email($user_id)
    {
        $to      = $this->_get_email_by_user_id($user_id);
        $subject = 'Регистрация';
        $message = $this->_get_email_verify_body($user_id);
        $headers  = "From: webmaster@example.com\r\n" .
                    // 'Reply-To: webmaster@example.com' . "\r\n" .
                    "Content-type: text/html";
                    //'X-Mailer: PHP/' . phpversion();
        return mail($to, $subject, $message, $headers);
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _get_email_verify_body($user_id)
    {
        return '<html lang="en">
                <body>
                  <div>
                      <h3>
                              Ваш аккаунт успешно создан!
                      </h3>
                      <p>
                              Для подтверждения перейдите по
                              <a href="' . HTTP_ABS_PATH . 'email_verify.php?action=verify&code='
                              . $this->_get_email_verify_code($user_id) . '">этой ссылке</a>.
                      </p>
                      <p>
                              Ваш логин: ' . $this->_get_email_by_user_id($user_id) . '<br />
                              Ваш пароль: ' . $this->get_password_by_user_id($user_id) . '
                      </p>
                  </div>
                </body>
              </html>';
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _get_email_verify_code($user_id)
    {
        return base64_encode($user_id . '#' . $this->_get_email_by_user_id($user_id));
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _get_user_id_by_email($email)
    {
        $this->Fields['email']->set($email);
        $this->load_by_field('email');
        return @$this->Fields['id']->get();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function need_show_on_main($user_id)
    {
        return $this->_is_user_exist_by_id($user_id)
                && @$this->Fields['status']->get() > -2;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _is_user_exist_by_id($user_id)
    {
        return '' != $this->_get_email_by_user_id($user_id);
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _get_email_by_user_id($user_id)
    {
        $this->_set_user_by_id($user_id);
        return @$this->Fields['email']->get();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function get_password_by_user_id($user_id)
    {
        $this->_set_user_by_id($user_id);
        return @$this->Fields['password']->get();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function get_name_by_user_id($user_id)
    {
        $this->_set_user_by_id($user_id);
        return @$this->Fields['name']->get();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function check_email_code($code)
    {
        $decode = base64_decode($code);
        $user_id = substr($decode, 0, strpos($decode, '#'));
        return $decode == $user_id . '#' . $this->_get_email_by_user_id($user_id);
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function set_status($status)
    {
        $this->Fields['status']->set($status);
        $this->DBHandler->update();
    }
    /*/////////////////////////////////////////////////////////////////////////////
    
    private function _get_dt_create_by_id($user_id)
    {
        $this->_set_user_by_id($user_id);
        return @$this->Fields['dt_create']->get();
    }*/
    /////////////////////////////////////////////////////////////////////////////
    
    public function validate_registration_data()
    {
        $this->_validate_email($this->_get_data_field('email'));
        $this->_validate_password($this->_get_data_field('password'));
        $this->_check_password_and_confirm();
        $this->_check_user_email_not_exist();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _validate_email($email)
    {
        //if (!preg_match("/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/", $email))
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            throw new ExceptionProcessing(6);
        }
        return true;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _validate_password($password)
    {
        if (!preg_match("/^([a-z0-9_\.-]{6,20})$/", $password))
        {
            throw new ExceptionProcessing(7);
        }
        return true;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _check_password_and_confirm()
    {
        if ($this->_get_data_field('password') != $this->_get_data_field('passwordConfirm'))
        {
            throw new ExceptionProcessing(13);
        }
        return true;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _check_user_email_not_exist()
    {
        if ($this->_is_email_exist())
        {
            throw new ExceptionProcessing(8);
        }
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _is_email_exist()
    {
        return 0 != $this->_get_user_id_by_email($this->_get_data_field('email'));
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _add()
    {
        $this->Fields['email']->set($this->_get_data_field('email'));
        $this->Fields['password']->set($this->_get_data_field('password'));
        $this->Fields['status']->set(-2);
        $this->Fields['dt_create']->now();
        $this->DBHandler->insert();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function update_profile_info($user_id)
    {
        $this->_validate_update_data();
        $this->_update_profile($user_id);
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _validate_update_data()
    {
        $this->_validate_name();
        $this->_validate_birthdate();
        $this->_validate_phone();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _validate_name()
    {
        if (!preg_match("/^.{3,50}$/", $this->_get_data_field('name')))
        {
            throw new ExceptionProcessing(14);
        }
        return true;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _validate_birthdate()
    {
        if (!strtotime($this->_get_data_field('birthdate')))
        {
            throw new ExceptionProcessing(30);
        }
        
        $now_start_day = mktime(0, 0, 0, date('m') , date('d'), date('Y'));
        
        if (strtotime($this->_get_data_field('birthdate'))
                > strtotime('-'.FILTER_AGE_MIN.' years', $now_start_day))
        {
            throw new ExceptionProcessing(31);
        }
        
        if (strtotime($this->_get_data_field('birthdate'))
                <= strtotime('-'.FILTER_AGE_MAX.' years', $now_start_day))
        {
            throw new ExceptionProcessing(32);
        }
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _validate_phone()
    {
        if (!preg_match("/^(\+)?(\d){10,16}$/", $this->_get_data_field('phone')))
        {
            throw new ExceptionProcessing(15);
        }
        return true;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _update_profile($user_id)
    {
        $this->_set_user_by_id($user_id);
        $this->Fields['name']->set($this->_get_data_field('name'));
        $this->Fields['country']->set($this->_get_data_field('country'));
        //$this->Fields['region']->set($this->_get_data_field('region'));
        $this->Fields['city']->set($this->_get_data_field('city'));
        $birthtime = strtotime($this->_get_data_field('birthdate'));
        $this->Fields['birthdate']->set(date('Y-m-d', $birthtime));
        $this->Fields['sex']->set($this->_get_data_field('sex'));
        $this->Fields['phone']->set($this->_get_data_field('phone'));
        $this->Fields['purpose']->set($this->_get_data_field('purpose'));
        $this->Fields['text']->set($this->_get_data_field('text'));
        $this->Fields['status']->set(-1);
        $this->DBHandler->update();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function load_profile_info($user_id)
    {
        $this->_set_user_by_id($user_id);
        return array(
            'name'          => $this->Fields['name']->get(),
            'country'       => $this->Fields['country']->get(),
            //'region'    => $this->Fields['region']->get(),
            'city'          => $this->Fields['city']->get(),
            'birthdate'     => $this->Fields['birthdate']->get(),
            'sex'           => $this->Fields['sex']->get(),
            'phone'         => $this->Fields['phone']->get(),
            'purpose_id'    => $this->Fields['purpose']->get(),
            'purpose_text'  => PurposeDating::get_purpose_by_id($this->Fields['purpose']->get()),
            'text'          => $this->Fields['text']->get()
        );
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _validate_nick_for_create()
    {
        if ('' != $this->_get_user_account_by_nick($this->_get_data_field('nick')))
        {
            //throw new ExceptionProcessing(4);
        }
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _validate_nick_general()
    {
        if (!preg_match("/^[A-Za-z0-9_\.-]+$/", $this->_get_data_field('nick')))
        {
            //throw new ExceptionProcessing(5);
        }
        if (!preg_match("/^.{4,20}$/", $this->_get_data_field('nick')))
        {
            //throw new ExceptionProcessing(6);
        }
        return true;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    protected function _validate_age($age)
    {
        if (!is_numeric($age) || ((int)$age < 14 || (int)$age > 99))
        {
            throw new ExceptionProcessing(7);
        }
        return true;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    protected function _validate_sex($sex)
    {
        if ($sex == 'm' || $sex == 'f')
        {
            return true;
        }
        throw new ExceptionProcessing(8);
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _set_user_by_id($user_id)
    {
        $this->set_id_value($user_id);
        $this->load();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _get_photo_path($user_id)
    {
        return "static/img/$user_id.jpg";
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _get_existing_photo_path($user_id)
    {
        if (file_exists($this->_get_photo_path($user_id)))
        {
            return $this->_get_photo_path($user_id);
        }
        return "";
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function get_balance_by_user_id($user_id)
    {
        $this->_set_user_by_id($user_id);
        return @$this->Fields['balance']->get();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    /*public function set_dt_publish($user_id, $need_set_now = true)
    {
        if ($need_set_now)
        {
            $dt_publish = strftime('%Y-%m-%d %H:%M:%S');
        }
        else
        {
            $dt_publish = 0;
        }
        $this->_set_user_by_id($user_id);
        $this->Fields['dt_publish']->set($dt_publish);
        $this->update();
    }*/
    /////////////////////////////////////////////////////////////////////////////
    
    /*public function get_dt_publish($user_id)
    {
        $this->_set_user_by_id($user_id);
        return @$this->Fields['dt_publish']->get();
    }*/
    /////////////////////////////////////////////////////////////////////////////
    
    public function get_status_by_user_id($user_id)
    {
        $this->_set_user_by_id($user_id);
        return (int)@$this->Fields['status']->get();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function set_start_publish_data($user_id)
    {
        $this->_set_user_by_id($user_id);
        $this->Fields['status']->set(1);
        $this->Fields['dt_publish']->set(strftime('%Y-%m-%d %H:%M:%S'));
        $this->update();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function set_stop_publish_data($user_id, $new_balance)
    {
        $this->_set_user_by_id($user_id);
        $this->Fields['balance']->set($new_balance);
        $this->Fields['status']->set(0);
        $this->update();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function validate_data_for_send_email()
    {
        $this->_validate_email($this->_get_data_field('email_from'));
        if (empty($this->_get_data_field('text')))
        {
            throw new ExceptionProcessing(34);
        }
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function send_contact_email()
    {
        $to      = $this->_get_email_by_user_id($this->_get_data_field('user_id_to'));
        $subject = 'Сообщение от пользователя';
        $message = 'От пользователя пришло сообщение:<br />"'
                    . $this->_get_data_field('text')
                    . '"<br />Чтобы продолжить переписку, просто ответьте на это письмо. Ответ будет отправлен на адрес приславшего сообщение пользователя ('.$this->_get_data_field('email_from').')';
        $headers  = "From: bambitav\r\n" .
                    "Reply-To: " . $this->_get_data_field('email_from') . "\r\n" .
                    "Content-type: text/html";
                    //'X-Mailer: PHP/' . phpversion();
        return mail($to, $subject, $message, $headers);
    }
    /////////////////////////////////////////////////////////////////////////////
}