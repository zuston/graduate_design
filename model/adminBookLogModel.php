<?php

class adminBookLogModel extends ActiveRecord{
    public $table = 'admin_book_log';
    public $primaryKey = 'abl_id';
//    public $relations = array(
//        'contacts' => array(self::HAS_MANY, 'Contact', 'user_id'),
//        'contact' => array(self::HAS_ONE, 'Contact', 'user_id', 'where' => '1', 'order' => 'id desc'),
//    );
}
