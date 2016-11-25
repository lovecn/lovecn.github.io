<?php 


$db = new PDO('mysql:host=localhost;dbname=game', 'root', null);


$db->exec('set names utf8');

// $rs = $db->prepare("SELECT * FROM users");
		$rs=$db->query('SELECT * FROM users');
		$result = $rs->fetchAll(PDO::FETCH_ASSOC);
		if (count($result)) {
			echo json_encode(['code' => 0, 'msg' => '账号已存在']);die;
		}
//var_dump($db->getAttribute(PDO::ATTR_PERSISTENT));
// $db->setAttribute(PDO::ATTR_STATEMENT_CLASS, []);
$db=null;


// a string contains 4393 characters

// $log = 'start:' . PHP_EOL . var_export($receipt, true);

//file_put_contents('test.log', $log);


$secret_key = "user_secret_key";
$app_key = isset($_GET['app_key'])?$_GET['app_key']:'user_app_key';
$auth_type = isset($_GET['auth_type'])?$_GET['auth_type']:'2';
$signed_at = isset($_GET['signed_at'])?$_GET['signed_at']:time();
$webinar_id = isset($_GET['webinar_id'])?$_GET['webinar_id']:'123456789';
$params = [
	"app_key" => $app_key,
	"webinar_id" => $webinar_id,
	"auth_type"=> $auth_type,
	"signed_at" => $signed_at,
];
 
// 按参数名升序排列
ksort($params);
 
// 将键值组合
array_walk($params,function(&$value,$key){
	$value = $key . $value;
});
 
// 拼接,在首尾各加上$secret_key,计算MD5值
echo $sign = md5($secret_key . implode('',$params) . $secret_key);
 echo '<pre>';
// 结果形如
// $sign=md5("user_secret_keyapp_keyuser_app_keyauth_type2signed_attimestamp_nowwebinar_id123456789user_secret_key");
 
// 计算结果
// $sign = '4de932c67d65f26c6537ffb3a75401c3'; 
// http://locutus.io/php/  www.php2python.com  http://home.fleshth.com/php2js/index.php
// $gfe = new Gif();//gif类
// $gfe->extract($img['saveDir'].'/'.$img['fileName']);
// $frames = $gfe->getFrames();//帧信息

// print_r($frames['0']['image']);die;//Resource id #17

// http://www.hoohack.me/2015/01/17/unlimited-multi-level-classification-implement 无限多级分类实现(PHP)
// $rootArr = getRootCategory();
$rootArr = [
  ['id'=>1,'cat_id'=>1,'cat_name'=>'a','pid'=>0],
  ['id'=>2,'cat_id'=>2,'cat_name'=>'b','pid'=>1],
  ['id'=>3,'cat_id'=>3,'cat_name'=>'c','pid'=>1],
  ['id'=>4,'cat_id'=>4,'cat_name'=>'d','pid'=>2],
  ['id'=>5,'cat_id'=>5,'cat_name'=>'e','pid'=>3],
];
// getChildren($rootArr);

function getChildren(&$rootArr) {
    foreach ($rootArr as &$row) {
        if ($row['pid'] > 0) {
            $row['children'] = getChildren($row['cat_id']);
            getChildren($row['children']);
        }
    }
}
$categories = array(
    array('id'=>1,'name'=>'电脑','pid'=>0),
    array('id'=>2,'name'=>'手机','pid'=>0),
    array('id'=>3,'name'=>'笔记本','pid'=>1),
    array('id'=>4,'name'=>'台式机','pid'=>1),
    array('id'=>5,'name'=>'智能机','pid'=>2),
    array('id'=>6,'name'=>'功能机','pid'=>2),
    array('id'=>7,'name'=>'超级本','pid'=>3),
    array('id'=>8,'name'=>'游戏本','pid'=>3),
);
$tree = array();
//第一步，将分类id作为数组key,并创建children单元
foreach($categories as $category){
    $tree[$category['id']] = $category;
    $tree[$category['id']]['children'] = array();
}

//第二部，利用引用，将每个分类添加到父类children数组中，这样一次遍历即可形成树形结构。
foreach ($tree as $k=>$item) {
    if ($item['pid'] != 0) {
        $tree[$item['pid']]['children'][] = &$tree[$k];
    }
}

//print_r($tree);

class tree { 
    //访问index查看树形结构  http://www.manks.top/php-tree-deep.html
    //获取树 https://segmentfault.com/q/1010000007205669
    public static function getTree () { 
        //这里我们直接获取所有的数据，然后通过程序进行处理 
        //在无限极分类中最忌讳的是对数据库进行层层操作，也就很容易造成内存溢出 
        //最后电脑死机的结果 
        $data = $categories = array(
          array('id'=>1,'name'=>'电脑','pid'=>0),
          array('id'=>2,'name'=>'手机','pid'=>0),
          array('id'=>3,'name'=>'笔记本','pid'=>1),
          array('id'=>4,'name'=>'台式机','pid'=>1),
          array('id'=>5,'name'=>'智能机','pid'=>2),
          array('id'=>6,'name'=>'功能机','pid'=>2),
          array('id'=>7,'name'=>'超级本','pid'=>3),
          array('id'=>8,'name'=>'游戏本','pid'=>3),
      );
        return self::_generateTree($data); 
    } 
    //生成树 
    private static function _generateTree ($data, $pid = 0) { 
        $tree = []; 
        if ($data && is_array($data)) { 
            foreach($data as $v) { 
                if($v['pid'] == $pid) { 
                    $tree[] = [ 
                        'id' => $v['id'], 
                        'name' => $v['name'], 
                        'pid' => $v['pid'], 
                        'children' => self::_generateTree($data, $v['id']), 
                    ]; 
                } 
            } 
        } 
        return $tree; 
    } 
    public $cats = array();    
        
