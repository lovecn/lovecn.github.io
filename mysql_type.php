 
<a href="../test.mp4" download='test'>下载</a>



 <script type="text/javascript" src="../alphabetJS/src/alphabet.min.js"></script>
<script type="text/javascript">
     console.log(Alphabet('LJB23','stereo'));//https://github.com/starkwang/alphabetJS

</script>
mysql> SELECT '18015376320243458' = 18015376320243458;
        -> 1
mysql> SELECT '18015376320243459' = 18015376320243459;
        -> 0
        mysql> SELECT 1 > '6x';
        -> 0
mysql> SELECT 7 > '6x';
        -> 1
mysql> SELECT 0 > 'x6';
        -> 0
mysql> SELECT 0 = 'x6';
        -> 1
        mysql> SELECT 1 = '1a';
+----------+
| 1 = '1a' |
+----------+
|        1 |
+----------+

<canvas id="myCanvas" width="1000" height="500" >
Your browser does not support the HTML5 canvas tag.
</canvas>
<script>
    //准备img对象 http://segmentfault.com/a/1190000003963759
    var img = new Image();   
    img.src = 'jay.jpg';
 
    // 加载完成开始绘制
    img.onload=function(){
       //准备canvas环境 
       var canvas=document.getElementById("myCanvas");
       var ctx=canvas.getContext("2d");
       // 绘制图片
       ctx.drawImage(img,0,0);
       // 绘制水印
       ctx.font="20px microsoft yahei";
       ctx.fillStyle = "rgba(255,255,255,0.5)";
       ctx.fillText("杰伦",100,100);
    }
</script>

<?php
$xml = "<xml><appid><![CDATA[wxe3XXXXXX]]></appid><bank_type><![CDATA[CFT]]></bank_type><cash_fee><![CDATA[1]]></cash_fee><fee_type><![CDATA[CNY]]></fee_type><is_subscribe><![CDATA[N]]></is_subscribe><mch_id><![CDATA[123XXXXXXX]]></mch_id><nonce_str><![CDATA[a6AsJ6zdNgZW7y85syNRYxUkbtzogjxl]]></nonce_str><openid><![CDATA[oE8YOs0rCPiIqmHdaJsRCxVV5KQ4]]></openid><out_trade_no><![CDATA[14461162406602]]></out_trade_no><result_code><![CDATA[SUCCESS]]></result_code><return_code><![CDATA[SUCCESS]]></return_code><sign><![CDATA[F189A6BA55EF1D10274EF8B4B3F96A26]]></sign><time_end><![CDATA[20151029185727]]></time_end><total_fee>1</total_fee><trade_type><![CDATA[APP]]></trade_type><transaction_id><![CDATA[1007530905201510291380290922]]></transaction_id></xml>";//var_dump(simplexml_load_string($xml));
libxml_disable_entity_loader(true);
        $data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);var_dump($data);
/*http://segmentfault.com/q/1010000002957162 mysql为int类型的字段php取出来之后为何变为string类型
create table test(
    c1 int, 
    c2 float, 
    c3 float(10,2), 
    c4 double, 
    c5 double(10,2), 
    c6 decimal(10,2), 
    PRIMARY KEY (c1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
insert into test values(32.10, 32.10, 32.10, 32.10, 32.10, 32.10);
insert into test values(43.21, 43.21, 43.21, 43.21, 43.21, 43.21);
insert into test values(9876543.21, 9876543.21, 9876543.21, 9876543.21, 9876543.21, 9876543.21);
select * from test;
+---------+---------+------------+------------+------------+------------+
| c1      | c2      | c3         | c4         | c5         | c6         |
+---------+---------+------------+------------+------------+------------+
|      32 |    32.1 |      32.10 |       32.1 |      32.10 |      32.10 |
|      43 |   43.21 |      43.21 |      43.21 |      43.21 |      43.21 |
| 9876543 | 9876540 | 9876543.00 | 9876543.21 | 9876543.21 | 9876543.21 |
+---------+---------+------------+------------+------------+------------+
 */echo '<pre>';
