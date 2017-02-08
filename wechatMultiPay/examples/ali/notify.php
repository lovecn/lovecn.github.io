<?php
/**
 * Created by PhpStorm.
 * User: Elvis Lee
 * Date: 2016/12/19
 * Time: 16:17
 */
header("Content-type:text/html;charset=utf8");
require_once "../../multipay.php";

$response = $GLOBALS["HTTP_RAW_POST_DATA"];	//接受通知参数

if (!empty($response)) {
    // 实例化支付宝支付类
    $alipay = new \MultiPay\classes\alipay\Alipay();
    // 验证结果
    $result = $alipay->verify($response);
    if ($result) {
        echo "SUCCESS";
    }
}