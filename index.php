<?php
require './extension/xunsearch/lib/XS.php';
 $xs = new XS('demo');
 $doc = $xs->search->search('项目');
 print_r($doc);exit;
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

require './Core/Core.php';
require './Core/ErrorMap.php';

require './service/userService.php';

//require_once './core/AutoLoad.php';

ActiveRecord::setDb(new PDO("mysql:host=localhost;dbname=bookManage","root","shacha"));

// Flight::route('/*',function(){
//      if(Core::getSessionState()){
//          return true;
//      }else{
//          Core::render('login');
//      }
// });

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
    var_dump(import_1());
});



Flight::start();


