<?php
/**
 * Created by PhpStorm.
 * User: zuston
 * Date: 16/4/13
 * Time: 下午11:17
 */
class ErrorMap{
    const SUCCESS = 1;
    const TEMPLATE_HTML_ERROR = 404;
    const PARAM_ERROR = 100;

    public static $error_map_msg = array(
        self::SUCCESS => '成功',
        self::TEMPLATE_HTML_ERROR => '模板不存在',
        self::PARAM_ERROR => '参数错误',
    );
}