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
            Core::loginSession($userModel->user_id);
            return $userModel;
        }
        return false;
    }

    public static function getUserModelByPk($user_id){
        $userModel = new userModel();
        $userModel = $userModel->eq('user_id',$user_id)->find();
        return $userModel;
    }

    public static function getUnreturnBooks($user_id){
        $userModel = new userBookRelationModel();
        $relations = $userModel->where('user_id = '.$user_id.' and ubr_absorted=1 and ubr_due_at<'.'"'.date('Y-m-d H:i:s').'"')->findAll();

        return $relations;
    }

    public static function getRentBooks($user_id){
        $userModel = new userBookRelationModel();
        $relations = $userModel->where('user_id = '.$user_id.' and ubr_absorted=0')->findAll();
//        var_dump('ubr_absorted=1 and ubr_due_at<'.date('Y-m-d H:i:s'));exit;
        return $relations;
    }

    public static function getRendingBooks($user_id){
        $userModel = new userBookRelationModel();
        $relations = $userModel->where('user_id = '.$user_id.' and ubr_absorted=1 and ubr_due_at>'.'"'.date('Y-m-d H:i:s').'"')->findAll();
        return $relations;
    }

}
