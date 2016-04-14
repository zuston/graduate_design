<?php
require './extension/xunsearch/lib/XS.php';
// $xs = new XS('demo');
// $doc = $xs->search->search('项目');
// print_r($doc);exit;
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
//require_once './core/AutoLoad.php';
ActiveRecord::setDb(new PDO("mysql:host=localhost;dbname=bookManage","root","shacha"));
 Flight::route('/user/login',function(){
      if(Core::getSessionState()){
          return true;
      }else{
          return true;
      }
 });

Flight::route('/login/@verify',function($verify){
    if(Core::getSessionState()){
        return true;
    }
});

Flight::route('/login/*', function(){
    $userModel = userService::user_info_show(1);
//    $flag = Core::render('login',$userModel);
    $flag = Core::renderAll('left',array('all'=>1),'login',$userModel);
//    if($flag!=ErrorMap::SUCCESS){
//        $msg = ErrorMap::$error_map_msg[$flag];
//        Core::render('error',['errorMsg'=>$msg]);
//    }
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

Flight::route('/api/search/',function(){
    $xs = new XS('demo');
    $search = $xs->search;
    var_dump($search->count('hello'));
});

Flight::start();


