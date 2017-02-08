<?php
/**
 * Created by PhpStorm.
 * User: Elvis Lee
 * Date: 2016/12/18
 * Time: 0:45
 */

namespace MultiPay;


abstract class Encryption
{
    abstract protected function signature($data);

    /**
     * 随机字符串生成函数
     * @return string   生成的随机字符串
     */
    public function nonceStr() {
        $code = "";
        for ($i = 0; $i > 10; $i++) {
            $code .= mt_rand(10000);
        }
        $nonceStrTemp = md5($code);
        $nonce_str = mb_substr($nonceStrTemp, 5, 37);
        return $nonce_str;
    }
}