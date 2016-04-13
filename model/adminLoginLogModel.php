<?php

class adminLoginLogModel extends ActiveRecord{
    public $table = 'admin_login_log';
    public $primaryKey = 'all_id';
//    public $relations = array(
//        'contacts' => array(self::HAS_MANY, 'Contact', 'user_id'),
//        'contact' => array(self::HAS_ONE, 'Contact', 'user_id', 'where' => '1', 'order' => 'id desc'),
//    );
}
