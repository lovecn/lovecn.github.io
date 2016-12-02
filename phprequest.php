<?php 

/** HttpRequest class, HTTP请求类，支持GET,POST,Multipart/form-data 
*  Date:  2013-09-25 
*  Author: fdipzone 
*  Ver:  1.0 
* 
*  Func: 
*  public setConfig   设置连接参数 
*  public setFormdata  设置表单数据 
*  public setFiledata  设置文件数据 
*  public send     发送数据 
*  private connect    创建连接 
*  private disconnect  断开连接 
*  private sendGet    get 方式,处理发送的数据,不会处理文件数据 
*  private sendPost   post 方式,处理发送的数据 
*  private sendMultipart multipart 方式,处理发送的数据,发送文件推荐使用此方式 
*/
class HttpRequest{ // class start 
  
  private $_ip = ''; 
  private $_host = ''; 
  private $_url = ''; 
  private $_port = ''; 
  private $_errno = ''; 
  private $_errstr = ''; 
  private $_timeout = 15; 
  private $_fp = null; 
    
  private $_formdata = array(); 
  private $_filedata = array(); 
  
  
  // 设置连接参数 
  public function setConfig($config){ 
    $this->_ip = isset($config['ip'])? $config['ip'] : ''; 
    $this->_host = isset($config['host'])? $config['host'] : ''; 
    $this->_url = isset($config['url'])? $config['url'] : ''; 
    $this->_port = isset($config['port'])? $config['port'] : ''; 
    $this->_errno = isset($config['errno'])? $config['errno'] : ''; 
    $this->_errstr = isset($config['errstr'])? $config['errstr'] : ''; 
    $this->_timeout = isset($confg['timeout'])? $confg['timeout'] : 15; 
  
    // 如没有设置ip，则用host代替 
    if($this->_ip==''){ 
      $this->_ip = $this->_host; 
    } 
  } 
  
  // 设置表单数据 
  public function setFormData($formdata=array()){ 
    $this->_formdata = $formdata; 
  } 
  
  // 设置文件数据 
  public function setFileData($filedata=array()){ 
    $this->_filedata = $filedata; 
  } 
  
  // 发送数据 
  public function send($type='get'){ 
  
    $type = strtolower($type); 
  
    // 检查发送类型 
    if(!in_array($type, array('get','post','multipart'))){ 
      return false; 
    } 
  
    // 检查连接 
    if($this->connect()){ 
  
      switch($type){ 
        case 'get': 
          $out = $this->sendGet(); 
          break; 
  
        case 'post': 
          $out = $this->sendPost(); 
          break; 
  
        case 'multipart': 
          $out = $this->sendMultipart(); 
          break; 
      } 
  
      // 空数据 
      if(!$out){ 
        return false; 
      } 
  // echo $out;
      // 发送数据 
      fputs($this->_fp, $out); 
  
      // 读取返回数据 
      $response = ''; 
  
      while($row = fread($this->_fp, 4096)){ 
        $response .= $row; 
      } 
  
      // 断开连接 
      $this->disconnect(); 
  
      $pos = strpos($response, "\r\n\r\n"); 
      $response = substr($response, $pos+4); 
  
      return $response; 
  
    }else{ 
      return false; 
    } 
  } 
  
  // 创建连接 
  private function connect(){ 
    $this->_fp = fsockopen($this->_ip, $this->_port, $this->_errno, $this->_errstr, $this->_timeout); 
    if(!$this->_fp){ 
      return false; 
    } 
    return true; 
  } 
  
  // 断开连接 
  private function disconnect(){ 
    if($this->_fp!=null){ 
      fclose($this->_fp); 
      $this->_fp = null; 
    } 
  } 
  
  // get 方式,处理发送的数据,不会处理文件数据 
  private function sendGet(){ 
  
    // 检查是否空数据 
    if(!$this->_formdata){ 
      return false; 
    } 
  
    // 处理url 
    $url = $this->_url.'?'.http_build_query($this->_formdata); 
      
    $out = "GET ".$url." http/1.1\r\n"; 
    $out .= "host: ".$this->_host."\r\n"; 
    $out .= "connection: close\r\n\r\n"; 
  
    return $out; 
  } 
  
