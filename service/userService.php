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
        $relations = $userModel->where('user_id = '.$user_id.' and ubr_absorted in(1,2) and ubr_due_at>'.'"'.date('Y-m-d H:i:s').'"')->findAll();
        return $relations;
    }


    public static function updateUserInfo($user_id,$user_email,$user_password){
        $userModel = new userModel();
        $user = $userModel -> eq('user_id',$user_id)->find();
        $user -> user_email = $user_email;
        $user -> user_password = $user_password;
        $res = $user -> update();
        if(is_object($res)){
            return true;
        }
        return false;
    }


    public static function updateReturnBookTime($ubr_id,$timeReq){
        $addTime = 0;
        switch($timeReq){
            case 1:
                $addTime = 7;
                break;
            case 2:
                $addTime = 14;
                break;
            case 3:
                $addTime = 30;
        }
        $ubrModels = new userBookRelationModel();
        $ubrModel = $ubrModels -> eq('ubr_id',$ubr_id) -> find();
        $due_at = $ubrModel->ubr_due_at;
        $ubrModel -> ubr_due_at = date('Y-m-d H:i:s',strtotime($due_at)+$addTime*86400);
        $res = $ubrModel->update();
        if(is_object($res)){
            return true;
        }
        return false;
    }
}
