<?php

/**
 * Created by PhpStorm.
 * User: zuston
 * Date: 16/4/19
 * Time: 上午12:11
 */
class accountingService
{
    public static function getRowsOfRankByBookType($book_type)
    {
        Db::getInstance();
        $sql = "select * from user u,
                (select user_id,count(*) as number from user_book_relation u left join book b on u.book_id = b.book_id
                where b.book_type=".$book_type." group by `user_id` order by number desc limit 10) as p
                where u.user_id = p.`user_id` limit 6" ;
        $array_rows = Db::getRows($sql);
        return $array_rows;
    }
}
