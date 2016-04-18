<?php

/**
 * Created by PhpStorm.
 * User: zuston
 * Date: 16/4/18
 * Time: 下午11:59
 */
class Db
{
    public static $db = null;
    public static function getInstance()
    {
        if(self::$db==null){
            self::$db = new PDO("mysql:host=115.159.149.23;dbname=bookManage","root","shacha");
        }
        return self::$db;
    }

    public static function getRows($sql)
    {
        $res = self::$db->query($sql);
        $res->setFetchMode(PDO::FETCH_NUM); //数字索引方式
        return $res->fetchAll();
    }
}