//运行时设置错误处理http://segmentfault.com/a/1190000003946479
// ini_set('display_errors','off');
// ini_set('error_log','D:\soft\error.txt');
//设置错误输出
error_reporting(-1);
echo $test; //NOTICE
print_r(error_get_last());
error_log ( "You messed up!" ,  3 ,  "D:\soft\error.txt" );
// http://www.cnblogs.com/tinyphp/p/3513459.html 概率算法函数：
// 这样一个数组：a奖概率20%，b奖概率30%，c奖概率50%
/*
总概率精度为20+30+50=100

第一次数组循环，$procur=20

假设抽取的随机数rand(1,100)，假设抽到$randNum=55

if判断-------

如果$randNum<=20,则result=a

否则进入下一循环，总概率精度变为100-20=80

 


第二次数组循环，$procur=30

假设抽取的随机数rand(1,80)，假设抽到$randNum=33

if判断---------

如果$randNum<=30,则result=b

否则进入下一循环，总概率精度变为80-30=50


第三次数组循环，$prosur=50;

假设抽取的随机数rand(1,50)，不管怎么抽，随机数都会<或=50，

那么得出result=c;

select count(*) from users a ,user_thirds b where a.id=b.user_id and b.type=3 and a.reg_type=1 and a.updated_at > '2015-10-11 00:00:00';
select count(*) from users a ,user_thirds b where a.id=b.user_id and b.type=3 and a.reg_type=2 and a.updated_at > '2015-10-11 00:00:00';
select count(*) from users a ,user_thirds b where a.id=b.user_id and b.type=2 and a.reg_type=1 and a.updated_at 


 */
// 

$appid = '999';
$secret = '9999';
/*$token = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$secret);
$token = json_decode($token,1);print_r($token);
$openid = 'oE8YOs9qaCO3cAwIaHX6C34eU9-0';//oE8YOs9qaCO3cAwIaHX6C34eU9-0
$union_id= file_get_contents('https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$token['access_token'].'&openid='.$openid.'&lang=zh_CN');//o7n6xt2FaQ9cg0H0of8lqs3arfY0 
print_r($union_id);*/

$prize_arr =array('a'=>20,'b'=>30,'c'=>50);
function get_rand($proArr) { 
    $result = ''; $num=0;
    //概率数组的总概率精度 
    $proSum = array_sum($proArr); 
    //概率数组循环  每次循环$proSum用上次的
    foreach ($proArr as $key => $proCur) {echo '数组'; var_dump($proSum);echo '数字';echo $num;
        $randNum = mt_rand(1, $proSum);             //抽取随机数
        if ($randNum <= $proCur) { 
            $result = $key;                      //得出结果
            break; 
        } else {
            $proSum -= $proCur;echo '循环';var_dump($proSum);
        } $num++;
    } 
    unset ($proArr); 
    return $result; 
}
print_r(get_rand($prize_arr));print_r(get_rand2($prize_arr)); 
function get_rand2($arr)
    {
        $pro_sum=array_sum($arr);
        $rand_num=mt_rand(1,$pro_sum);
        $tmp_num=0;
        foreach($arr as $k=>$val)
        {    
            if($rand_num<=$val+$tmp_num)
            {
                $n=$k;
                break;
            }else
            {
                $tmp_num+=$val;
            }
        }
        return $n;
    }
// 二维数组根据key去重
    function assoc_unique(&$arr, $key,$key2='') { 
        $res=array();
        for($i=0;$i<count($arr);$i++) {
            $k = empty($key2)?$arr[$i][$key]:$arr[$i][$key].$arr[$i][$key2];
            if(!isset($res[$k])) { 
                $res[$k] = $arr[$i];
                $res[$k]['num'] = $arr[$i]['fee'];
            }else{
                $res[$k] = $arr[$i];
                $res[$k]['num'] += $arr[$i]['fee'];
            }
        }
        print_r($res);
        $arr=array_values($res);
    }

 $arr=[
     ['id'=>1,'name'=>'php','num'=>3],
     ['id'=>2,'name'=>'js','num'=>1],
     ['id'=>1,'name'=>'php','num'=>2],
     ['id'=>3,'name'=>'python','num'=>2],
 ];
 $result = [];
foreach ($arr as $v) {
    if (isset($result[$v['id']])) {
        $result[$v['id']]['num'] += $v['num'];
    }
    else {
        $result[$v['id']] = $v;
    }
}
$s = '满100减50';//把100和50抽离出来   
preg_match_all('/(\D+)(\d+)/', $s, $r); 
$t = array_combine($r[1], $r[2]);  
 print_r($t);
