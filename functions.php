<?php


function getUserLocation($services) {

        $ctx = stream_context_create(array('http' => array('timeout' => 15))); // 15 seconds timeout

        for ($i = 0; $i < count($services); $i++) {

            // Configuring curl options
            $options = array (
                CURLOPT_RETURNTRANSFER => true, // return web page
                //CURLOPT_HEADER => false, // don't return headers
                CURLOPT_HTTPHEADER => array('Content-type: application/json'),
                CURLOPT_FOLLOWLOCATION => true, // follow redirects
                CURLOPT_ENCODING => "", // handle compressed
                CURLOPT_USERAGENT => "test", // who am i
                CURLOPT_AUTOREFERER => true, // set referer on redirect
                CURLOPT_CONNECTTIMEOUT => 5, // timeout on connect
                CURLOPT_TIMEOUT => 5, // timeout on response
                CURLOPT_MAXREDIRS => 10 // stop after 10 redirects
            ); 

            // Initializing curl
            $ch = curl_init($services[$i]);
            curl_setopt_array ( $ch, $options );

            $content = curl_exec ( $ch );
            $err = curl_errno ( $ch );
            $errmsg = curl_error ( $ch );
            $header = curl_getinfo ( $ch );
            $httpCode = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );

            curl_close ( $ch );

            //echo 'service: ' . $services[$i] . '</br>';
            //echo 'err: '.$err.'</br>';
            //echo 'errmsg: '.$errmsg.'</br>';
            //echo 'httpCode: '.$httpCode.'</br>';
            //print_r($header);
            //print_r(json_decode($content, true));

            if ($err == 0 && $httpCode == 200 && $header['download_content_length'] > 0) {

                return json_decode($content, true);

            } 

        }
    }
$ip_srv = array("http://freegeoip.net/json/$this->ip","http://smart-ip.net/geoip-json/$this->ip");

getUserLocation($ip_srv);
//判断数据不是JSON格式

function is_not_json($str){  
    return is_null(json_decode($str));
}
//判断数据是合法的json数据: (PHP版本大于5.3)


function is_json($string) { 
 json_decode($string);
 return (json_last_error() == JSON_ERROR_NONE);
}
//json_last_error()函数返回数据编解码过程中发生的错误

/**
* 解析json串
* @param type $json_str
* @return type如果不是json则返回false
*/
function analyJson($json_str) {
$json_str = str_replace('＼＼', '', $json_str);
$out_arr = array();
preg_match('/{.*}/', $json_str, $out_arr);
if (!empty($out_arr)) {
$result = json_decode($out_arr[0], TRUE);
} else {
return FALSE;
}
return $result;
}

$arr = array ('a'=>urlencode('脚本之家'));
echo urldecode(json_encode($arr));//{"a":"脚本之家"}

//你需要将"索引数组"强制转化成"对象"，可以这样写
json_encode( (object)$arr );
//或者：
json_encode ( $arr, JSON_FORCE_OBJECT );
$newArray = array(array('地区'=>'北京地区','items'=>'10','detail'=>array(0=>array('店名'=>'旗舰店','url'=>'http://www.'),1=>array('店名'=>'jjjj','url'=>'http://www.fdd'))),
                  array('地区'=>'上海地区','items'=>'11','detail'=>array(0=>array('店名'=>'旗舰店','url'=>'http://www.'),1=>array('店名'=>'jjjj','url'=>'http://www.fdd'))),
                 );
//var jsarray = new Array();
//jsarray = <?php echo json_encode($newwarr);?>;

 $sql= 'select catid,catname,items from category where parentid=10';
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
     $arrArea['地区'] = $row['catname'];
     $arrArea['items'] = $row['items'];
     unset($arrArea['detail']);//这一步很关键，要不得出的信息就会累加。
     $sql2 = 'select title,url from news where catid='.$row['catid'];
     $fendian = mysql_query($sql2);
     while ($re=mysql_fetch_assoc($fendian)) {
      $item['店名']=$re['title']; 
      $item['url']=$re['url'];   
      $arrArea['detail'][] = $item; 
     }
     $newwarr[]=$arrArea;
    }    
    var_dump($newwarr);
