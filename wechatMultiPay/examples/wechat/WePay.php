<?php
/**
 * Created by PhpStorm.
 * User: Elvis Lee
 * Date: 2016/12/16
 * Time: 12:56
 */
require_once "../../multipay.php";

// 测试数据开始，由客户端传递
$body = "iPhone";
$out_trade_no = "201609241165665169";
$total_fee = "15";
$spbill_create_ip = "115.28.95.67";
// 测试数据结束

$data = array(
    "body"              =>  $body,
    "out_trade_no"      =>  $out_trade_no,
    "total_fee"         =>  $total_fee,
    "spbill_create_ip"  =>  $spbill_create_ip
);

// 实例化签名类
$pay = new \MultiPay\classes\wepay\WePay();
$response = $pay->request($data);

// 解析XML数据
$xml = new \MultiPay\classes\wepay\XmlTransfer();
$response = $xml->xml2Array($response);

if (!empty($response))
{
    if ("FAIL" == $response["return_code"])
    {
        $ret = array(
            'status'		=>	'FAIL',
            'msg'	        =>	$response["return_msg"]
        );
        echo json_encode($ret);
    }
    else
    {
        if ("SUCCESS" == $response["result_code"]) {
        	$resign = array(
	            "appid"         =>  $response["appid"],
	            "partnerid"     =>  $response["mch_id"],
	            "prepayid"      =>  $response["prepay_id"],
	            "noncestr"      =>  $response["nonce_str"],
	            "timestamp"     =>  time(),
	            "package"       =>  "Sign=WXPay"
	        );
	        $encpt = new \MultiPay\classes\wepay\WeEncryption();
	        $sign = $encpt->signature($resign);
	        $resign["sign"] = $sign;
	        echo json_encode($resign);
        }
        else
        {
        	$ret = array(
                'status'		=>	'FAIL',
                'msg'	        =>	$response["err_code_des"]
            );
        	echo json_encode($ret);
        }
    }
}