// PHP实现各种排序算法http://be-evil.org/post-109.html
// echo trigger_error('数值必须为整型！',E_USER_ERROR); 
  for($i=1;$i<=9;$i++){
   for($j=1;$j<=$i;$j++){
     echo '$i*$j='.$i*$j;
  }echo '<br>';
}
  for($i=1;$i<=9;$i++){
    for($j=1;$j<=9;$j++){
        if($j<=$i){
            echo $j."*".$i." = ".$i*$j." ";
        }
    }
    echo "<br/>";
}
for($i = 1;$i <= 9; $i++){
    for($j = 1;$j <= $i; $j++){
        echo $j."*".$i."=".$j*$i;
    }
    echo "<br />";
}
print_r($result);die;
// assoc_unique($arr,'id');

function gen() {
    $tid = (yield 1 + 1); 
    for ($i = 1; $i <= 10; ++$i) {
        echo "This is $tid task iteration $i.\n";
        yield $i;
    }
}
// http://jamlee.cn/2015/10/31/php-%E7%94%A8yield%E5%AE%9E%E7%8E%B0%E5%BC%82%E6%AD%A5web-server/
//$t1是[generator](http://php.net/manual/en/class.generator.php)类的实例(instance)
$t1 = gen();
//取出yield后面的表达式的结构，并没有进行赋值就暂停了当前的操作 `$tid = (yield 1 + 1) `，（特性一：中断点)
$r1 = $t1->current(); 
//结果为 2 
echo $r1; 
//将字符'+++'（特性二：占位符)，替换到刚才暂停的地方 `$tid = '+++++'`，并进入for循环，遇见yield表达式，获取yield 表达式后面的值，并保存当前的局部变量的值，yield后面是$i，返回$i
var_dump($t1->send('+++')); 
// 城市列表
$res = file_get_contents('http://api.youshishuohua.com/api/get_base_citys');

// print_r(json_decode($res,1));
$f = 0.58;    var_dump(intval($f * 100)); //为啥输出57 0.58 * 100 = 57.999999999
$a = 0.1;
$b = 0.7;
var_dump(($a + $b) == 0.8);var_dump(bcadd($a,$b,2) == 0.8);
var_dump(bccomp($left=4.45, $right=5.54, 2));//-1 关于设置的位数，超出部分是丢弃掉，而不是四舍五入
var_dump(bcadd($left=1.0321456, $right=0.0243456, 2));//1.05
/*
不可能精确的用有限位数表达某些十进制分数。例如，十进制的 1/3 变成了 0.3333333. . .。
　　所以永远不要相信浮点数结果精确到了最后一位，也永远不要比较两个浮点数是否相等。如果确实需要更高的精度，应该使用任意精度数学函数或者 gmp 函数
 */
// 打印log
    function  log_result($file,$word) 
    {
        $fp = fopen($file,"a");
        flock($fp, LOCK_EX) ;
        fwrite($fp,"执行日期：".strftime("%Y-%m-%d-%H：%M：%S",time())."\n".$word."\n\n");
        flock($fp, LOCK_UN);
        fclose($fp);
    }
/**
     *  作用：产生随机字符串，不长于32位
     */
      function createNoncestr( $length = 32 ) 
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";  
        $str ="";
        for ( $i = 0; $i < $length; $i++ )  {  
            $str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
        }  
        return $str;
    }
    /**
     *  作用：array转xml
     */
    function arrayToXml($arr)
    {
        $xml = "<xml>";
        foreach ($arr as $key=>$val)
        {
             if (is_numeric($val))
             {
                $xml.="<".$key.">".$val."</".$key.">"; 

             }
             else
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";  
        }
        $xml.="</xml>";
        return $xml; 
    }
    
    /**
     *  作用：将xml转为array
     */
     function xmlToArray($xml)
    {       
        //将XML转为array        
        $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);      
        return $array_data;
    }

    /**
     *  作用：以post方式提交xml到对应的接口url
     */
     function postXmlCurl($xml,$url,$second=30)
    {       
        //初始化curl        
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        //这里设置代理，如果有的话
        //curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');
        //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        //运行curl
        $data = curl_exec($ch);
        //返回结果
        if($data)
        {
            curl_close($ch);
            return $data;
        }
        else 
        { 
            $error = curl_errno($ch);
            echo "curl出错，错误码:$error"."<br>"; 
            echo "<a href='http://curl.haxx.se/libcurl/c/libcurl-errors.html'>错误原因查询</a></br>";
            curl_close($ch);
            return false;
        }
    }
