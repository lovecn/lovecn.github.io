<?php
/**
 * Created by PhpStorm.
 * User: Elvis Lee
 * Date: 2016/12/18
 * Time: 1:11
 */

namespace MultiPay\classes\wepay;


use MultiPay\Config;
use MultiPay\Encryption;

class WeEncryption extends Encryption
{

    /**
     * 获取参数签名
     * @param $data
     * @return string
     */
    public function signature($data)
    {
        $stringA = $this->serialize($data);
        // 在StringA最后拼接key
        $stringSignTemp = $stringA."&key=".Config::getConf("WECHAT_KEY");
        // 对字符串进行MD5运算
        $signValue = strtoupper(md5($stringSignTemp));
        return $signValue;
    }

    /**
     * 将签名参数序列化为字符串
     * @param $data
     * @return string
     */
    private function serialize($data)
    {
        // 将参数按照自然序排列
        ksort($data);
        // 将非空参数使用URL键值对的格式拼接成字符串
        $temp = [];
        foreach ($data as $key => $val)
        {
            if (!empty($val))
            {
                $temp[] = $key.'='.$val;
            }
        }
        $stringA = implode("&", $temp);

        return $stringA;
    }

}