    public function category($fid=0, $level=1) {
        $sql = "SELECT * FROM `category` WHERE pid=:pid";
        $pdo = new PDO("mysql:host=localhost;dbname=test", "root", null);
        try {
            $stmt = $pdo->prepare($sql);
            $stmt -> bindParam(":pid", $fid, PDO::PARAM_INT);
            $stmt -> execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $v) {
                array_push($this->cats, array($v['name'], $level));
                $this-> category($v['id'], $level+1, $this->cats);
                
            }

            return $this->cats;
            
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function category2($fid=0, $level=1, $cats = array()) {
        $sql = "SELECT * FROM `category` WHERE pid=:pid";
        $pdo = new PDO("mysql:host=localhost;dbname=test", "root", null);
        try {
            $stmt = $pdo->prepare($sql);
            $stmt -> bindParam(":pid", $fid, PDO::PARAM_INT);
            $stmt -> execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $v) {
                array_push($cats, array($v['name'], $level));
                $this-> category($v['id'], $level+1, $cats);
                
            }

            return $cats;
            
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }
}
print_r(tree::getTree());
print_r((new tree)->category());
print_r((new tree)->category2());


/*
CREATE TABLE `category` (
 `id` int(11) NOT NULL,
 `name` varchar(50) CHARACTER SET utf8 NOT NULL,
 `pid` int(11) NOT NULL DEFAULT '0',
 PRIMARY KEY (`id`)
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 +----+--------+-----
| id | name   | pid
+----+--------+-----
|  1 | 电脑   |   0
|  2 | 手机   |   0
|  3 | 笔记本 |   1
|  4 | 台式机 |   1
|  5 | 智能机 |   2
|  6 | 功能机 |   2
|  7 | 超级本 |   3
|  8 | 游戏本 |   3
+----+--------+-----
 */
$pdo = new PDO("mysql:host=localhost;dbname=test", "root", null);
$sql = 'SELECT * FROM `category`';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($data);
function getCategories(PDO $pdo, $pid = 0)
{
    $sql = 'SELECT * FROM `category` WHERE pid=:pid';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':pid', $pid, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as &$row) {
        $row['children'] = getCategories($pdo, $row['id']);
    }
    return $data;
}

$a = getCategories($pdo);
//print_r($a);

/**http://www.blog8090.com/shi-yong-de-curl-lei/
     * @param $url 请求网址
     * @param bool $params 请求参数
     * @param int $ispost 请求方式
     * @param int $https https协议
     * @return bool|mixed
     */
    function curl($url, $params = false, $ispost = 0, $https = 0)
    {
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                if (is_array($params)) {
                    $params = http_build_query($params);
                }
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }

        $response = curl_exec($ch);

        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    }
class Foo {
     public function bar() {
         var_dump($this); //PHP5.5中打印的是A对象，PHP7是未定义，也就是NULL
     }
 }
 class Aa {
     public function test() {
         Foo::bar();
     }
 }
 $a  = new Aa();
 $a->test();
  $ipAddress = $_SERVER['REMOTE_ADDR'];
if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
    $ipAddress = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
}echo $ipAddress;
$ch = curl_init(); 
$data = array('name'=>'boy', "upload"=>"");
 

    $data['upload']=new CURLFile(realpath(getcwd().'/xxx.jpg'));
   // set url 
   curl_setopt($ch, CURLOPT_URL, "https://github.com/search?q=react"); 

   //return the transfer as a string 
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

   // $output contains the output string 
   // $output = curl_exec($ch); 

   //echo output
   // echo $output;

   // close curl resource to free up system resources 
   curl_close($ch);

$ch = curl_init(); 

    $fp=fopen('./sf.jpg', 'w');

    curl_setopt($ch, CURLOPT_URL, "https://sf-sponsor.b0.upaiyun.com/38382e90b89d6b3b35e78e80a24f2ffc.png"); 
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60); 
    curl_setopt($ch, CURLOPT_FILE, $fp); 

    $output = curl_exec($ch); 
    $info = curl_getinfo($ch);

    fclose($fp);

    $size = filesize("./sf.jpg");
    if ($size != $info['size_download']) {
        echo "下载的数据不完整，请重新下载";
    } else {
        echo "下载数据完整";
    }
    curl_close($ch);    
