<?php
$params = array(
            'notify_type'   => @$_REQUEST['notify_type'],
            'notify_id'     => @$_REQUEST['notify_id'],
            '_input_charset'=> @$_REQUEST['_input_charset'],
            'notify_time'   => @$_REQUEST['notify_time'],
            'sign'          => @$_REQUEST['sign'],
            'sign_type'     => @$_REQUEST['sign_type'],
            'version'       => @$_REQUEST['version'],
            'memo'          => @$_REQUEST['memo'],
            'error_code'    => @$_REQUEST['error_code'],
            'error_message' => @$_REQUEST['error_message'],
            'out_trade_no'  => @$_REQUEST['out_trade_no'],
            'trade_amount'  => @$_REQUEST['trade_amount'],
            'inner_trade_no'=> @$_REQUEST['inner_trade_no'],
            'fee'           => @$_REQUEST['fee'],
            'gmt_create'    => @$_REQUEST['gmt_create'],
            'gmt_payment'   => @$_REQUEST['gmt_payment'],
            'gmt_close'     => @$_REQUEST['gmt_close'],
            'trade_status'  => @$_REQUEST['trade_status'],
        );
$res = checkSignMsg($params);
function checkSignMsg($pay_params = array()) {
        $params_str = "";
        $signMsg = "";
        $return = false;
        ksort($pay_params);
        foreach ( $pay_params as $key => $val ) {
            if ($key != "sign" && $key != "sign_type" && $key != "sign_version" && ! is_null ($val) && @$val != "") {
                $params_str .= "&" . $key . "=" . $val;
            }
        }
        if ($params_str){
            $params_str = substr ($params_str, 1 );
        }

//        $cert = file_get_contents ( sinapay_rsa_sign_public_key );
        $public_key_path='rsa_sign_public.pem';
        if(file_get_contents($public_key_path)){
            $pubkeyid = openssl_pkey_get_public (file_get_contents($public_key_path));
            $ok = openssl_verify ( $params_str, base64_decode ( $pay_params ['sign'] ), file_get_contents($public_key_path), OPENSSL_ALGO_SHA1 );
            $return = ($ok == 1)?true : false;
            openssl_free_key ( $pubkeyid );

            return $return;
        }
        return false;

    }

file_put_contents('date.txt', $res);exit;





session_start();
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Shanghai');
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
require './core/Db.php';
require './service/userService.php';
require './service/adminService.php';
require './service/loginService.php';
require './service/accountingService.php';
//require_once './core/AutoLoad.php';

ActiveRecord::setDb(new PDO("mysql:host=localhost;dbname=bookManage",
    "root",
    "shacha",
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8';")
    )
);

Flight::route('/',function(){
    if(Core::getSessionState()){
        $user_id = Core::getSessionId();
        $userModel = userService::getUserModelByPk($user_id);
        Core::render('main',$userModel);
    }else{
        Core::render('login');
    }
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
        Flight::redirect('/');
    }else{
        Flight::redirect('/');
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
    $hotbooks = new userBookRelationModel();
    $models = $hotbooks -> select('count(*) as number,book_id') -> groupby('book_id') -> orderby('number desc') -> limit(0,24) -> findAll();
    Core::render('hotbook',array('userModel'=>$userModel,'hotbookModels'=>$models));
});

Flight::route('/returnbook',function(){
    $user_id = Core::getSessionId();
    $userModel = userService::getUserModelByPk($user_id);
    $unreturnModels = userService::getUnreturnBooks($user_id);
    $rendingModels = userService::getRendingBooks($user_id);
    $rentModels = userService::getRentBooks($user_id);
    Core::render('returnbook',array('userModel'=>$userModel,'unreturnModels'=>$unreturnModels,'rendingModels'=>$rendingModels,'rentModels'=>$rentModels));
});

Flight::route('/rankbook',function(){
    $user_id = Core::getSessionId();
    $userModel = userService::getUserModelByPk($user_id);
    for($i=0;$i<6;$i++){
        $row[$i] = accountingService::getRowsOfRankByBookType($i+1);
    }
    Core::render('rankbook',array('userModel'=>$userModel,'rows'=>$row));
});

Flight::route('/userbookcount',function(){
    $user_id = Core::getSessionId();
    $userModel = userService::getUserModelByPk($user_id);
    Core::render('userbookcount',$userModel);
});
Flight::route('/search',function(){
    Core::render('search');
});






//===============================================================
//以下为数据填充测试api
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

Flight::route('/api/db/import/user',function(){
    $userModel = new userModel();
    $name_1 = array('殷','丁','马','黄','姜','仇','李','施','魏','许','吴','刘','周','郑','董','欧阳','慕容');
    $name_2 = array('俊','军','英','妮','豪','杰','华','帆','樊','德','美','萍','硕','博','本','华','科','乐','敏','丹','君','超','朝');
    $name_3 = array('犇','向','杰','权','圆','欣','冉','新','洋','阳','桐','彤','志','伊','子','康','颖','黎','晨','冰','宾','林','琳','临');

//    $userModel -> user_name = $name_1[rand(0,count($name_1)-1)].$name_1[rand(0,count($name_2)-1)];
//    $userModel -> user_email = 'jinxi32@163.com';
//    $userModel -> user_password = 'shacha123';
//    $userModel -> user_age = 24;
//    $userModel -> user_sex = 1;
//    $userModel -> user_class = 71;
//    $userModel -> user_type = 1 ;
//    $userModel -> user_major = 1 ;
//    $userModel -> user_grade = 2012;
//    $userModel -> user_academy = 1;
//    $userModel -> insert();
    $sql = '';
    for($i=0;$i<50;$i++) {
        $name_rand_3 = rand(0,1)?'"':$name_3[rand(0,count($name_3)-1)].'"';
        $user_name = '"' . $name_1[rand(0, count($name_1) - 1)] . $name_2[rand(0, count($name_2) - 1)].$name_rand_3;
        $user_grade = rand(2012,2015);
        $user_academy = rand(1,10);
        $user_major = rand(1,20);
        $user_type = 1;
        $user_sex = rand(0,1);
        $user_class = rand(1,9).rand(1,2);
        $user_age = 24-($user_grade-2012);
//        $db .= '('.$user_name.',"jinxi32@163.com","shacha123",24,'.$user_sex.','$user_class',1,{$user_major},{$user_grade},{$user_academy}),';
//        $db .= '('.$user_name.',jinxi32@163.com,shacha123,24,'.$user_sex.','.$user_class.','.$user_type.','.$user_major.','.$user_grade.','.$user_academy.'),';
        $sql .=sprintf('(%s,"jinxi32@163.com","shacha123",%d,%d,%d,%d,%d,%d,%d),',$user_name,$user_age,$user_sex,$user_class,$user_type,$user_major,$user_grade,$user_academy);
    }
    $sql_prefix ='insert into user(user_name,user_email,user_password,user_age,user_sex,user_class,user_type,user_major,user_grade,user_academy) values ';
    echo $sql_prefix.$sql;


});

Flight::route('/api/db/import/user_relation',function(){
    $sql = '';
    for($i=0;$i<2000;$i++){
        $user_id = rand(1,806);
        $book_id = rand(1,824);
        $ubr_due_at = '"2016-05-20 00:00:00"';
        $ubr_absorted = rand(0,1);
        $sql .= sprintf('(%d,%d,%s,%d),',$user_id,$book_id,$ubr_due_at,$ubr_absorted);
    }
    $sql = 'insert into user_book_relation(user_id,book_id,ubr_due_at,ubr_absorted) values'.$sql;
    echo $sql;exit;
});

Flight::start();