  // post 方式,处理发送的数据 
  private function sendPost(){ 
  
    // 检查是否空数据 
    if(!$this->_formdata && !$this->_filedata){ 
      return false; 
    } 
  
    // form data 
    $data = $this->_formdata? $this->_formdata : array(); 
  
    // file data 
    if($this->_filedata){ 
      foreach($this->_filedata as $filedata){ 
        if(file_exists($filedata['path'])){ 
          $data[$filedata['name']] = file_get_contents($filedata['path']); 
        } 
      } 
    } 
  
    if(!$data){ 
      return false; 
    } 
  
    $data = http_build_query($data); 
  
    $out = "POST ".$this->_url." http/1.1\r\n"; 
    $out .= "host: ".$this->_host."\r\n"; 
    $out .= "content-type: application/x-www-form-urlencoded\r\n"; 
    $out .= "content-length: ".strlen($data)."\r\n"; 
    $out .= "connection: close\r\n\r\n"; 
    $out .= $data; 
  
    return $out; 
  } 
  
  // multipart 方式,处理发送的数据,发送文件推荐使用此方式 
  private function sendMultipart(){ 
  
    // 检查是否空数据 
    if(!$this->_formdata && !$this->_filedata){ 
      return false; 
    } 
  
    // 设置分割标识 
    srand((double)microtime()*1000000); 
    $boundary = '---------------------------'.substr(md5(rand(0,32000)),0,10); 
  
    $data = '--'.$boundary."\r\n"; 
  
    // form data 
    $formdata = ''; 
  
    foreach($this->_formdata as $key=>$val){ 
      $formdata .= "content-disposition: form-data; name=\"".$key."\"\r\n"; 
      $formdata .= "content-type: text/plain\r\n\r\n"; 
      if(is_array($val)){ 
        $formdata .= json_encode($val)."\r\n"; // 数组使用json encode后方便处理 
      }else{ 
        $formdata .= rawurlencode($val)."\r\n"; 
      } 
      $formdata .= '--'.$boundary."\r\n"; 
    } 
  
    // file data 
    $filedata = ''; 
  
    foreach($this->_filedata as $val){ 
      if(file_exists($val['path'])){ 
        $filedata .= "content-disposition: form-data; name=\"".$val['name']."\"; filename=\"".$val['filename']."\"\r\n"; 
        $filedata .= "content-type: ".mime_content_type($val['path'])."\r\n\r\n"; 
        // $filedata .= implode('', file($val['path']))."\r\n"; 
        $filedata .= file_get_contents($val['path'])."\r\n"; 
        $filedata .= '--'.$boundary."\r\n"; 
      } 
    } 
  
    if(!$formdata && !$filedata){ 
      return false; 
    } 
  
    $data .= $formdata.$filedata."--\r\n\r\n"; 
  
    $out = "POST ".$this->_url." http/1.1\r\n"; 
    $out .= "host: ".$this->_host."\r\n"; 
    $out .= "content-type: multipart/form-data; boundary=".$boundary."\r\n"; 
    $out .= "content-length: ".strlen($data)."\r\n"; 
    $out .= "connection: close\r\n\r\n"; 
    $out .= $data; 
  
    return $out; 
  } 
} // class end 
$config = array( 
      'ip' => '', // 如空则用host代替 
      'host' => 'www.example.com', 
      'port' => 80, 
      'errno' => '', 
      'errstr' => '', 
      'timeout' => 30, 
      'url' => '/upload.php', 
      //'url' => '/postapi.php', 
      //'url' => '/multipart.php' 
); 
  
$formdata = array( 
  'name' => 'fdipzone', 
  'gender' => 'man'
); 
  
$filedata = array( 
  array( 
    'name' => 'photo', 
    'filename' => 'sf.jpg', 
    'path' => 'sf.jpg'
  ) 
); 
  
$obj = new HttpRequest(); 
$obj->setConfig($config); 
$obj->setFormData($formdata); 
$obj->setFileData($filedata); 
// $result = $obj->send('get'); 
/*
get请求数据结构
GET /upload.php?name=fdipzone&gender=man http/1.1
host: www.vhallapp.com
connection: close

 */
// $result = $obj->send('post'); 
/*
post请求数据结构
POST /upload.php http/1.1
host: www.vhallapp.com
content-type: application/x-www-form-urlencoded
content-length: 255810
connection: close

name=fdipzone&gender=man&photo=%89PNG%0D%0A%1A%0A%00%00%00%0DIHD

处理
var_dump($_REQUEST);
            if ($_REQUEST['photo']) {
              file_put_contents('photos.jpg',$_REQUEST['photo']);
            }
 */
$result = $obj->send('multipart'); 
/*
multipart 请求数据结构
POST /upload.php http/1.1
host: www.vhallapp.com
content-type: multipart/form-data; boundary=---------------------------252e346444
content-length: 102588
connection: close

-----------------------------252e346444
content-disposition: form-data; name="name"
content-type: text/plain

fdipzone
-----------------------------252e346444
content-disposition: form-data; name="gender"
content-type: text/plain

man
-----------------------------252e346444
content-disposition: form-data; name="photo"; filename="sf.jpg"
content-type: image/png

以下为二进制乱码


上传文件处理
$uploaddir = './public/';
$uploadfile = $uploaddir . basename($_FILES['photo']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}

echo 'Here is some more debugging info:';
print_r($_FILES);
 */  