//var_dump($_GET['url']);
class Base {
    public function log() {

        // 目标类，输出：A/C
        echo static::class;
        
        
        // 基类，输出：Base
        //echo __CLASS__; 
        echo self::class;
        
    }
}

class A extends Base {
    public function log1() {
        echo self::class;
    }
}
class C extends A {
    public function log2() {
        echo self::class;
    }
}

$a = new A();$c = new C();
$a->log(); //输出 A Base
$c->log(); //输出 C Base
$c->log1(); //输出 A
$c->log2(); //输出 C
//设置post的数据  
  $post = array ( 
    'email' => '账户', 
    'pwd' => '密码'
  ); 
  //登录地址  
  $url = "登陆地址";  
  //设置cookie保存路径  
  $cookie = dirname(__FILE__) . '/cookie.txt';  
  //登录后要获取信息的地址  
  $url2 = "https://segmentfault.com/api/article/1190000006194027/like?_=fe14c144ddd1f07a4e0693effec548a3";  
  //模拟登录 
  // login_post($url, $cookie, $post);  
  //获取登录页的信息  
  $content = get_content($url2, $cookie);  
  //删除cookie文件 
  // @ unlink($cookie);
     
  var_dump($content);

 //模拟登录  
function login_post($url, $cookie, $post) { 
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 0);
    curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
    curl_exec($curl); 
    curl_close($curl);
} 
//登录成功后获取数据 https://segmentfault.com/a/1190000006220620#articleHeader9    
function get_content($url, $cookie='') { 
    $ch = curl_init(); 
    $headers = array(
    "cookie: mp_18fe57584af9659dea732cf41c1c0416_mixpanel=%7B%22; _ga=GA1.2.1212220601.1411881224",
    "DNT:1",
"Host:segmentfault.com",
"Origin:https://segmentfault.com",
"Referer:https://segmentfault.com/a/1190000006194027",
"User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.6.2000 Chrome/30.0.1599.101 Safari/537.36",
"X-Requested-With:XMLHttpRequest"
  );
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_HEADER, 0); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1); 
    // curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // login $url
    $rs = curl_exec($ch); 
    curl_close($ch); 
    return $rs; 
} 
// https://segmentfault.com/q/1010000005702858
$data = array(
    'mail' => '',
    'password' => '',
);
$postfields= '';
foreach ($data as $key => $value){
    $postfields .= urlencode($key) . '=' . urlencode($value) . '&';
}
$postfields = rtrim($postfields, '&');
$ch = curl_init();
$url = "https://segmentfault.com/api/user/login?_=259f90fcf626f304c69c52db1454f03e";

$headers = array(
    'Accept:*/*',
    'Accept-Encoding:gzip, deflate',
    'Accept-Language:zh-CN,zh;q=0.8',
    'Connection:keep-alive',
    'Content-Type:application/x-www-form-urlencoded; charset=UTF-8',
    'Cookie:mp_18fe57584af9659dea732cf41c1c0416_mixpanel=%7B%22; _gat=1',
    'Host:segmentfault.com',
    'Origin:https://segmentfault.com',
    'Referer:https://segmentfault.com/',
    'User-Agent:Mozilla/5.0 (X11; Linux i686 (x86_64)) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.97 Safari/537.36',
    'X-Requested-With:XMLHttpRequest',
);

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//curl_setopt($ch, CURLOPT_ENCODING, "");
//$result = curl_exec($ch);
curl_close($ch);

//var_dump($result);


// select uid, sum(skip) as sumskip, time from (select uid, skip, time from attendance where uid = 8499 order by time limit 3) as subt;

// select uid,skip,time from attendance where uid = 8499 order by time limit 3
// mysql删除大量数据,直接delete会锁表,用存储过程循环执行delete比较方便
// select * from (select * from qdwyc_car_online order by car_online_time desc  ) as m group by car_num
// SELECT * from qdwyc_car_online c where c.car_online_time in (select MAX(car_online_time) qdwyc_car_online from GROUP BY car_num);
// SELECT *,MAX(car_online_time) from qdwyc_car_online GROUP BY car_num
// DELETE FROM price_monitor  WHERE EXISTS (SELECT 1 FROM price_monitor b WHERE b.domain = price_monitor.domain );
// mysql 删除重复记录出错
//DELETE FROM foo WHERE id NOT IN (SELECT * FROM (SELECT MAX(id) FROM foo  GROUP BY prid) as tmp)
// delete from 表名 where 字段ID in (select * from (select max(字段ID) from 表名 group by 重复的字段 having count(重复的字段) > 1) as b); 
// delete a from foo a ,  (select min(id) as ms ,prid from foo group by prid having count(*)>1) b  where a.prid=b.prid and a.id>b.ms;

// 5201152188
//DELETE FROM foo a WHERE EXISTS (SELECT 1 FROM foo b WHERE b.prid = a.prid );
//安装pillow，强烈建议到https://pypi.python.org/pypi/Pillow/2.7.0或者http://pythonware.com/products/pil/ 下载合适的pillow版本的exe进行安装。
//下载.whl包先pip install wheel