$redis = new Redis(); 
$redis->connect('127.0.0.1', 6379);
/*while(TRUE) {
    $t = $redis->lpop('list:queue');
    sleep(12);
    print_r(json_decode($t,1));
}*/
// A fast HTTP interface for Redis  http://webd.is/#http
   // {'tpl':'emails.active':'data':{$data},:'email':'123','subject':'you'}         
$a = "{id:43015,name:'John Doe',level:15,systems:[{t:6,glr:1242,n:'server',s:185,c:988}],classs:0,subclass:5}";
var_dump(my_json_decode($a));
function my_json_decode($s) {
    $s = str_replace(
        array('"',  "'"),
        array('\"', '"'),
        $s
    );
    $s = preg_replace('/(\w+):/i', '"\1":', $s);
    return json_decode(sprintf('{%s}', $s));
}
// http://stackoverflow.com/questions/1575198/invalid-json-parsing-using-php/1575315#1575315
$a = preg_replace('/(,|\{)[ \t\n]*(\w+)[ ]*:[ ]*/','$1"$2":',$a);
$a = preg_replace('/":\'?([^\[\]\{\}]*?)\'?[ \n\t]*(,"|\}$|\]$|\}\]|\]\}|\}|\])/','":"$1"$2',$a);
var_dump(json_decode($a,1));
$dsn = "mysql:dbname=test;host=localhost;port=3306;charset=utf8";
try {
    $dbh = @new PDO($dsn, 'test', '', array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_EMULATE_PREPARES => false, //注意这里true全部转为string
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ));
} catch (PDOException $e) {
    echo $e->getMessage();
    exit();
}
$sth = $dbh->query('SELECT * FROM test');
$arr = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth = null;
$dbh = null;
var_dump($arr);

/*无论PDO::ATTR_EMULATE_PREPARES设为false还是true,
decimal(10,2)的类型都是string,输出的数据是正确的.
不模拟预处理时(false),能保持数据类型,但某些类型,输出的数据跟数据库里的数据不一致,比如上面的float.
MySQLi查询返回的字段类型也都是string.
所以说返回string类型给程序是安全的*/
preg_match_all('/./us', 'php是最好的语言', $arr);
var_dump($arr);
 $arr = preg_split('//u','php是最好的语言',-1,PREG_SPLIT_NO_EMPTY);var_dump($arr);
// 使用php的shared memory的shmop_*前缀的API来实现一个简单的缓存接口http://segmentfault.com/a/1190000003872583
// https://github.com/bephp/utils/blob/master/utils.php
function cache($key, $val=null, $expire=100) {
      static $_caches = null;
      static $_shm = null;
      if ( null === $_shm ) $_shm = @shmop_open(crc32('mcache.solt'),    
          'c', 0755, config('cache.size', null, 10485760));
      if ( null === $_caches && $_shm && ($size = intval(shmop_read($_shm, 0, 10))))
          $_caches = $size ? @unserialize(@shmop_read($_shm, 10, $size)) : array();
      if (($time = time()) && $val && $expire){
          $_caches[$key] = array($time + intval($expire), $val);
          if($_shm && ($size = @shmop_write($_shm, serialize(array_filter($_caches, function($n)use($time){return $n[0] > $time;})), 10)))
              @shmop_write($_shm, sprintf('%10d', $size), 0);
          return $val;
      }
      return (isset($_caches[$key]) && $_caches[$key][0] > $time) ? $_caches[$key][1] : null;
  }

   function shmcache($key, $val=null, $expire=100) {
     static $_shm = null;
     if ( null === $_shm ) $_shm = @shm_attach(crc32(config('mcache.solt', null, 'mcac  he.solt')),
         config('cache.size', null, 10485760), 0755);
     if (($time = time()) && ($k = crc32($key)) && $val && $expire){
         shm_put_var($_shm, $k, array($time + $expire, $val));
         return $val;
     }
     return shm_has_var($_shm, $k) && ($data = shm_get_var($_shm, $k)) && $data[0] >   $time ? $data[1] : null;
 }
