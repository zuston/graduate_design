<?php
session_start();
require './extension/xunsearch/lib/XS.php';
require './extension/Flight/flight/Flight.php';
require './extension/ActiveRecord/ActiveRecord.php';

require './model/adminModel.php';
require './model/adminBookLogModel.php';
require './model/adminLoginLogModel.php';
require './model/bookModel.php';
require './model/userModel.php';
require './model/userBookRelationModel.php';
require './model/userLoginLogModel.php';
require './model/userStateLogModel.php';

require './core/Core.php';
require './core/ErrorMap.php';

require './service/userService.php';
require './service/adminService.php';
require './service/loginService.php';

//require_once './core/AutoLoad.php';

ActiveRecord::setDb(new PDO("mysql:host=localhost;dbname=bookManage","root","shacha"));

/**
 * 登录状态监测
 */
Flight::route('/main/*',function(){
    var_dump(Core::getSessionState());exit;
    if(Core::getSessionState()){
        return true;
    }else{
        Core::render('login');
    }
});

/**
 * 登录功能
 */
Flight::route('/login/user', function(){
    $username = Core::r('username');
    $password = Core::r('password');
    $keeplogin = Core::r('keeplogin');
    if(!isset($username)||!isset($password)){
        Flight::redirect('/main');
    }
    $userModel = userService::verifyLogin($username,$password);
    if(is_object($userModel)){
        Flight::redirect('/main/user/userinfo');
    }else{
        Flight::redirect('/main');
    }
});

Flight::route('/api/import',function(){
    $xs = new XS('demo');
    $doc = new XSDocument();
    $index = $xs -> index;
    $models = userService::getAllBook();
    foreach ($models as $model){
        $data = array(
            'pid' => $model->book_id,
            'book_code' => $model->book_code,
            'book_name' => $model->book_name,
            'book_author' => $model->book_author,
            'book_type' => $model->book_type,
        );
        $doc -> setFields($data);
        $index -> add($doc);
    }
    echo 2222;exit;
});

Flight::route('/main/user/userinfo',function(){
   Core::render('main');
});

Flight::route('/api/search/',function(){
    $xs = new XS('demo');
    $search = $xs->search;
    var_dump($search->count('hello'));
});

Flight::start();


