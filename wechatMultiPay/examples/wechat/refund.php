<?php
/**
 * Created by PhpStorm.
 * User: Elvis Lee
 * Date: 2016/12/16
 * Time: 18:03
 */
require_once "../../multipay.php";

// 测试数据开始
$out_trade_no = '201609241165665169';
$out_refund_no = '201609241161654986';
$total_fee = 100;
$refund_fee = $total_fee;
// 测试数据结束

$signParams = array(
    "out_trade_no"  =>  $out_trade_no,
    "out_refund_no" =>  $out_refund_no,
    "total_fee"     =>  $total_fee,
    "refund_fee"    =>  $refund_fee
);
// 发起退款请求
$refund = new \MultiPay\classes\wepay\Refund();
$response = $refund->request($signParams);

// 解析返回数据
if ($response["return_code"] == "SUCCESS") {
    if ($response["result_code"] == "SUCCESS") {
        // TODO...
        // 相关业务处理代码
    } else {
        $errors = array(
            'status'		=>	'FAIL',
            'msg'		    =>	$response["err_code_des"]
        );
        echo json_encode($errors);
    }
}