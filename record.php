

<?php

//裁剪图片

$filename= "test.jpg";
list($w, $h, $type, $attr) = getimagesize($filename);
$src_im = imagecreatefromjpeg($filename);

$src_x = '0';   // begin x
$src_y = '0';   // begin y
$src_w = '100'; // width
$src_h = '100'; // height
$dst_x = '0';   // destination x
$dst_y = '0';   // destination y

$dst_im = imagecreatetruecolor($src_w, $src_h);
$white = imagecolorallocate($dst_im, 255, 255, 255);
imagefill($dst_im, 0, 0, $white);

imagecopy($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h);

header("Content-type: image/png");
imagepng($dst_im);
imagedestroy($dst_im);

时间差异计算函数

function ago($time)
{
   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "ago";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$j].= "s";
   }

   return "$difference $periods[$j] 'ago' ";
}
//通过Email显示用户的Gravatar头像

 $gravatar_link = 'http://www.gravatar.com/avatar/' . md5($comment_author_email) . '?s=32';
  echo '<img src="' . $gravatar_link . '" />';
  强制下载文件

$filename = $_GET['file']; //Get the fileid from the URL 
// Query the file ID 
$query = sprintf("SELECT * FROM tableName WHERE id = '%s'",mysql_real_escape_string($filename)); 
$sql = mysql_query($query); 
if(mysql_num_rows($sql) > 0){ 
    $row = mysql_fetch_array($sql); 
    // Set some headers 
    header("Pragma: public"); 
    header("Expires: 0"); 
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
    header("Content-Type: application/force-download"); 
    header("Content-Type: application/octet-stream"); 
    header("Content-Type: application/download"); 
    header("Content-Disposition: attachment; filename=".basename($row['FileName']).";"); 
    header("Content-Transfer-Encoding: binary"); 
    header("Content-Length: ".filesize($row['FileName'])); 

    @readfile($row['FileName']); 
    exit(0); 
}else{ 
    header("Location: /"); 
    exit; 
}从网络下载文件

set_time_limit(0); 
// Supports all file types 
// URL Here: 
$url = 'http://somsite.com/some_video.flv'; 
$pi = pathinfo($url); 
$ext = $pi['extension']; 
$name = $pi['filename']; 

// create a new cURL resource 
$ch = curl_init(); 

// set URL and other appropriate options 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_HEADER, false); 
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true); 
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

// grab URL and pass it to the browser 
$opt = curl_exec($ch); 

// close cURL resource, and free up system resources 
curl_close($ch); 

$saveFile = $name.'.'.$ext; 
if(preg_match("/[^0-9a-z._-]/i", $saveFile)) 
    $saveFile = md5(microtime(true)).'.'.$ext; 

$handle = fopen($saveFile, 'wb'); 
fwrite($handle, $opt); 
fclose($handle);
黑名单过滤

function is_spam($text, $file, $split = ':', $regex = false){ 
    $handle = fopen($file, 'rb'); 
    $contents = fread($handle, filesize($file)); 
    fclose($handle); 
    $lines = explode("n", $contents); 
    $arr = array(); 
    foreach($lines as $line){ 
        list($word, $count) = explode($split, $line); 
        if($regex) 
            $arr[$word] = $count; 
        else 
            $arr[preg_quote($word)] = $count; 
    } 
    preg_match_all("~".implode('|', array_keys($arr))."~", $text, $matches); 
    $temp = array(); 
    foreach($matches[0] as $match){ 
        if(!in_array($match, $temp)){ 
            $temp[$match] = $temp[$match] + 1; 
            if($temp[$match] >= $arr[$word]) 
                return true; 
        } 
    } 
    return false; 
} 

$file = 'spam.txt'; 
$str = 'This string has cat, dog word'; 
if(is_spam($str, $file)) 
    echo 'this is spam'; 
else 
    echo 'this is not spam';
ab:3
dog:3
cat:2
monkey:2










