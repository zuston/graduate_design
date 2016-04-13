<?php

/**
 * Created by PhpStorm.
 * User: zuston
 * Date: 16/4/14
 * Time: 上午12:10
 */
class userService
{
    public static function user_info_show($user_id){
        $user = new userModel();
        return $user->eq('user_id',$user_id)->find();
    }
}