echo '<pre>'; 
print_r($result); 
/*$request = new HttpRequest();
$request->setUrl('http://web.vhall2.com/index.php/api/jssdk/v1/webinar/addmsg');
$request->setMethod(HTTP_METH_GET);

$request->setQueryData(array(
  'webinar_id' => '3',
  'user_id' => '2',
  'nick_name' => '4',
  'content' => '4'
));

$request->setHeaders(array(
  'postman-token' => 'ae7402d3-1152-b38d-6208-258ed77f703f',
  'cache-control' => 'no-cache',
  'content-type' => 'multipart/form-data; boundary=---011000010111000001101001'
));

$request->setBody('-----011000010111000001101001
Content-Disposition: form-data; name="webinar_id"

257049187
-----011000010111000001101001
Content-Disposition: form-data; name="curr_page"

1
-----011000010111000001101001--');

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}*/
// http://stackoverflow.com/questions/19983722/multipart-form-data-into-array-not-processing
$time  = (string) (time() - (100 * rand(1,6)));
$photo = file_get_contents('test.jpg');

$fields = array(
    array(
        'headers' => array(
            'Content-Disposition' => 'form-data; name="device_timestamp"',
            'Content-Length'      => strlen($time)
        ),
        'body' => $time
    ),
    array(
        'headers' => array(
            'Content-Disposition' => 'form-data; name="photo"; filename="photo"',
            'Content-Type'        => 'image/jpeg',
            'Content-Length'      => strlen($photo)
        ),
        'body' => $photo
    )
);
function multipart_build_query($fields,$boundary='88888')
{
    $data = '';

    foreach ($fields as $field) {
        // add boundary
        $data .= '--' . $boundary . "\r\n";

        // add headers
        foreach ($field['headers'] as $header => $value) {
            $data .= $header . ': ' . $value . "\r\n";
        }

        // add blank line
        $data .= "\r\n";

        // add body
        $data .= $field['body'] . "\r\n";
    }

    // add closing boundary if there where fields
    if ($data) {
        $data .= $data .= '--' . $boundary . "--\r\n";
    }

    return $data;
}
// https://github.com/php-curl-class/php-curl-class http://phpenthusiast.com/blog/five-php-curl-examples
if (isset($_POST['btnUpload']))
{
$url = "upload.php"; // e.g. http://localhost/myuploader/upload.php // request URL
$filename = $_FILES['file']['name'];
$filedata = $_FILES['file']['tmp_name'];
$filesize = $_FILES['file']['size'];
if ($filedata != '')
{
    $headers = array("Content-Type:multipart/form-data"); // cURL headers for file uploading
    
    $ch = curl_init();
    // http://stackoverflow.com/questions/21905942/posting-raw-image-data-as-multipart-form-data-in-curl
    $fields = [
      'name' => new \CurlFile($filePath, 'image/png', 'filename.png')
    ];
    if (function_exists('curl_file_create')) { // php 5.6+
      $filedata = curl_file_create($filedata);
    } else { // 
      $filedata = '@' . realpath($filedata);
    }
    $postfields = array("filedata" => $filedata, "filename" => $filename);
    // curl_setopt($resource, CURLOPT_POSTFIELDS, $fields);
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_HEADER => true,
        CURLOPT_POST => 1,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => $postfields,
        CURLOPT_INFILESIZE => $filesize,
        CURLOPT_RETURNTRANSFER => true
    ); // cURL options
    curl_setopt_array($ch, $options);
    curl_exec($ch);
    if(!curl_errno($ch))
    {
        $info = curl_getinfo($ch);
        if ($info['http_code'] == 200)
            $errmsg = "File uploaded successfully";
    }
    else
    {
        $errmsg = curl_error($ch);
    }
    curl_close($ch);
  // upload.php
    $uploadpath = "images/";
    $filedata = $_FILES['filedata']['tmp_name'];
    $filename = $_POST['filename'];
    if ($filedata != '' && $filename != '')
        copy($filedata,$uploadpath.$filename);
}
else
{
    $errmsg = "Please select the file";
}
}
?>
<form action="uploadpost.php" method="post" name="frmUpload" enctype="multipart/form-data">
<tr>
  <td>Upload</td>
  <td align="center">:</td>
  <td><input name="file" type="file" id="file"/></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td><input name="btnUpload" type="submit" value="Upload" /></td>
</tr>