//之后pip install 包名字.whl 即可安装某模块包
/*使用PIL 总是报错，例子都过不去，下面几位的错误都有，后来说最好使用PILLOW 来代替即可~ 下载地址：
PILLOW 64位  
。然后代码中的
import PIL 一律使用from PIL import Image 即可
PILLOW是针对3.4版本的，PIL只有2.x版本的
import Image,ImageFilter

# 打开一个jpg图像文件，注意路径要改成你自己的:
im = Image.open('/Users/michael/test.jpg')
# 获得图像尺寸:
w, h = im.size
# 缩放到50%:
im.thumbnail((w//2, h//2))
# 把缩放后的图像用jpeg格式保存:
im.save('/Users/michael/thumbnail.jpg', 'jpeg')
im = Image.open('/Users/michael/test.jpg')
im2 = im.filter(ImageFilter.BLUR)
im2.save('/Users/michael/blur.jpg', 'jpeg')*/
//到哪找.whl文件？http://www.lfd.uci.edu/~gohlke/pythonlibs/
/*c='159=watched; UVISIT=eyJpdiI6ImRwV2RLbEdwVmhFZ0x1TmZjRkxmQ0E9PSI'
obj={}
a=c.split(';')
a.map(function(i){obj[i.split('=')[0]]=i.split('=')[1]})
r1=requests.post('http://t.vhall.com/mywebinar/webinarlist',data={'type':0,'curr_page':1},cookies=obj)

postman 使用cookie发送 https://www.getpostman.com/docs/interceptor_cookies
先开启interceptor 
然后header添加Cookie: name=value; name2=value2*/
/*import urllib2
import json
from city import city_name

cityname = raw_input ('你想查哪个城市的天气？\n')
citycode = city_name().get(cityname)
print citycode

if citycode:
    url = r'http://www.weather.com. cn/data/cityinfo/'+citycode+'.html'
    print url
    content = urllib2.urlopen(url).read().decode('utf-8')

    print content*/

$arr = [[
        
            'productid' => 2,
            'cateid' => 4,
            'title' => '衣',
            'descr' => '吖吖吖吖吖吖吖吖吖吖吖吖吖吖吖吖吖吖吖吖吖',
            'num' => 197,
            'price' => 888.00,
            'cover' => '7xpizy.com1.z0.glb.clouddn.com/58087fa893aa7',
            'pics' => '{"58087faa67f8b":"7xpizy.com1.z0.glb.clouddn.com\/58087faa67f8b"}',
            'issale' => 1,
            'saleprice' => 799.00,
            'ishot' => 1,
            'istui' => 1,
            'ison' => 1,
            'createtime' => 0,
        

]];

$arr[0]['pics'] = json_decode($arr[0]['pics'],true);

 $json=json_encode($arr);
//print_r($arr);


function l_request($action){
    $baseUrl = "http://www.douyutv.com/api/v1/room/";
    $midReq = "?aid=android&cdn=ws&client_sys=android&time=";
    $t=time();


    $md5_url= $action . $t . 1231;
    //$auth = getmd5($md5_url);

    $requrl= $baseUrl . $action . $midReq . $t . "&auth=" . md5($md5_url);
    return $requrl;
}
//echo (l_request(10000346));

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
class topic {

  function Webinars()
    {
        return $this->belongsToMany('App\Models\Webinars', 'topic_relation_webianrs', 'topic_id', 'webinar_id');
    }
}
// $topic = $this->topic->find($id);
// $webinars = $topic->Webinars()->whereRaw('is_open!=1')->get();$topic->Webinars()返回的是Webinars表数据
// php解密
// http://www.waitalone.cn/eval-gzinflate-base64_decode-decryption.html
$s='eval(gzinflate(base64_decode("DdS3EqNWAEDRfn/Eu0NBTmOPd8hCpEcWNB7CAyRA5Pj13u42p72///3n99iMP37APet+1vf7W3XZCn/m2QIZ6r8SFkMJf/4ll96jnWxdUGSvipB2wnTz8xBSECiRrp8C1DlCud/NqVu1lcEKLGq1V+jN3hxKkTvHZ6uSVWv0zUV0hZ1f9a9xJPwBpYbrQc0Xw5YJAUra6iKodOSy5tPe7Gt7fRLuqRnu0IO7HmRrVD1fxFeK2f2O1fv5wqik6ci0XuSjF4Swsih9w1QiGhdHod7s1r9EhnivBnLsmn4xa4lbDA6WrAPtdbdEHOZswZhkFO3s0/HloCA9DY8P4+bJkXLIdchUxFHPTxKZWt+WnWmGLXhiQHN3qm0Q6VnoO3vY/ckHsWOIGlV8XMV+UaZEcKBPsZgj+S7kKISh2ZQiNnVK4zlHRIt6B3jDl1Q4+e1dy5ZqmXb73JPXtWn+17i/hvBQFlEdrFopoTeovgwy5WxlIZVZNEnYBYkG6g9OQrBgxMC7yVs6jwjMpoeCIIio/dFLm3cHTaA141F+CvRT0swD9PPbqdBl3Hyo7kclQMFmTIumUi3tyVEMWI6S7DE3Ycn148vqQGTmZJx9OU5gjQg5gjN2jZ1QDgALD40TJJQQGj9S4JXm6GlyYW3wDViCyCEpeB4wiJWX8za3/WYMePG2i03eKDCHrtUlY1qsOEje1ZNI0Vys8DHUy5iAW/yVvs+mESrbTA9BLQtsI52NNSsmEQ5J8FHadb0gFXiQsWTHoOfByWnW9zaJz/uTND4Mts76xBqIVB48F1l7rvf50Dg+XBai/DzNS40ITBXbsJxjsOjqWKN9/piDp6nOSUu+0qwz8KM4ibR1MLL6TpK4PKjNd+0IWZE/8R3myU3TJ+X3/ZiO1ewlH/p8PBoGh6C+71RfrG7Ir7kSri3QDmWGZ+v3rIjfsIqVqCfPGwZPxV6+CoRE60eY1DhE57EGl77cJtPd7aKbY44XEjjTsqZGpaYLy4VEWORuuCAcYz0TTtc8Ui7UpgaqpU7NSSi4r7wnLLHlmXA8tbSA+9CZvhz77ZWq7A37rvoMFytqNlzcb6NQnEu/wzMusfJBn68TzeTtcpGEdujKeOnrFngtW8RO7VTMIm5evd80RnEQ0+O78O+JYEMd5a9stxWXWxWJaKV6qiTPYXxFV/rdUhFGQmb+jbmHML4fHF/tLILuYKYRNEHr6q9fv379/eP3nxn9Dw==")))';

