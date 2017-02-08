<?php
/**
 * Created by PhpStorm.
 * User: Elvis Lee
 * Date: 2016/12/18
 * Time: 0:12
 */

class Autoloader
{
    private function __construct(){}

    /**
     * 自动加载函数
     * @param $class    将被加载的类名称
     * @throws Exception    类文件不存在是抛出异常
     */
    public static function autoload($class)
    {
        $class = str_replace("MultiPay\\", "", $class);
        $class = str_replace("classes\\", "", $class);
        $filePath = (dirname(__FILE__)."/".$class.".php");
        if (file_exists($filePath))
        {
            require_once $filePath;
        }
        else
        {
            throw new Exception("不存在的类文件:".$filePath);
        }
    }
}