echo real_ip();//在PHP的$_SERVER变量中，凡是以HTTP_开头的键值都是直接从客户端的HTTP请求头中直接解析出来的。
/*首选REMOTE_ADDR，因为虽然有如此多地伪造方法，但在语言层面你只能选一个最可靠地。
如果你地服务隐藏在负载均衡或者缓存系统后面，它通常会给你发一个Client-Ip或者X-Forwarded-For的HTTP头，告诉你跟它连接的客户端ip，这时的HTTP_CLIENT_IP和HTTP_X_FORWARDED_FOR是可信的，因为它是从前端服务器上的直接传递过来的，当然你必须在程序中指定只信任这一个来源，而不要像最开始的代码那样每个都检测一遍http://segmentfault.com/a/1190000000720446*/ 

echo $_SERVER['REMOTE_ADDR'];
// UPDATE `members` SET `headimg` = (select `path` from `rand_picture` order by rand()) 
// 如何把B表中的字段随机的插入到A表中http://segmentfault.com/q/1010000002925145
// UPDATE `members` SET `headimg` = (select `path` from `rand_picture`limit FLOOR(1 + RAND() * (select count(1) from `rand_picture`)), 1)
// (selectpathfromrand_picturelimit FLOOR(1 + RAND() * (select count(1) fromrand_picture)), 1) 会出现Undeclared variable: FLOOR ,后来我将子句改成了 order by rand() limit 1,成功了
 function real_ip()
{
    static $realip = NULL;

    if ($realip !== NULL)
    {
        return $realip;
    }

    if (isset($_SERVER))
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

            /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
            foreach ($arr AS $ip)
            {
                $ip = trim($ip);

                if ($ip != 'unknown')
                {
                    $realip = $ip;

                    break;
                }
            }
        }
        elseif (isset($_SERVER['HTTP_CLIENT_IP']))
        {
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        }
        else
        {
            if (isset($_SERVER['REMOTE_ADDR']))
            {
                $realip = $_SERVER['REMOTE_ADDR'];
            }
            else
            {
                $realip = '0.0.0.0';
            }
        }
    }
    else
    {
        if (getenv('HTTP_X_FORWARDED_FOR'))
        {
            $realip = getenv('HTTP_X_FORWARDED_FOR');
        }
        elseif (getenv('HTTP_CLIENT_IP'))
        {
            $realip = getenv('HTTP_CLIENT_IP');
        }
        else
        {
            $realip = getenv('REMOTE_ADDR');
        }
    }

    preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
    $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';

    return $realip;
}
echo '<pre>';
$s = '[{\\&quot;table\\&quot;:\\&quot;a\\&quot;,\\&quot;field\\&quot;:\\&quot;value\\&quot;,\\&quot;max\\&quot;:60,\\&quot;min\\&quot;:null}]';
echo $s = html_entity_decode($s);
// $s = stripslashes($s);
 $s=str_replace('\\','',$s);
print_r(json_decode($s, 1));
 // http://bbs.csdn.net/topics/390828834 看了base64的编码和解码知道了，要用两次html_entity_decode才行
// echo base64_encode($_POST['json']);
$s = 'W3tcXCZhbXA7cXVvdDt0YWJsZVxcJmFtcDtxdW90OzpcXCZhbXA7cXVvdDtlcHFcXCZhbXA7cXVvdDssXFwmYW1wO3F1b3Q7ZmllbGRcXCZhbXA7cXVvdDs6XFwmYW1wO3F1b3Q7c3RhbmQ0XFwmYW1wO3F1b3Q7LFxcJmFtcDtxdW90O21heFxcJmFtcDtxdW90Ozo2MCxcXCZhbXA7cXVvdDttaW5cXCZhbXA7cXVvdDs6bnVsbH1dW10=W10=';
 echo '<br>';
echo $s = base64_decode($s);
 echo '<br>';
 
$s = str_replace('\\', '', $s);
echo $s = html_entity_decode($s);echo '<br>';
echo $s = html_entity_decode($s);echo '<br>';
// echo $s, PHP_EOL;
 
print_r(json_decode(substr($s, 0, -4), 1));

/**
* 读取文件前几个字节 判断文件类型
* @return string
*/
echo checkFileType('jay.jpg');
print_r(mime_content_type('jay.jpg'));
$allowType = array('image/jpeg','image/gif','image/jpg');
if( !in_array(mime_content_type('jay.jpg'),$allowType) ){
 
    exit(alert('文件类型错误'));
 
}
// 第六步，复制文件
 
// if( !copy($file['tmp_name'],$filePath.$filename) ){
 
    // exit(alert('上传文件出错，请稍候重试'));
 
// }
 
 
 
// 第七步，删除临时文件
 
