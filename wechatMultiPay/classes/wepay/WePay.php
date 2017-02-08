<?php
/**
 * Created by PhpStorm.
 * User: Elvis Lee
 * Date: 2016/12/18
 * Time: 0:48
 */

namespace MultiPay\classes\wepay;


use MultiPay\Config;
use MultiPay\Curl;
use MultiPay\Pay;

class WePay extends Pay
{
    /**
     * 发起统一下单接口请求
     * @param $data
     * @return mixed|string
     */
    public function request($data)
    {
        // 实例化curl，设置curl属性
        $curl = new Curl();
        $curl->setIsHttps(true);
        $curl->setRequestMethod("POST");
        $curl->setUrl("https://api.mch.weixin.qq.com/pay/unifiedorder");

        // 获取传递数据
        $data = $this->serializeParams($data);
        // 发送请求并返回
        $content = $curl->request($data);
        return $content;
    }

    /**
     * 序列化XML传递数据
     * @param $data
     * @return string
     */
    protected function serializeParams($data)
    {
        // 获取参数签名对象实例
        $encpt = new WeEncryption();
        // 添加必要参数
        $params = array(
            "appid"         =>  Config::getConf("WECHAT_APPID"),
            "mch_id"        =>  Config::getConf("WECHAT_MCHID"),
            "nonce_str"     =>  $encpt->nonceStr(),
            "notify_url"    =>  Config::getConf("WECHAT_NOTIFY_URL"),
            "trade_type"    =>  Config::getConf("WECHAT_TRADE_TYPE"),
        );
        $data = array_merge($data, $params);
        // 获取签名数据
        $sign = $encpt->signature($data);
        $data["sign"] = $sign;
        // 转换成XML数据
        $xml = new XmlTransfer();
        $xmlTpl = $xml->array2XML($data);
        return $xmlTpl;
    }
}