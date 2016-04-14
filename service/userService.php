<?php

/**
 * Created by PhpStorm.
 * User: zuston
 * Date: 16/4/14
 * Time: 上午12:10
 */
class userService
{
    public static function getAllBook(){
        $bookModels = new bookModel();
        return $bookModels->findAll();
    }

    public static function verifyLogin($username,$password){
        $userModel = new userModel();
        $userModel = $userModel->eq('user_id',$username)->find();
        if($userModel==null){
            return false;
        }

        if($userModel->user_password==$password){
            Core::loginSessionState();
            return $userModel;
        }
        return false;
    }
}