// $e="eval(base64_decode('PD9waHAgZWNobyAndHh0Y21zLmNvbSc7Pz4='))";
function decodephp($a)

{

    $max_level = 300; //最大层数

    for ($i = 0; $i < $max_level; $i++) {

        ob_start();

        eval(str_replace('eval', 'echo', $a));

        $a = ob_get_clean();

        if (strpos($a, 'eval(gzinflate(base64_decode') === false) {

            return $a;

        }

    }

}

echo decodephp($s);
/*while (strstr($a, "eval")) {

    ob_start();

    eval(str_replace("eval", "echo", $a));

    $a = ob_get_contents();

}

echo $a;*/
// http://blog.mimvp.com/2016/10/php-to-execute-external-commands-on-linux/
// exec("dir",$output);
    // print_r($output);
// system("pwd",$result);
// system("/usr/local/bin/order_proc > /tmp/abc ");//超时
// $output = shell_exec('ls -lart');
$arr = array('apple','banana','cat','dog');
    foreach($arr as $key=>&$val)
    {
        //some code
    }
unset($val);
    echo $val;  //输出dog
    echo $key;  //输出3
// 当foreach结束后，$key和$val变量也都不会被自动释放掉，但是此时$val和$arrcount($arr) - 1指向相同的内存地址。因此，此时修改$val的值也会改变了$arr[3]的值。
    //下面对val进行赋值
    $val = 'e';
    print_r($arr);  //输出Array ( [0] => apple [1] => banana [2] => cat [3] => e )
$html_data = '<a href="#">www.hoohack.me</a>';
// preg_replace("/(</?)(w+)([^>]*>)/e", "'\1'.strtoupper('\2').'\3'", $html_data);
$str = "<a href='#'>www.hoohack.me</a><img src=''><p>hello</p>";

$newStr = strip_tags($str);                               //过滤所有html标签

$strNoImg = strip_tags($str,"<a>");                       //仅过滤(某种标签，这里是a)标签

$multiStr = strip_tags($str,"<a><p>");                    //过滤多种标签
// 使用上面的函数时无法过滤&nbsp;因为strip_tags的话只能过滤html的标签，而\ 不属于html标签
preg_replace('/&nbsp;/', '', $str);

$str = "&nbsp;dfadad&nbsp;abcasdasdas&nbsp;&nbsp; ";  
$str = preg_replace('/^(&nbsp;|\s)*|(&nbsp;|\s)*$/', '', $str);  
var_dump($str);
/*
https://segmentfault.com/q/1010000007590532
 create table a (a_id int,name varchar(15));
create table b (b_id int ,a_id int,create_time datetime);
insert into a set a_id=1,name='1';
insert into a set a_id=2,name='2';
insert into b set b_id=1,a_id=1,create_time=now();
insert into b set b_id=2,a_id=1,create_time=now();
insert into b set b_id=3,a_id=1,create_time=now();
insert into b set b_id=4,a_id=2,create_time=now();
insert into b set b_id=5,a_id=2,create_time=now();
select a.a_id,name,b_id,create_time from a,(select * from b group by a_id order by create_time asc ) c where a.a_id=c.a_id ;
+------+------+------+---------------------+
| a_id | name | b_id | create_time         |
+------+------+------+---------------------+
|    1 | 1    |    1 | 2016-11-24 18:34:56 |
|    2 | 2    |    4 | 2016-11-24 18:35:53 |
+------+------+------+---------------------+*/
// res:{"4697":"i","4698":"love","4699":"you","4700":"","4701":"(1).44444|(2).666666"}
// res:{{"4697":"i","type":0},{"4698":"love","type":0},{"4699":"you","type":0},"4700":{"8352":"888","type":1},"4701":{"8354":"(1).44444","8355":"(2).666666","type":2}}
// res='{"text":{"4697":"i","4698":"love","4699":"you","type":0},"radio":{"4700":{"8352":"888","type":1}},"checkbox":{"4701":{"8354":"(1).44444","8355":"(2).666666","type":2}}}'



