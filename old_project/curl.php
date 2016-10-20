<?php
header("Content-type: text/html; charset=utf-8"); 

$allergicWord = array('脏话','骂人话');  
$str = '这句话里包含了脏话和骂人话';  
  
for ($i=0;$i<count($allergicWord);$i++){  
    $content = substr_count($str, $allergicWord[$i]);  
    if($content>0){  
        $info = $content;  
        break;  
     }  
}  
  
if($info>0){  
  echo   '有违法字符 ';  
   //return TRUE;  
}else{  
  echo '没有违法字符' ; 
   //return FALSE;  
}  

//关键字的存放形式为txt,txt文件中以这样形式存放：|赌博机|卖血|出售肾|出售器官|眼角膜
//http://blog.csdn.net/china_skag/article/details/7520918
function Filter_word( $str, $fileName )   
{   
    if ( !($words = file_get_contents( $fileName )) ){   
        die('file read error!');   
    }   
    $str = strtolower($str);
 //var_dump($words);
 $word = preg_replace("/[1,2,3]\r\n|\r\n/i", '', $words);
 //$wor = substr($word,0,-1);
 //$w = preg_replace("|/|i", '\/', $word);
 //echo "<pre>";
 //var_dump($w);
 //$words = "赌博机|卖血|出售肾|出售器官|眼角膜";
    $matched = preg_replace('/'.$word.'/i', '***', $string);
 return $matched; 
}   
  
$content = "<a href='#'>我要卖血fsdf卖血d 赌博机wo眼口交膜</a>";   
if ($result = Filter_word($content, 'words.txt') ){
 echo $result;
    echo "替换成功 ";   
}else{   
    echo "替换失败! ";   
} 

 

//文章内容中的关键词加链接
function _sortDesc($a, $b) {
 return (strlen($a[0]) < strlen($b[0])) ? 1 : -1;
}

$linkDefs = array(
  '茶叶,111.htm',
  '中国茶叶大观,222.htm',
);

$linkMap = array();
foreach($linkDefs as $row) {
 $linkMap[] = explode(',', $row);
}

$str = '
这儿是茶叶的链接。<br />
这儿是中国茶叶大观的链接。<br />
这儿是<a href="111.html">茶叶</a>的现有链接。<br />
这儿是<a href="222.html">中国茶叶大观</a>的现有链接。<br />
';

//把原有的链接替换成文字
foreach($linkMap as $row) {
 $str = preg_replace('/(<a.*?>\s*)('.$row[0].')(\s*<\/a>)/sui', $row[0], $str);
}

//关键字从长至短排序
usort($linkMap, '_sortDesc');
//var_dump($linkMap);

$tmpKwds = array(); //存放暂时被替换的子关键字

foreach($linkMap as $i=>$row) {
 list($kwd, $url) = $row;
 for($j=$i+1; $j<count($linkMap); $j++) {
  $subKwd = $linkMap[$j][0];
   //如果包含其他关键字，暂时替换成其他字符串，如 茶叶 变成 
  if(strpos($kwd, $subKwd) !== false) {
   $tmpKwd = '';
   $kwd = str_replace($subKwd, $tmpKwd, $kwd);
   $tmpKwds[$tmpKwd] = $subKwd;
  }
 }
 //把文字替换成链接
 $str = preg_replace('/('.$row[0].')/sui', '<a href="'.$row[1].'">'.$kwd.'</a>', $str, -1);  // 所有的匹配项都会被替换
}

//把代替子关键字的字符串替换回来
foreach($tmpKwds as $tmp=>$kwd) {
 $str = str_replace($tmp, $kwd, $str);
}
echo $str;



//PHP模拟post，get
//post调用
$URL = 'http://www.baidu.com'; //需要提交到的页面
//下面这段是要提交的数据
$post_data['email'] = $_POST['email'];
$post_data['password'] = $_POST['password'];
//echo get_postData($URL,$post_data);


//get调用
$URL = 'http://www.baidu.com?token='.$token; //需要提交到的页面
//echo get_getData($URL);



function get_getData($URL){
$ch = curl_init($URL) ;
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ;
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ;
$output = curl_exec($ch) ;
fclose($fch) ;
return $output;
}