// unlink($file['tmp_name']);
function checkFileType($filename){
    $file=fopen($filename,'rb');
    $bin=fread($file,2); //只读2字节
    fclose($file);
    $strInfo =@unpack("c2chars",$bin);
    $typeCode=intval($strInfo['chars1'].$strInfo['chars2']);
    $fileType='';
    switch($typeCode){
        case 7790:
            $fileType='exe';
        break;
        case 7784:
            $fileType='midi';
        break;
        case 8297:
            $fileType='rar';
        break;
        case 255216:
            $fileType='jpg';
        break;
        case 7173:
            $fileType='gif';
        break;
        case 6677:
            $fileType='bmp';
        break;
        case 13780:
            $fileType='png';
        break;
        default:
            $fileType='unknown'.$typeCode;
        break;
    }
    //Fix
    if($strInfo['chars1']=='-1' && $strInfo['chars2']=='-40'){
        return 'jpg';
    }
    if($strInfo['chars1']=='-119' && $strInfo['chars2']=='80'){
        return 'png';
    }
    return $fileType;
}

print_r($_FILES);
if($_FILES['file']['error'] > 0) {
    echo 'error';
}else {
    echo 'success';
}

/**
 * XML.php
 *
 * Part of Overtrue\Wechat.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author    overtrue <i@overtrue.me>
 * @copyright 2015 overtrue <i@overtrue.me>
 * @link      https://github.com/overtrue/wechat/blob/2.1/src/Wechat/Utils/XML.php#L20
 * @link      http://overtrue.me
 */

/**
 * XML 工具类，用于构建与解析 XML
 */
class XML
{
    /**
     * XML 转换为数组
     *
     * @param string $xml XML string
     *
     * @return array
     */
    public static function parse($xml)
    {
        $data = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NOBLANKS);
        if (is_object($data) && get_class($data) === 'SimpleXMLElement') {
            $data = self::arrarval($data);
        }
        return $data;
    }
    /**
     * XML编码
     *
     * @param mixed  $data 数据
     * @param string $root 根节点名
     * @param string $item 数字索引的子节点名
     * @param string $attr 根节点属性
     * @param string $id   数字索引子节点key转换的属性名
     *
     * @return string
     */
    public static function build(
        $data,
        $root = 'xml',
        $item = 'item',
        $attr = '',
        $id = 'id'
    )
    {
        if (is_array($attr)) {
            $_attr = array();
            foreach ($attr as $key => $value) {
                $_attr[] = "{$key}=\"{$value}\"";
            }
            $attr = implode(' ', $_attr);
        }
        $attr = trim($attr);
        $attr = empty($attr) ? '' : " {$attr}";
        $xml  = "<{$root}{$attr}>";
        $xml  .= self::data2Xml($data, $item, $id);
        $xml  .= "</{$root}>";
        return $xml;
    }
    /**
     * 生成<![CDATA[%s]]>
     *
     * @param string $string 内容
     *
     * @return string
     */
    public static function cdata($string)
    {
        return sprintf('<![CDATA[%s]]>', $string);
    }
    /**
     * 把对象转换成数组
     *
     * @param string $data 数据
     *
     * @return array
     */
    private static function arrarval($data)
    {
        if (is_object($data) && get_class($data) === 'SimpleXMLElement') {
            $data = (array) $data;
        }
        if (is_array($data)) {
            foreach ($data as $index => $value) {
                $data[$index] = self::arrarval($value);
            }
        }
        return $data;
    }
    /**
     * 转换数组为xml
     *
     * @param array  $data 数组
     * @param string $item item的属性名
     * @param string $id   id的属性名
     *
     * @return string
     */
     function data2Xml($data, $item = 'item', $id = 'id')
    {
        $xml = $attr = '';
        foreach ($data as $key => $val) {
            if (is_numeric($key)) {
                $id && $attr = " {$id}=\"{$key}\"";
                $key  = $item;
            }
            $xml .= "<{$key}{$attr}>";
            if ((is_array($val) || is_object($val))) {
                $xml .= self::data2Xml((array) $val, $item, $id);
            } else {
                $xml .= is_numeric($val) ? $val : self::cdata($val);
            }
            $xml .= "</{$key}>";
        }
        return $xml;
    }
}
$xml = new XML;
var_dump($xml->data2Xml([['id'=>'1','name'=>'php'],['id'=>2,'name'=>'js']]));
