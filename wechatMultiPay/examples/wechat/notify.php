<?php
/**
 * Created by PhpStorm.
 * User: Elvis Lee
 * Date: 2016/12/16
 * Time: 14:51
 */
require_once "../../multipay.php";

$postXml = $GLOBALS["HTTP_RAW_POST_DATA"];	//接受通知参数；

if (empty($postXml))
{
    echo "FAIL";
    exit;
}

$xmlTransfer = new \MultiPay\classes\wepay\XmlTransfer();
$response = $xmlTransfer->xml2Array($postXml);

if (empty($response))
{
    echo "FAIL";
    exit;
}
else
{
    if (!empty($response['return_code']))
    {
        if ($response['return_code'] == 'FAIL')
        {
            echo "FAIL";
            exit;
        }
        $encpt = new \MultiPay\classes\wepay\WeEncryption();
        $data = array(
            "appid"				=>	$response["appid"],
            "mch_id"			=>	$response["mch_id"],
            "nonce_str"			=>	$response["nonce_str"],
            "result_code"		=>	$response["result_code"],
            "openid"			=>	$response["openid"],
            "trade_type"		=>	$response["trade_type"],
            "bank_type"			=>	$response["bank_type"],
            "total_fee"			=>	$response["total_fee"],
            "cash_fee"			=>	$response["cash_fee"],
            "transaction_id"	=>	$response["transaction_id"],
            "out_trade_no"		=>	$response["out_trade_no"],
            "time_end"			=>	$response["time_end"]
        );
        $sign = $encpt->signature($data);
        if ($sign = $response["sign"]) {
            $reply = array(
                "return_code"   =>  "SUCCESS",
                "return_msg"    =>  "OK"
            );
            $reply = $xmlTransfer->array2XML($reply);
            echo $reply;
            exit;
        }
        else
        {
            echo "FAIL";
            exit;
        }
    }
}