/*{
  "text":{
    "4697":"i","4698":"love","4699":"you"
  },
  "radio":{
    "4700":{"8352":"888"}
  },
  "checkbox":{"4701":{"8354":"(1).44444","8355":"(2).666666"}}
}*/





 $data =[
       "huodong"   => [
           "shenbing",
           "duobao",
           "ceshi"
       ],
       "sttime"    => [
           "2016-11-07 00:00:00",
           "2016-11-08 00:00:00",
           "2016-11-09 00:00:00"
       ],
       "edtime"    => [
           "2016-11-10 00:00:00",
           "2016-11-11 00:00:00",
           "2016-11-12 00:00:00"
       ],
       "sourcelmt" => [
           [
               "xiaomi_uku_and",
               "uc_uku_and",
               "qq_uku_and"
           ],
           [
               "xiaomi_uku_and",
               "qq_uku_and"
           ],
           [
               "uc_uku_and"
           ]
       ]
   ];
   $result = array();
foreach($data['huodong'] as $first_key => $id) {
    // 此处的 '' 和 array() 是作为默认值
    foreach(array('sttime'=>'','edtime'=>'','sourcelmt'=>array()) as $second_key => $val) {
        $result[$id][$second_key] = isset($data[$second_key][$first_key]) ? $data[$second_key][$first_key] : $val;
    }
}
print_r($result);
   $map = array_map(null,$data['sttime'],$data['edtime'],$data['sourcelmt']);
   $res = array_keys($data);
   foreach($map as $k=>$v){
       $result[] = [$res[1]=>$v[0],$res[2]=>$v[1],$res[3]=>$v[2]];
   }
//实现去掉字符串头尾空格的PHP代码 输出结果如下：http://www.hoohack.me/2015/03/21/php-remove-head-tail-blank
//&nbsp;是空格转义，不是字符串，直接用trim()是去不掉
//string 'dfadad&nbsp;abcasdasdas' (length=23)
// 在配置PDO时，设置了一项
// PDO::ATTR_AUTOCOMMIT => 0
// 所有的SQL都将做为事务处理，直到你用commit确认或rollback结束。因为没有提交事务，所以PDO就没有将需要执行的SQL语句提交到MySQL中，但还是会返回成功插入后的ID，因此数据库里面没有记录
// http://www.hoohack.me/2015/05/11/php-optimization-batch-operate-mysql
 $dsn = 'mysql:dbname=test;host=127.0.0.1';
    $user = 'root';
    $password = null;

    try {
        $dbh = new PDO($dsn, $user, $password);
    } catch(PDOException $e) {
        echo 'Connection failed: ' , $e->getMessage();
    }

    $begin = microtime(true) * 1000;
    $dbh->beginTransaction();
    try {
        $count = 10;
        $sql = 'INSERT INTO `optimization` (id, value) VALUES ';
        $sql_arr = array();
        $sql_str = '';
        for ($i = 0; $i < $count; $i++)
        {
            $sql_arr[] = "($i, $i)";
        }print_r($sql_arr);
        echo $sql_str = implode("','", $sql_arr);echo '<br>';
        $sql .= $sql_str;echo $sql;
        // $stmt = $dbh->prepare($sql);
        // $stmt->execute();
        // $dbh->commit();
    } catch(Exception $e) {
        $dbh->rollBack();
        echo $e->getMessage() . '<br>';
    }

    $end = microtime(true) * 1000;
    echo 'excuted : ' , ($end - $begin) , ' ms';
/**
 * Created by 独自等待
 * Date: 2014/11/20
 * Time: 9:27
 * Name: ocr.php 验证码识别
 * 独自等待博客：http://www.waitalone.cn/python-php-ocr.html
 */
// error_reporting(7);关闭错误提示
// if (!extension_loaded('curl')) exit('请开启CURL扩展,谢谢!');
//crack_key();

function crack_key()
{
    $crack_url = 'http://1.hacklist.sinaapp.com/vcode7_f7947d56f22133dbc85dda4f28530268/login.php';
    for ($i = 100; $i <= 999; $i++) {
        $vcode = mkvcode();
        $post_data = array(
            'username' => 13388886666,
            'mobi_code' => $i,
            'user_code' => $vcode,
            'Login' => 'submit'
        );
        $response = send_pack('POST', $crack_url, $post_data);
        if (!strpos($response, 'error')) {
            system('cls');
            echo $response;
            break;
        }else{
            echo $response."\n";
        }
    }
}


