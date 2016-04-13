<?php

class adminModel extends ActiveRecord{
    public $table = 'admin';
    public $primaryKey = 'admin_id';
    public $relations = array(
        'modify_books' => array(self::HAS_MANY, 'adminBookLog', 'admin_id'),
    );
}
