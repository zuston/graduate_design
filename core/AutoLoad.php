<?php

/**
 * Created by PhpStorm.
 * User: zuston
 * Date: 16/4/14
 * Time: 上午12:36
 */
function __autoload($classname){
    var_dump($classname);
    if(is_file_exist($classname)){
        return true;
    }
    return false;
}

function is_file_exist($classname){
    $path_core = __DIR__ . '/';
    $path_model = __DIR__ . '/../model/';
    $path_service = __DIR__ . '/../service/';
    $path_view_main = __DIR__ . '/../view/';
    $path_view_layout = __DIR__ . '/../view/layout/';

    $className = $classname.'.php';
    $classTmp = $classname.'.html.php';
    $classTmpLayout = $classname.'.layout.html.php';

    $path_array = array($path_core,$path_model,$path_service,$path_view_layout,$path_view_main);
    $name_array = array($className,$classTmp,$classTmpLayout);

    foreach($path_array as $path){
        foreach($name_array as $name){
            if(file_exists($path.$name)){
                include_once $path.$name;
                return true;
            }
        }
    }
    return false;
}