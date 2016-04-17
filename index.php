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

/**
 *xunsearch索引数据导入
 */
Flight::route('/api/xunsearch/import',function(){
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

Flight::route('/api/db/import',function(){
    $userModel = new userModel();
    $name_1 = array('殷','丁','马','黄','姜','仇','李','施','魏','许','吴','刘','周','郑');
    $name_2 = array('高','子','英','妮','豪','杰','华','帆','樊','德','级','导','硕','博','本','科','科','乐','肋','撒','但','珀');
    $name_3 = array('需','和','杰','空','看','心','信','新','路','有','录','维','为','请','落','魄','力','利','期','器','冰','宾','林','琳','临');

    $userModel -> user_name = $name_1[rand(0,count($name_1)-1)].$name_1[rand(0,count($name_2)-1)];
    $userModel -> user_email = 'jinxi32@163.com';
    $userModel -> user_password = 'shacha123';
    $userModel -> user_age = 24;
    $userModel -> user_sex = 1;
    $userModel -> user_class = 71;
    $userModel -> user_type = 1 ;
    $userModel -> user_major = 1 ;
    $userModel -> user_grade = 2012;
    $userModel -> user_academy = 1;
    $userModel -> insert();
});

Flight::start();


