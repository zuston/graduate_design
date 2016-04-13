<?php

class bookModel extends ActiveRecord{
    public $table = 'book';
    public $primaryKey = 'book_id';
    public $relations = array(
        'rent_to' => array(self::HAS_MANY, 'userBookRelation', 'book_id'),
    );
}
