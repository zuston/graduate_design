<?php

/**
 * Created by PhpStorm.
 * User: zuston
 * Date: 16/4/10
 * Time: 下午8:21
 */
class Core
{
    /**
     * @param $filename
     * @param null $array
     * @return int
     * 渲染整页
     */
    public static function render($filename, $array = null)
    {
        $filepath = '../view/';
        $filenamePath = $filename . '.html.php';
        if (!file_exists(__DIR__ . '/' . $filepath . $filenamePath)) {
            return ErrorMap::TEMPLATE_HTML_ERROR;
        }

        if (is_array($array)) {
            extract($array);
        }
        if (is_object($array)) {
            $array_object = (array)$array;
            $array_data = $array_object['data'];
            extract($array_data);
        }
        require_once __DIR__ . '/' . $filepath . $filenamePath;
        return ErrorMap::SUCCESS;
    }

    /**
     * @param $layoutFilename
     * @param $layout_array
     * @param $filename
     * @param $array
     * @return int
     * 渲染有部分页面
     */
    public static function renderAll($layoutFilename, $layout_array, $filename, $array)
    {
        $layoutFilePath = __DIR__ . '/../view/layout/';
        $mainFilePath = __DIR__ . '/../view/';
        if (!file_exists($layoutFilePath . $layoutFilename . '.layout.html.php') || !file_exists($mainFilePath . $filename . '.html.php')) {

            return ErrorMap::TEMPLATE_HTML_ERROR;
        }
        if (is_array($layout_array)) {

            extract($layout_array);
        }
        if (is_array($array)) {
            extract($array);
        }
        if(is_object($layout_array)){
            $layout_array_object = array($layout_array);
            $layout_array_data = $layout_array_object['data'];
            extract($layout_array_data);
        }
        if (is_object($array)) {
            $array_object = (array)$array;
            $array_data = $array_object['data'];
            extract($array_data);
        }

        require_once $layoutFilePath . $layoutFilename . '.layout.html.php';
        require_once $mainFilePath . $filename . '.html.php';
        return ErrorMap::SUCCESS;
    }

    public static function r($key){
        if(!empty($_REQUEST[$key])){
            return $_REQUEST[$key];
        }
        return false;
    }

    public static function loginSessionState(){
        $_SESSION['state'] = 1;
    }

    public static function logoutSessionState(){
        $_SESSION['state'] = 0;
    }

    public static function getSessionState(){
        if(empty($_SESSION['state'])){
            return false;
        }
        return ($_SESSION['state'])?true:false;
    }

}



