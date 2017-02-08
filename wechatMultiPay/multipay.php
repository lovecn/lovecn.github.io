<?php
/**
 * Created by PhpStorm.
 * User: Elvis Lee
 * Date: 2016/12/19
 * Time: 14:52
 */
if (!defined("MULTIPAY_PATH"))
{
    define("MULTIPAY_PATH", dirname(__FILE__));
    require_once MULTIPAY_PATH."/classes/Autoloader.php";
}

spl_autoload_register("Autoloader::autoload");