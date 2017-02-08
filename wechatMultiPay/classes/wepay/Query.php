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

class Query
{
    /**
     * 查询订单状态
     * @param $out_trade_no
     * @return mixed|string
     */
    public function request($out_trade_no)
    {
        // 获取传递数据
        $data = $this->prepare($out_trade_no);
        $xmlTransfer = new XmlTransfer();
        $xmlString = $xmlTransfer->array2XML($data);

        // 发起请求
        $curl = new Curl();
        $curl->setUrl("https://api.mch.weixin.qq.com/pay/orderquery");
        $curl->setIsHttps(true);
        $curl->setRequestMethod("POST");
        $content = $curl->request($xmlString);
        return $content;
    }

    /**
     * 准备要请求的数据
     * @param $out_trade_no
     * @return array
     */
    private function prepare($out_trade_no)
    {
        $encpt = new WeEncryption();
        $data = array(
            "appid"         =>  Config::getConf("WECHAT_APPID"),
            "mch_id"        =>  Config::getConf("WECHAT_MCHID"),
            "out_trade_no"  =>  $out_trade_no,
            "nonce_str"     =>  $encpt->nonceStr()
        );
        $sign = $encpt->signature($data);
        $data["sign"] = $sign;
        return $data;
    }
}