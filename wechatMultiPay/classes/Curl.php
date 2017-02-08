<?php
/**
 * Created by PhpStorm.
 * User: Elvis Lee
 * Date: 2016/12/18
 * Time: 0:29
 */

namespace MultiPay;


class Curl
{
    private $ch;
    private $isHttps = false;
    private $requestMethod = "GET";
    private $cert = false;
    private $url = "";

    public function __construct()
    {
        $this->ch = curl_init();
    }

    /**
     * @param boolean $isHttps
     */
    public function setIsHttps($isHttps)
    {
        if (is_bool($isHttps))
        {
            $this->isHttps = $isHttps;
        }
    }

    /**
     * @param string $requestMethod
     */
    public function setRequestMethod($requestMethod)
    {
        if (is_string($requestMethod))
        {
            $this->requestMethod = $requestMethod;
        }
    }

    /**
     * @param boolean $cert
     */
    public function setCert($cert)
    {
        if (is_bool($cert))
        {
            $this->cert = $cert;
        }
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * 设置curl属性
     * @param $data     发送数据
     */
    private function prepare($data)
    {
        curl_setopt($this->ch, CURLOPT_URL, $this -> url);
        curl_setopt($this->ch, CURLOPT_HEADER, 0);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        if ($this->isHttps) {
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 2);
        }

        if($this->cert == true){
            //设置证书
            //使用证书：cert 与 key 分别属于两个.pem文件
            curl_setopt($this->ch,CURLOPT_SSLCERTTYPE,'PEM');
            curl_setopt($this->ch,CURLOPT_SSLCERT, Config::getConf("WECHAT_SSLCERT_PATH"));
            curl_setopt($this->ch,CURLOPT_SSLKEYTYPE,'PEM');
            curl_setopt($this->ch,CURLOPT_SSLKEY, Config::getConf("WECHAT_SSLKEY_PATH"));
        }

        if (!empty($data)) {
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
        }

        if ($this->requestMethod == 'POST') {
            curl_setopt($this->ch, CURLOPT_POST, true);
        }
    }

    /**
     * 发送请求
     * @param $data
     * @return mixed|string
     */
    public function request($data)
    {
        $this->prepare($data);
        $content = curl_exec($this->ch);
        $this->close();
        if (!empty($content)) {
            return $content;
        } else {
            return curl_error($this->ch);
        }
    }

    /**
     * 关闭一个curl
     */
    private function close(){
        curl_close($this -> ch);
    }
}