<?php

class userModel extends ActiveRecord{
    public $table = 'user';
    public $primaryKey = 'user_id';
    public $relations = array(
        'has_books' => array(self::HAS_MANY, 'userBookRelationModel', 'user_id'),
        'has_book_recent' => array(self::HAS_ONE, 'userBookRelationModel', 'user_id', 'where' => '1', 'order' => 'ubr_id desc'),
        'login_logs' => array(self::HAS_MANY, 'userStateLogModel', 'user_id'),
        'login_log_recent' => array(self::HAS_ONE,'userStateLogModel','user_id'),
    );
}
