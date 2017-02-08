<?php
/**
 * Created by PhpStorm.
 * User: Elvis Lee
 * Date: 2016/12/19
 * Time: 16:57
 */
header("Content-type:text/html;charset=utf8");
require_once "../../multipay.php";

// 测试数据开始
$out_trade_no = "";
$refund_amount = "";
$out_trade_no = "";
$out_request_no = "";
// 测试数据结束

$biz_Content = array(
    'out_trade_no'      =>  $out_trade_no,
    'refund_amount'     =>  $refund_amount,
    'out_request_no'    =>  $out_request_no
);

$data = array(
    'format'        =>  'JSON',
    'charset'       =>  'UTF-8',
    'timestamp'     =>  date('Y-m-d H:i:s', time()),
    'biz_content'   =>  $biz_Content
);

// 实例化支付类
$alipay = new \MultiPay\classes\alipay\Alipay();
$sign = $alipay->request($data);

// 申请退款
$curl = new \MultiPay\Curl();
$curl->setUrl('https://openapi.alipay.com/gateway.do');
$curl->setIsHttps(true);
$curl->setRequestMethod("GET");
$response = $curl->request($sign);

// 处理退款结果
$retObj = json_decode($response);
// 是否申请退款成功
if ($retObj->alipay_trade_refund_response->code == "10000") {
    // 是否发生资金变化
    if ($retObj->alipay_trade_refund_response->fund_change == "Y") {
        // TODO...
    } else {
        // TODO...
    }
} else {
    // TODO...
}