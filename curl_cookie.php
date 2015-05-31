<?php


header('Content-Type: text/html; charset=utf-8');
$cookie_file = dirname(__FILE__).'/cookie.txt'; 
//$cookie_file = tempnam("tmp","cookie");
//先获取cookies并保存
$url = "http://www.google.com.hk";
$ch = curl_init($url); //初始化
curl_setopt($ch, CURLOPT_HEADER, 0); //不返回header部分
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //返回字符串，而非直接输出
curl_setopt($ch, CURLOPT_COOKIEJAR,  $cookie_file); //存储cookies
curl_exec($ch);
curl_close($ch);
//使用上面保存的cookies再次访问
$url = "http://www.google.com.hk/search?oe=utf8&ie=utf8&source=uds&hl=zh-CN&q=qq";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file); //使用上面获取的cookies
$response = curl_exec($ch);
curl_close($ch);
echo $response;

/**
 *
 * $http = new HttpClient(__DIR__.'/cookie.ck');
 * $http->SetReferer('http://foo.com');//set request referer
 * echo $http->Get('http://foo.com/');//get
 * $http->SetProxy('http://127.0.0.1:8888');//set http proxy
 * echo $http->Post('http://bar.com/xxx', array('a'=>'123', 'b'=>'456'));//post
 **/

class HttpClient{
    private $ch;

    function __construct($cookieJar){
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36');//UA
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 60);//timeout
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, TRUE);//follow redirection
        curl_setopt($this->ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, FALSE);//ssl
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($this->ch, CURLOPT_COOKIEJAR, $cookieJar);//cookie jar
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, $cookieJar);
    }

    function __destruct(){
        curl_close($this->ch);
    }

    final public function SetProxy($proxy='http://127.0.0.1:8888'){
        //curl_setopt($this->ch, CURLOPT_HTTPPROXYTUNNEL, TRUE);
        curl_setopt($this->ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);//HTTP proxy
        //curl_setopt($this->ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);//Socks5 proxy
        curl_setopt($this->ch, CURLOPT_PROXY, $proxy);
    }

    final public function SetReferer($ref=''){
        if($ref != ''){
            curl_setopt($this->ch, CURLOPT_REFERER, $ref);//Referrer
        }
    }

    final public function SetCookie($ck=''){
        if($ck != ''){
            curl_setopt($this->ch, CURLOPT_COOKIE, $ck);//Cookie
        }
    }

    final public function Get($url, $header=false, $nobody=false){
        curl_setopt($this->ch, CURLOPT_POST, false);//GET
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_HEADER, $header);//Response Header
        curl_setopt($this->ch, CURLOPT_NOBODY, $nobody);//Response Body
        return curl_exec($this->ch);
    }

    final public function Post($url, $data=array(), $header=false, $nobody=false){
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_HEADER, $header);//Response Header
        curl_setopt($this->ch, CURLOPT_NOBODY, $nobody);//Response Body
        curl_setopt($this->ch, CURLOPT_POST, true);//POST
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, http_build_query($data));//data
        return curl_exec($this->ch);
    }

    final public function getError(){
        return curl_error($this->ch);
    }
}

