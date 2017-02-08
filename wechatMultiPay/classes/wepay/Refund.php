<?php
/**
 * Created by PhpStorm.
 * User: Elvis Lee
 * Date: 2016/12/18
 * Time: 1:29
 */

namespace MultiPay\classes\wepay;


use MultiPay\Config;
use MultiPay\Curl;

class Refund
{
    /**
     * 发送退款请求
     * @param $data
     * @return mixed
     */
    public function request($data)
    {
        // 准备发送数据
        $data = $this->prepare($data);
        // 转换成XML数据
        $xmlTransfer = new XmlTransfer();
        $xml = $xmlTransfer->array2XML($data);
        // 准备发送请求
        $curl = new Curl();
        $curl->setIsHttps(true);
        $curl->setRequestMethod("POST");
        $curl->setCert(true);
        $curl->setUrl("https://api.mch.weixin.qq.com/secapi/pay/refund");
        $content = $curl->request($xml);
        return $content;
    }

    /**
     * 准备发起退款申请的参数
     * @param $data
     * @return mixed
     */
    private function prepare($data)
    {
        $encpt = new WeEncryption();
        $params = array(
            "appid"         =>  Config::getConf("WECHAT_APPID"),
            "mch_id"        =>  Config::getConf("WECHAT_MCHID"),
            "nonce_str"     =>  $encpt->nonceStr(),
            "op_user_id"    =>  Config::getConf("WECHAT_MCHID")
        );
        $data = array_merge($data, $params);
        // 获取参数签名
        $sign = $encpt->signature($data);
        $data["sign"] = $sign;
        return $data;
    }
}