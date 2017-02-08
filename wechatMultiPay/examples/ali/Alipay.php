<?php
/**
 * Created by PhpStorm.
 * User: Elvis Lee
 * Date: 2016/12/19
 * Time: 15:30
 */
header("Content-type:text/html;charset=utf8");
require_once "../../multipay.php";

// 测试数据开始
$subject = "iPhone";
$total_amount = "5688";
$out_trade_no = "201612172344562";      // 订单号，不超过64位
// 测试数据结束

// 业务参数
$bizContentArr = array(
    "timeout_express"       =>  "30m",      // 30分钟 —— 该笔订单允许的最晚付款时间，逾期将关闭交易。该参数数值不接受小数点
    "product_code"		    =>	"QUICK_MSECURITY_PAY",  // 固定值,销售产品码
    "total_amount"          =>  $total_amount,
    "subject"               =>  $subject,
    "out_trade_no"          =>  $out_trade_no,
);

// 公共参数
$data = array(
    "charset"               =>  "UTF-8",
    "timestamp"             =>  date("Y-m-d H:i:s",time()),
    "biz_content"           =>  $bizContentArr
);

$alipay = new \MultiPay\classes\alipay\Alipay();
$sign = $alipay->request($data);
echo $sign;