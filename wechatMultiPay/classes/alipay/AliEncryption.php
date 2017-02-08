<?php
/**
 * Created by PhpStorm.
 * User: Elvis Lee
 * Date: 2016/12/19
 * Time: 13:27
 */

namespace MultiPay\classes\alipay;


use MultiPay\Config;
use MultiPay\Encryption;

class AliEncryption extends Encryption
{
    /**
     * 订单信息签名函数
     * @param $data
     * @return string
     */
    public function signature($data)
    {
        //读取私钥文件
        $rsaPriKeyFile = Config::getConf("ALI_PRIVATE_KEY");
        $priKey = file_get_contents($rsaPriKeyFile) or die("密钥文件读取失败！");
        $res = openssl_get_privatekey($priKey);
        ($res) or die("您使用的私钥格式错误，请检查RSA私钥配置");
        // 参数签名
        openssl_sign($data, $sign, $res);
        openssl_free_key($res);
        $sign = base64_encode($sign);
        return $sign;
    }

    /**
     * 验证签名函数
     * @param $beVerify
     * @param $sign
     * @return bool
     */
    public function verify($beVerify, $sign) {
        //读取公钥文件
        $rsaPubKeyFile = Config::getConf("ALI_ALIPAY_PUBLIC_KEY");
        $pubKey = file_get_contents($rsaPubKeyFile) or die("读取公钥文件失败！");
        //转换为openssl格式密钥
        $res = openssl_get_publickey($pubKey);
        ($res) or die('支付宝RSA公钥错误。请检查公钥文件格式是否正确');
        //调用openssl内置方法验签，返回bool值
        $result = (bool)openssl_verify($beVerify, base64_decode($sign), $res, OPENSSL_ALGO_SHA1);
        openssl_free_key($res);	//释放资源
        return $result;
    }
}