function get_postData($URL,$post_data){
$referrer="";
$URL_Info=parse_url($URL);
if($referrer==""){
    $referrer=$_SERVER["SCRIPT_URI"];
}
foreach ($post_data as $key=>$value){
    $values[]="$key=".urlencode($value);
}

$data_string=implode("&",$values);
if (!isset($URL_Info["port"])) {
$URL_Info["port"]=80;
$request.="POST ".$URL_Info["path"]." HTTP/1.1\n";
$request.="Host: ".$URL_Info["host"]."\n";
$request.="Referer: $referrer\n";
$request.="Content-type: application/x-www-form-urlencoded\n";
$request.="Content-length: ".strlen($data_string)."\n";
$request.="Connection: close\n";
$request.="\n";
$request.=$data_string."\n";
}
$fp = fsockopen($URL_Info["host"], $URL_Info["port"]);
fputs($fp, $request);
$i = 0;
while(!feof($fp)) {
$result = fgets($fp, 1024);
$length = strlen($result);
$s1 = substr($result, 0, 1);
$s2 = substr($result, $length - 3, 1);
if($s1 == '{' && $s2 == '}')
$resultover = $result;
}

fclose($fp);
return $resultover;
}
/*
//根据IP查找地址
function detect_city($ip) {  
  
$default = 'UNKNOWN';  
  
if (!is_string($ip) || strlen($ip) < 1 || $ip == '127.0.0.1' || $ip == 'localhost')  
$ip = '8.8.8.8';  
  
$curlopt_useragent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6 (.NET CLR 3.5.30729)';  
  
$url = 'http://ipinfodb.com/ip_locator.php?ip=' . urlencode($ip);  
$ch = curl_init($url);  
  
$curl_opt = array(  
CURLOPT_FOLLOWLOCATION => 1,  
CURLOPT_HEADER => 0,  
CURLOPT_RETURNTRANSFER => 1,  
CURLOPT_USERAGENT => $curlopt_useragent,  
CURLOPT_URL => $url,  
CURLOPT_TIMEOUT => 1,  
CURLOPT_REFERER => 'http://' . $_SERVER['HTTP_HOST'],  
);  
  
curl_setopt_array($ch, $curl_opt);  
  
$content = curl_exec($ch);  
  
if (!is_null($curl_info)) {  
$curl_info = curl_getinfo($ch);  
}  
  
curl_close($ch);  
  
if ( preg_match('{<li>City : ([^<]*)</li>}i', $content, $regs) ) {  
$city = $regs[1];  
}  
if ( preg_match('{<li>State/Province : ([^<]*)</li>}i', $content, $regs) ) {  
$state = $regs[1];  
}  
  
if( $city!='' && $state!='' ){  
$location = $city . ', ' . $state;  
return $location;  
}else{  
Return  $default;  
}  
  
}  

echo detect_city('222.35.101.188');*/
$lines = file('http://www.baidu.com/');  
foreach ($lines as $line_num => $line) {  
// 显示网页的源代码   
echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br>\n";  


//检查服务器是否使用HTTPS  
if ($_SERVER['HTTPS'] != "on") {  
echo "This is not HTTPS";  
}else{  
echo "This is HTTPS";  
}  
//通过Email发送PHP错误  
function nettuts_error_handler($number, $message, $file, $line, $vars){  
$email = "  
<p>An error ($number) occurred on line  
<strong>$line</strong> and in the <strong>file: $file.</strong>  
<p> $message </p>";  
  
$email .= "<pre>" . print_r($vars, 1) . "</pre>";  
  
$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";  
  
// Email the error to someone...  
error_log($email, 1, 'you@youremail.com', $headers);  
  
// Make sure that you decide how to respond to errors (on the user's side)  
// Either echo an error message, or kill the entire project. Up to you...  
// The code below ensures that we only "die" if the error was more than  
// just a NOTICE.  
if ( ($number !== E_NOTICE) && ($number < 2048) ) {  
die("There was an error. Please try again later.");  
}  
}  
  
// We should use our custom function to handle errors.  
set_error_handler('nettuts_error_handler');  
  
// Trigger an error... (var doesn't exist)  
echo$somevarthatdoesnotexist;  
//获取超链接文本内容
//http://blog.csdn.net/china_skag/article/details/7551072
//方法一
preg_match_all('/<(a|a)[s]{0,1}[w=":()]*>[nrn]*(check user)[nrn]*</(a|a)>/i',$string,$matches);
//方法二
preg_match_all('/<a[dd]*>check user</a>/i',$string,$matches);
print_r($matches);
//方法三
preg_match_all('/<a[^>]*>[^<]*</a>/i',$string,$matches);
print_r($matches);
//方法四
preg_match_all('/<a.+?>check user</a>/is',$str,$arr);
print_r($arr);
//方法五
preg_match_all('/<a.+?>check user</a>/is',$str,$arr);
print_r($arr); 

?>
<script language="javascript" type="text/javascript"> 
//给关键字加亮加超链接
    var arr=     { 

                    "百度":["http://www.baidu.com","#ff0000"], 

                    "谷歌":["http://www.google.com","#00ff00"], 

                    "雅虎":["http://www.yahoo.com","#0000ff"], 

                    "网易":["http://www.163.com","#cc6600"] 

            } 

    document.body.innerHTML = document.body.innerHTML.replace(/(百度|谷歌|雅|虎网易)/g,function(){ 

                var a=arguments[0]; 

                return a.fontcolor(arr[a][1]).link(arr[a][0]); 

            } 

        ); 

</script>
无广告优酷视频播放器调用
<embed type="application/x-shockwave-flash" src="http://static.youku.com/v1.0.0201/v/swf/qplayer_taobao.swf?VideoIDS=XMjUyODEwMDA=&isAutoPlay=false&isShowRelatedVideo=false&embedid=-&showAd=0" id="movie_player" name="movie_player" bgcolor="#FFFFFF" quality="high" wmode="transparent" allowfullscreen="true"
flashvars="isShowRelatedVideo=false&showAd=0&show_pre=1&show_next=1&isAutoPlay=false&isDebug=false&UserID=&winType=interior&playMovie=true&MM
Control=false&MMout=false&RecordCode=1001,1002,1003,1004,1005,1006,2001,3001,3002,3003,3004,3005,3007,3008,9999"
pluginspage="http://www.macromedia.com/go/getflashplayer" width="450" height="327"></embed>

无广告迷你优酷视频播放器调用
<embed type=”application/x-shockwave-flash” src=”http://static.youku.com/v/swf/qplayer.swf?winType=adshow&VideoIDS=XMjUyODEwMDA&isAutoPlay=false&ShowRelatedVideo=false” id=”movie_player” name=”movie_player” bgcolor=”#FFFFFF” quality=”high” wmode=”transparent” allowfullscreen=”true”
flashvars=”isAutoPlay=false&ShowRelatedVideo=false”
pluginspage=”http://www.macromedia.com/go/getflashplayer” width=”300″ height=”250″></embed>
<?php
    $domain = 'qita.in';/*欲查询的域名*/
    $site_url = 'http://www.baidu.com/s?wd=site%3A';
    $all = $site_url.$domain; /*域名所有收录的网址*/
    $today = $all.'&lm=1';    /*域名今日收录的网址*/
    $utf_pattern = '/找到相关结果数(.*)个/';
    $kz_pattern = '/<span class=\”g\”>(.*)<\/span>/'; /*用以匹配快照日期的字符串*/
    $times = '/\d{4}-\d{1,2}-\d{1,2}/'; /*匹配快照日期的正则表达式，如:2011-8-4*/
    $s0 = @file_get_contents($all);    /*将site:www.ninthday.net的网页置入$s0字符串中*/
    $s1 = @file_get_contents($today);
    preg_match($utf_pattern,$s0,$all_num); /*匹配”找到相关结果数*个”*/
    preg_match($utf_pattern,$s1,$today_num);
    preg_match($kz_pattern,$s0,$temp);
    preg_match($times,$temp[0],$screenshot);
    if($all_num[1] == '')
        $all_num[1] = 0;
    if($today_num[1] == '')
        $today_num[1] = 0;
    if($screenshot[0] == '')
        $screenshot[0] = '暂无快照';
?>
<html>
    <head>
    <title>Test</title>
    </head>
<body>
  <table>
    <tr>
      <td>日期</td><td>百度收录</td><td>百度今日收录</td><td>百度快照日期</td>
    </tr>
    <tr>
      <td><?php echo date('m月d日G时');?> </td><td><?php echo $all_num[1]; ?></td><td><?php echo $today_num[1]; ?></td><td><?php echo $screenshot[0]; ?></td>
    </tr>

  </table>
    <p>百度收录：<a href='<?php echo $all; ?>' target='_blank'><?php echo $all_num[1]; ?></a></p>
    <p>百度今日收录：<a href='<?php echo $today; ?>' target='_blank'><?php echo $today_num[1]; ?></a></p>
    <p>百度快照日期：<a href='<?php echo $all; ?>'><?php echo $screenshot[0]; ?></a></p>
</body>
</html>