function mkvcode()
{
    $vcode = '';
    $vcode_url = "http://1.hacklist.sinaapp.com/vcode7_f7947d56f22133dbc85dda4f28530268/vcode.php";
    $pic = send_pack('GET', $vcode_url);
    file_put_contents('vcode.png', $pic);
    $cmd = "\"D:\\Program Files (x86)\\Tesseract-OCR\\tesseract.exe\" vcode.png vcode";
    system($cmd);
    if (file_exists('vcode.txt')) {
        $vcode = file_get_contents('vcode.txt');
        $vcode = trim($vcode);
        $vcode = str_replace(' ', '', $vcode);
    }
    if (strlen($vcode) == 4) {
        return $vcode;
    } else {
        return mkvcode();
    }
}

//数据包发送函数
function send_pack($method, $url, $post_data = array())
{
    $cookie = 'saeut=218.108.135.246.1416190347811282;PHPSESSID=6eac12ef61de5649b9bfd8712b0f09c2';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_COOKIE, $cookie);
    if ($method == 'POST') {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    }
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}
// https://segmentfault.com/a/1190000002790818
const ONE = 1;
const TWO = ONE * 2;    //定义常量时允许使用之前定义的常量进行计算

class C8 {
    const THREE = TWO + 1;
    const ONE_THIRD = ONE / self::THREE;
    const SENTENCE = 'The value of THREE is '.self::THREE;

    public function f($a = ONE + self::THREE) { //允许常量作为函数参数默认值
        return $a;
    }
}

echo (new C8)->f()."\n";
echo C8::SENTENCE;
function test(...$args)
{
    print_r($args);
}

test(1,2,3);
 $a = 2;
$a **= 3;
// use const Name\Space\FOO;
    // use function Name\Space\f;
$expected  = crypt('12345', '$2a$07$usesomesillystringforsalt$');
$incorrect = crypt('1234',  '$2a$07$usesomesillystringforsalt$');

var_dump(hash_equals($expected, $incorrect)); // false
function number10()
{
    for($i = 1; $i <= 10; $i += 1)
        yield $i;
}

$array = [
    [1, 2],
    [3, 4],
];

foreach ($array as list($a, $b)) {
    echo $a.$b;
}
echo [1, 2, 3][0]; // 1
echo 'PHP'[0]; // P
// Traits不能被单独实例化，只能被类所包含
trait SayWorld
{
    public function sayHello()
    {
        echo 'World!';
    }
}

class MyHelloWorld
{
    // 将SayWorld中的成员包含进来
    use SayWorld;
}

$xxoo = new MyHelloWorld();
// sayHello() 函数是来自 SayWorld 构件的
$xxoo->sayHello();
$bin = bindec('110011'); //之前需要这样写
$bin = 0b110011;
echo $bin; //51
// 类似这样：”http://www.W3非o法ol.com.c字符n/”，则净化后的 $url 变量应该是这样的：http://www.W3School.com.cn/
// $url = filter_input(INPUT_POST, "http://www.W3非o法ol.com.c字符n/", FILTER_SANITIZE_URL);

function convertSpace($string) {
        return str_replace("_", " ", $string);
    }
  
    $string = "Peter_is_a_great_guy!";
  
    echo filter_var($string, FILTER_CALLBACK, array("options"=>"convertSpace"));
 // call_user_func($obj->func);
$recursive = function () use (&$recursive) {
        //$recursive函数是有效的
    };

    //这样并不行
    // $recusive = function() use ($recursive) {
        //$recursive并不能被识别
    // };
$total_online["figure_data" ]= [
      "2016-11-18" => "0",
      "2016-11-19" => "0",
      "2016-11-20" => "0",
      "2016-11-21" => "0",
      "2016-11-22" => "0",
      "2016-11-23" => "0",
      "2016-11-24" => "7",
    ];
// echarts 
/*{
  name:'线上新增',
  type:'line',
  data:[{{ implode(',', array_values($total_online['figure_data'])) }}]
},
{
  name:'线下新增',
  type:'line',
  data:{!! json_encode(array_values($total_offline['figure_data'])) !!}
}
不能使用data:[{{ implode(',', array_values($total_online['figure_data'])) }}] 因为key为字符串
xAxis : [
    {
        type : 'category',
        data : [@foreach (array_keys($total_online['figure_data']) as $value)'{{$value}}'{{","}}@endforeach]
    }
],
xAxis : [
        {
            name : '单会员付费金额',
            type : 'category',
            data : ['{!! implode("','", array_keys($figure_data)) !!}']
        }
    ],
*/
$keysDate = [];
        $dates = [];
        $startTimestamp = strtotime(date('Y-m-d', strtotime('-10 days')));
        $endTimestamp = time();
        for($i = $startTimestamp; $i < $endTimestamp; $i+=86400){
            $date = date('Y-m-d', $i);
            $dates[] = $date;
            // $keysDate[] = $cachePrefix.$date;
        }

