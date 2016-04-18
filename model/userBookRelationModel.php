<?php

class userBookRelationModel extends ActiveRecord{
    public $table = 'user_book_relation';
    public $primaryKey = 'ubr_id';
    public $relations = array(
        'belong_to' => array(self::BELONGS_TO, 'bookModel', 'book_id'),
    );
}
