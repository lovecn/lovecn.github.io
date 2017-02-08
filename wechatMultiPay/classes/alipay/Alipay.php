<?php
/**
 * Created by PhpStorm.
 * User: Elvis Lee
 * Date: 2016/12/19
 * Time: 13:15
 */

namespace MultiPay\classes\alipay;


use MultiPay\Config;
use MultiPay\Pay;

class Alipay extends Pay
{
    /**
     * 发起支付请求
     * @param $data
     * @return mixed
     */
    public function request($data)
    {
        // 序列化签名数据
        $data = $this->serializeParams($data);
        // 请求参数按照key=value&key=value方式拼接的未签名原始字符串
        $stringToBeSigned = implode("&", $data);
        // 获取支付参数签名
        $encpt = new AliEncryption();
        $sign = $encpt->signature($stringToBeSigned);
        // 最后对请求字符串的所有一级value（biz_content作为一个value）进行encode
        $formatArr = $this->withUrlEncode($data);
        // 按照key=value&key=value方式拼接签名字符串
        $signStr = implode("&", $formatArr);
        $sign = $signStr."&sign=".rawurlencode($sign);
        return $sign;
    }

    /**
     * 序列化原始参数
     * @param $data
     * @return string
     */
    protected function serializeParams($data)
    {
        // 添加必要参数
        $params = array(
            "app_id"        =>  Config::getConf("ALI_APPID"),
            "method"        =>  Config::getConf("ALI_PID"),
            "sign_type"     =>  "RSA",
            "version"       =>  "1.0",
            "notify_url"    =>  Config::getConf("ALI_NOTIFY_URL"),
        );
        $data = array_merge($data, $params);
        ksort($data);   // 将参数按照自然序排列
        $filterArr = [];
        foreach ($data as $k => $v) {
            if (false === empty($v) && "sign" != $k) {
                if ("biz_content" == $k) {
                    $v = json_encode($v);
                }
                // 转换成目标字符集
                $v = mb_convert_encoding($v, 'UTF-8');
                array_push($filterArr, $k."=".$v);
            }
        }
        unset ($k, $v);
        // 将参数使用&连接符连接为字符串
        return $filterArr;
    }

    /**
     * 对请求字符串的所有一级value（biz_content作为一个value）进行encode
     * @param $data
     * @return array
     */
    private function withUrlEncode($data)
    {
        $arr = [];
        ksort($data);
        foreach ($data as $key => $val)
        {
            $arr[] = $key."=".rawurlencode($val);
        }
        return $arr;
    }

    /**
     * 验证签名
     * @param $data
     * @return bool
     */
    public function verify($data) {
        // 获取sign
        $sign = $data["sign"];
        // 剔除sign、sign_type字段
        unset($data["sign"]);
        unset($data["sign_type"]);
        // 处理通知参数
        $data = $this->withUrlEncode($data);
        $beSign = implode("&", $data);
        // 验证签名
        $encpt = new AliEncryption();
        $result = $encpt->verify($beSign, $sign);
        return $result;
    }
}