$datesStr = implode("','", $dates);
echo $sql = 'select DATE_FORMAT(created_at, \'%Y-%m-%d\') date, count(*) count from users where DATE_FORMAT(created_at, \'%Y-%m-%d\') in (\''.$datesStr.'\') group by date';

$a=['a:100'=>100,'b:200'=>200,'c:300'=>300];

$n=['100','200','300'];
   foreach ($a as $key=>$value){
            $keyArr = explode(':', $key);
            if(isset($keyArr[1])){
                $date = $keyArr[1];
            }else{
                $date = '';
            }
            $a[$date] = $value;
            unset($a[$key]);
        }print_r($a);
$fees = [[
    "user_id" => "154",
    "fee" => "0.01"
  ],
  1 => [
    "user_id" => "453",
    "fee" => "0.01"
  ],
  2 => [
    "user_id" => "459",
    "fee" => "0.02"
  ]];

      $spans =[
            '5万以下' => [0, 50000],
            '5万-10万' => [50000, 100000],
            '10万-20万' => [100000, 200000],
            '20万-50万' => [200000, 500000],
            '50万-100万' => [500000, 1000000],
            '100万以上' => [1000000, '~']
        ];
        $figureData = [];
        // 初始化表格数据
        foreach ($spans as $name => $spanItem){
            $figureData[$name] = 0;
        }
        foreach ($fees as $row){
            foreach ($spans as $name => $span) {
                $leftBound = $span[0];
                $rightBound = $span[1];

                if($row['fee'] > $leftBound && ($row['fee']<= $rightBound || $rightBound == '~')){
                    if(isset($figureData[$name])){
                        $figureData[$name]+=1;
                    }else{
                        $figureData[$name] = 0;
                    }
                }

            }
        }
print_r($figureData);
?>



#!/usr/bin/env python
# -*- coding: gbk -*-
# -*- coding: utf_8 -*-
# Date: 2014/9/17去掉代码高亮前面的数字
# Created by 独自等待
# 博客 http://www.waitalone.cn/
import re

okfile = open('ok.php', 'w')
with open('1.txt', 'r') as ofile:
    while True:
        line_num = ofile.readline()
        reg = re.compile('^(\d{2,3})(.*?)$')
        m = reg.match(line_num.lstrip())
        if m != None:
            print m.group(2)
            okfile.write(m.group(2) + '\n')
        if len(line_num) == 0:
            break
okfile.close()


<form method="post" onsubmit="return convert(this)">
			<textarea id="code" name="code" style="width:100%;height:300px">

</textarea>
			<input type="submit" value="convert">
			<textarea id="converted_code" name="converted_code" style="width:100%;height:300px"></textarea>
		</form>			
<script type="text/javascript">
function disableMethod(obj, methodName) {
    var original = obj[methodName];
    obj[methodName] = function() {};
    obj[methodName].recover = function() {
        obj[methodName] = original;
    };
}
// disable 的时候
disableMethod($scope, "messageDialogCheck");

// 恢复的时候
//$scope.messageDialogCheck.recover();

//如果你是通过设置undefined禁止的话,可以先用变量储存起来

//_messageCenterCheck=this.messageCenterCheck;
//恢复时:

//this.messageCenterCheck=_messageCenterCheck
var num = 1234567890;
console.log(num.toLocaleString());
// https://segmentfault.com/q/1010000007554392
num = 1234567890.12345;
console.log(num.toLocaleString());
function haha(num) {
  return num.toString().num.split('.').map((v, i) => {
    if (!i) return Number(v).toLocaleString();
    return '.' + (Number(v.split('').reverse().join('')).toLocaleString()).split('').reverse().join('');
  }).join('');
}
console.log(haha(123456789.12345))
console.log(haha(123456789))



// https://www.oschina.net/code/snippet_12_8927  md5.js
// http://home.fleshth.com/php2js/index.php
var json='<?php echo $json;?>';
console.log(JSON.parse(json));
var myjson = JSON.parse(json.replace(/ 0+(?![\. }])/g, ' '));
console.log(eval('({"ti": 0000011410})'));
	var obj = {"app_key" : "user_app_key",
	"webinar_id" : "123456789",
	"auth_type": 2,
	"signed_at" : "timestamp_now"
	},
	res={},
	r={};
	var k=Object.keys(obj);
	k.sort();
	k.map(function(i,j){console.log(i,j);res[i]=obj[i];});
	for(var a in res){r[a]=a+res[a];}
	// MD5('user_secret_key'+Object.values(r).join('')+'user_secret_key')

function convert(form) { 
				var request = new XMLHttpRequest();
				request.open("POST", "./index.php");
				request.onload = function() { 
					document.querySelector("#converted_code").value = this.responseText;
				}
				request.send(new FormData(form));
				return false;
			}
			// 执行js代码
			function Run() { 
				var s = document.querySelector("#converted_code").value;
				eval(s);
			}
			var o = console;
			
			var console = {
				log: function() { 
					var a = [].slice.call(arguments,0);
					document.querySelector("#evaled").value += a.join(" ") + "\n";
					o.log.apply(o,a);
				}
			};





</script>
	