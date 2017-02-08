<?php
/**
 * Created by PhpStorm.
 * User: Elvis Lee
 * Date: 2016/12/16
 * Time: 15:39
 */
require_once "../../multipay.php";

// 测试数据开始
$out_trade_no = "201609241165665169";
// 测试数据结束

$query = new \MultiPay\classes\wepay\Query();
$response = $query->request($out_trade_no);

// 解析数据
$xmlTransfer = new \MultiPay\classes\wepay\XmlTransfer();
$response = $xmlTransfer->xml2Array($response);

// 业务处理
if (!empty($response))
{
    if ("SUCCESS" == $response["return_code"])
    {
        if ("SUCCESS" == $response["result_code"])
        {
        	print_r($response);
            // TODO...
            // 进行相关的业务处理
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
    else
    {
    	$ret = array(
                'status'		=>	'FAIL',
                'msg'	        =>	$response["return_msg"]
            );
        echo json_encode($ret);
    }
}