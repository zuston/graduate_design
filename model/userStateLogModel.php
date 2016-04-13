<?php

class userStateLogModel extends ActiveRecord{
    public $table = 'user_state_log';
    public $primaryKey = 'usl_id';
//    public $relations = array(
//        'contacts' => array(self::HAS_MANY, 'Contact', 'user_id'),
//        'contact' => array(self::HAS_ONE, 'Contact', 'user_id', 'where' => '1', 'order' => 'id desc'),
//    );
}
