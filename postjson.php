<?php


/**http://blog.snsgou.com/post-866.html
 * PHP发送Json对象数据
 *API服务端端接收客户端传过来的 “Content-Type: application/json; charset=utf-8”头信息后，再将 http body 数据（即 Json字符串）转换成 类对象！
 * @param $url 请求url
 * @param $jsonStr 发送的json字符串
 * @return array
 */
function http_post_json($url, $jsonStr)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($jsonStr)
        )
    );
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return array($httpCode, $response);
}

$url = "postjson.php";
$jsonStr = json_encode(array('a' => "1", 'b' => "2", 'c' => "2"));
list($returnCode, $returnContent) = http_post_json($url, $jsonStr);
print_r(json_decode($returnContent,1));
//postjson.php
$data = json_decode(file_get_contents('php://input'), true);//不能用$_post Use $HTTP_RAW_POST_DATA instead of $_POST
file_put_contents('json.txt', file_get_contents('php://input'),FILE_APPEND);

echo json_encode($data);
function http_post_data($url, $params = array())
{
    if (is_array($params))
    {
        $params = http_build_query($params, null, '&');
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return array($httpCode, $response);
}

$url = "http://blog.snsgou.com";
$data = array('a' => 1, 'b' => 2, 'c' => 2);
// list($returnCode, $returnContent) = http_post_data($url, $data);


function http_post_data($url, $data_string) {
	$ch = curl_init();  
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json; charset=utf-8',
			'Content-Length: ' . strlen($data_string) 
			)
	);
	ob_start();
	curl_exec($ch);
	$return_content = ob_get_contents();
	$return_content = mb_convert_encoding($return_content, "gb2312", "utf-8");//转换编码
	ob_end_clean();
	$return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	return array($return_code, $return_content);
}

try {
	$url = "http://xxxx/xxxx/GetCommonPage"; 
	$tableName=" Users.UserInfo ";
	$data = json_encode(array('fieldsName'=>"*",'tableName'=>$tableName, 'whereSql'=>" 1=1 ",'orderBy' =>"UserID asc",'startRowIndex'=>1,'maximumRows'=>10));
	list($return_code, $return_content) = http_post_data($url, $data);
	echo $return_content;
} catch ( SoapFault $fault ) {
	echo "Error: ", $fault->faultcode, ", string: ", $fault->faultstring;
}
//由于PHP默认只识别application/x-www.form-urlencoded标准的数据类型，因此，对型如text/xml的内容无法解析为$_POST数组，故保留原型，交给$GLOBALS['HTTP_RAW_POST_DATA'] 来接收。

//另外还有一项 php://input 也可以实现此这个功能

//php://input 允许读取 POST 的原始数据。和 $HTTP_RAW_POST_DATA 比起来，它给内存带来的压力较小，并且不需要任何特殊的 php.ini 设置。php://input 不能用于 enctype="multipart/form-data"。
