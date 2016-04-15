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

Flight::route('/',function(){
    if(Core::getSessionState()){
        $user_id = Core::getSessionId();
        $userModel = userService::getUserModelByPk($user_id);
        Core::render('main',$userModel);
    }else{
        Core::render('login');
    }
});


Flight::route('/main',function(){
    if(Core::getSessionState()){
        $user_id = Core::getSessionId();
        $userModel = userService::getUserModelByPk($user_id);
        Core::render('main',$userModel);
    }else{
        Flight::redirect('/');
    }
});

Flight::route('/hotbook',function(){
    $user_id = Core::getSessionId();
    $userModel = userService::getUserModelByPk($user_id);
    Core::render('hotbook',$userModel);
});

Flight::route('/returnbook',function(){
    $user_id = Core::getSessionId();
    $userModel = userService::getUserModelByPk($user_id);
    Core::render('returnbook',$userModel);
});

Flight::route('/rankbook',function(){
    $user_id = Core::getSessionId();
    $userModel = userService::getUserModelByPk($user_id);
    Core::render('rankbook',$userModel);
});

Flight::route('/userbookcount',function(){
    $user_id = Core::getSessionId();
    $userModel = userService::getUserModelByPk($user_id);
    Core::render('userbookcount',$userModel);
});

Flight::route('/login/user', function(){
    $username = Core::r('username');
    $password = Core::r('password');
    $keeplogin = Core::r('keeplogin');
    if(!isset($username)||!isset($password)){
        Flight::redirect('/');
    }
    $userModel = userService::verifyLogin($username,$password);
    if($userModel!=false){
        Core::render('main',$userModel);
    }else{
        Flight::redirect('/');
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

Flight::route('/api/search',function(){
    $xs = new XS('demo');
    $search = $xs->search;
    var_dump($search->count('hello'));
});

Flight::start();


