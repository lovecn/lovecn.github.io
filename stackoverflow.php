<?php
        $ch        = curl_init();
        $timeout   = 300;
        $useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)";
        $header    = array(
        		'Accept-Language: zh-cn', 
        		'Connection: Keep-Alive', 
        		'Cache-Control: no-cache', 
        		'Content-Type: Application/json;charset=utf-8'
        	);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $json = '{"arr":"{\"id\":\"7fce678b6db1f3152479b259222beede\",\"imp\":[{\"id\":\"ffe00609f6004839d907e318db2a5dce\",\"banner\":{\"w\":200,\"h\":100},\"tagid\":\"fccb1731f90438afd6b1a44db0779500\"}],\"user\":{\"id\":\"\"},\"device\":{\"ip\":\"172.20.207.39\"}}"}';
	// $data_string['data'] = $json;       
        // $data = http_build_query($data_string);
        // echo $data;
        curl_setopt($ch, CURLOPT_URL, 'http://www.vhallapp.com/getjson.php');
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);                		 
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $body = curl_exec($ch);
        echo '<pre>';print_r($body);

$itemCount = 1;

echo 'You have ordered ', $itemCount, ' item', $itemCount === 1 ? '' : 's';
//       http://stackoverflow.com/documentation/php/194/variables               ↑           ↑        ↑                - Note the commas

#> "You have ordered 1 item"
$x=1;$y=2;
echo "The total is: " . ($x + $y);
echo "The total is: ", $x + $y;
function say_hello() {
    return "Hello!";
};
echo "I say: {say_hello()}";
#> "I say: {say_hello()}"
class Person {
  function say_hello() {
    return "Hello!";
  }
}

$max = new Person();

echo "Max says: {$max->say_hello()}";
#> "Max says: Hello!"

// Example of invoking a Closure — the parameter list allows for custom expressions
$greet = function($num) {
    return "A $num greetings!";
};
echo "From us all: {$greet(10 ** 3)}";
#> "From us all: A 1000 greetings!"


$money = 25.2;
printf('%01.2f', $money);
#> 25.20

$name = 'Jeff';

// The `%s` tells PHP to expect a string
//            ↓  `%s` is replaced by  ↓
printf("Hello %s, How's it going?", $name);
#> Hello Jeff, How's it going?

// Instead of outputting it directly, place it into a variable ($greeting)
$greeting = sprintf("Hello %s, How's it going?", $name);
echo $greeting;
#> Hello Jeff, How's it going?
echo "<p>We need more ${name}s to help us!</p>";
#> "<p>We need more Joels to help us!</p>"


$myarray = [ "Hello", "World" ];
var_export($myarray);
$array_export = var_export($myarray, true);
printf('$myarray = %s; %s', $array_export, PHP_EOL);
$a = array_fill(5, 6, 'banana');

$array = array(1, 2, 3, 4, 5);
array_walk($array, function(&$value, $key) {
    $value++;
});
$res = [];
$array = array(1, array(2, 3, array(4, 5), 6));
array_walk_recursive($array, function(&$value, $key) {
    $res[]=$value;
});
// prints "1 2 3 4 5 6"

$json = json_decode('"some string"', true);
var_dump($json, json_last_error_msg());//some string
$json = json_decode('some string', true);#null

$array = ['Joel', 23, true, ['red', 'blue']];
#格式化输出
echo json_encode($array, JSON_PRETTY_PRINT);
echo json_encode($array, JSON_FORCE_OBJECT);
#> {"0":"Joel","1":23,"2":true,"3":{"0":"red","1":"blue"}}
#
#echo json_encode($array, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);

var_dump(json_decode('TRUE'), json_last_error_msg());#null
var_dump(json_decode('true'), json_last_error_msg());#true
$array = ['23452', 23452];

echo json_encode($array);
#> ["23452",23452]

echo json_encode($array, JSON_NUMERIC_CHECK);
#> [23452,23452]
$array = ["Singin' in Bahrain", "Charlie Wilson's War"];
echo json_encode($array, JSON_HEX_APOS);
#> ["Singin\u0027 in Bahrain","Charlie Wilson\u0027s War"]
$array = ['filename' => 'example.txt', 'path' => '/full/path/to/file/'];

echo json_encode($array);
#> {"filename":"example.txt","path":"\/full\/path\/to\/file"}

echo json_encode($array, JSON_UNESCAPED_SLASHES);
#> {"filename":"example.txt","path":"/full/path/to/file"}
$array = [5.0, 5.5];
echo json_encode($array);
#> [5,5.5]

#echo json_encode($array, JSON_PRESERVE_ZERO_FRACTION);
#> [5.0,5.5]

$jsonString = json_encode("{'Bad JSON':\xB1\x31}");

if (json_last_error() != JSON_ERROR_NONE) {
    printf("JSON Error: %s", json_last_error_msg());
}

#> JSON Error: Malformed UTF-8 characters, possibly incorrectly encoded
#http://stackoverflow.com/documentation/php/617/json/18990/header-json-and-the-returned-response
class MathValues {
    const PI = 3.14159;
    const PHI = 1.61803;
    const LABOR_COSTS = 12.75 * 0.26;
}
$radius=2;
$area = MathValues::PI * $radius * $radius;

// class_exists(ThisClass\Will\NeverBe\Loaded::class, false);
#namespace foo;
#use bar\Bar;
#echo json_encode(Bar::class); // "bar\\Bar"
#echo json_encode(Foo::class); // "foo\\Foo"
#echo json_encode(\Foo::class); // "Foo"
$dsn = "mysql:host=localhost;dbname=test;charset=utf8";
$pdo = new PDO(
    $dsn, 
    'root', 
    null, 
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
#http://stackoverflow.com/documentation/php/275/using-a-database
try {
    $pdo->beginTransaction();
    $statement = $pdo->prepare("UPDATE app_ad SET name = 1");
    $statement->execute();
    $statement = $pdo->prepare("UPDATE app_ad SET url = 2");
    $statement->execute();
    $pdo->commit();
} catch (\Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollback();
        // If we got here our two data updates are not in the database
    }
    throw $e;
}

$uppercase = function($data) {
    return strtoupper($data);
};

$mixedCase = ["Hello", "World"];
$uppercased = array_map($uppercase, $mixedCase);
class SomeClass {
    public function __invoke($param1, $param2) {
        echo 'method';
    }
}

$instance = new SomeClass();
$instance('First', 'Second'); // call the __invoke() method
if (isset($_POST['name'])) {
    $name = $_POST['name'];
} else {
    $name = 'nobody';
}
// http://stackoverflow.com/documentation/php/1687/operators
// http://stackoverflow.com/documentation/php/1687/operators/5451/altering-operator-precedence-with-parentheses
// $name = $_GET['name'] ?? $_POST['name'] ?? 'nobody';
// $name = $_POST['name'] ?? 'nobody';
// usort($list, function($a, $b) { return $a->weight <=> $b->weight; });

// usort($list, function($a, $b) {
    // return $a->weight < $b->weight ? -1 : ($a->weight == $b->weight ? 0 : 1);
// });
#echo '<?php var_dump($argv);' | php
 #php -r 'var_dump($argv);'
$output = `ls`;
echo "<pre>$output</pre>";
// $name = readline("Please enter your name:");
print "Hello, {$name}.";
function get_client_ip ()
{
    // Nothing to do without any reliable information
    if (!isset ($_SERVER['REMOTE_ADDR'])) {
        return NULL;
    }
    
    // Header that is used by the trusted proxy to refer to
    // the original IP
    $proxy_header = "HTTP_X_FORWARDED_FOR";

    // List of all the proxies that are known to handle 'proxy_header'
    // in known, safe manner
    $trusted_proxies = array ("2001:db8::1", "192.168.50.1");

    if (in_array ($_SERVER['REMOTE_ADDR'], $trusted_proxies)) {
        
        // Get IP of the client behind trusted proxy
        if (array_key_exists ($proxy_header, $_SERVER)) {

            // Header can contain multiple IP-s of proxies that are passed through.
            // Only the IP added by the last proxy (last IP in the list) can be trusted.
            $client_ip = trim (end (explode (",", $_SERVER[$proxy_header])));

            // Validate just in case
            if (filter_var ($client_ip, FILTER_VALIDATE_IP)) {
                return $client_ip;
            } else {
                // Validation failed - beat the guy who configured the proxy or
                // the guy who created the trusted proxy list?
                // TODO: some error handling to notify about the need of punishment
            }
        }
    }

    // In all other cases, REMOTE_ADDR is the ONLY IP we can trust.
    return $_SERVER['REMOTE_ADDR'];
}

print get_client_ip ();
$a = 1;
$b = 1;
$a = $b += 1;#2,2
$a = 3;
$b = ($a = 5);#5,5

$e = false || true;// true.

$e = false or true;// false.

#It's because $e = false || true is evaluated as $e = (false || true) and

#$e = false or true is evaluated as ($e = false) or true

#Because of this it's safer to use && and || instead of and and or.


$string = $_REQUEST['user_comment'];
if (!mb_check_encoding($string, 'UTF-8')) {
    // the string is not UTF-8, so re-encode it.
    $actualEncoding = mb_detect_encoding($string);
    $string = mb_convert_encoding($string, 'UTF-8', $actualEncoding);
}
$i = 1;
while ($i < 10) {
    echo $i;
    $i++;
}
const APP_LANGUAGES = ["de", "en"]; // arrays
$constants = get_defined_constants();

define("HELLO", "hello"); 
define("WORLD", "world"); 
if (defined("GOOD")) {
   print "GOOD is defined"; // doesn't print anyhting, GOOD is not defined yet.
}
defined("PI") || define("PI", 3.1415); // "define PI if it's not yet defined"

$new_constants = get_defined_constants();

$myconstants = array_diff_assoc($new_constants, $constants);
var_export($myconstants); 
   
/* 
Output:

array (
  'HELLO' => 'hello',
  'WORLD' => 'world',
) 
*/$ip  =  gethostbyname ( 'www.example.com' );

#http://curl.haxx.se/docs/caextract.html
#curl_setopt($ch, CURLOPT_CAINFO, __DIR__ . "/certs/cacert.pem");
#curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
class Example2
{
   private $hook = "phpinfo();";
}
$num = 10;
switch(true) {
    case ($num % 2 == 0):
    echo "I was divided by 2..";
    break;
}
print urlencode(serialize(new Example2));
$url = 'https://example.org/foo/bar';
if (!headers_sent()) { // check headers - you can not send headers if they already sent
  // header('Location: ' . $url);
  // exit; // protects from code being executed after redirect request
} else {
  // throw new Exception('Cannot redirect, headers already sent');
}

$url = 'http://www.example.com/page?foo=1&bar=baz#anchor';
$queryString = parse_url($url, PHP_URL_QUERY);
$doc = new DOMDocument();
// $doc->loadXML($string);
$string = "<p>Example</p>";
$newstring = filter_var($string, FILTER_SANITIZE_STRING);
var_dump($newstring); // string(7) "Example"

var_dump(filter_var('joh n@example.com', FILTER_SANITIZE_EMAIL));#john@example.com

$options = array(
    'options' => array(
        'min_range' => 5,
        'max_range' => 10,
    )
);
var_dump(filter_var('5', FILTER_VALIDATE_INT, $options));
var_dump(filter_var('10', FILTER_VALIDATE_INT, $options));
var_dump(filter_var('javascript://comment%0Aalert(1)', FILTER_VALIDATE_URL));
// string(31) "javascript://comment%0Aalert(1)"
var_dump(filter_var('96-D5-9E-67-40-AB', FILTER_VALIDATE_MAC));

// Throw an Exception
// throw new Exception("Exception found!"); // Uncaught Exception, script will stop.

// Catch an Exception
try {
     throw new Exception("Exception found!");
} catch (\Exception $e) {
     echo 'Caught exception: ' . $e->getMessage(); // Caught Exception
         // file_put_contents('my_error_log.txt', $ex->getMessage(), FILE_APPEND);

     // Script execution continues
} finally {
    // This part is always executed, no matter any exception is thrown or not
    echo "Reached the finally block!";
}
// system('ls ' . escapeshellarg($_GET['path']);

$date = new DateTime('2008-07-01T22:35:17.02');//new DateTime('@1234567890');
$new_date_format = $date->format('Y-m-d H:i:s');
$now = new DateTime("2016-07-21 02:55:07");
$date = new DateTime();
// $date->setDate(2016, 7, 25);
var_dump($now <= $date); // prints bool(true)
$diff = $now->diff($date);
var_dump($now == $now); // prints bool(true)

$new_date_format = (new DateTime('2008-07-01T22:35:17.02'))->format('Y-m-d H:i:s');

$timestamp = bcdiv('1234567899000', '1000');
$timestamp = substr('1234567899000', -3);
#http://stackoverflow.com/documentation/php/topics?page=1&tab=popular
#http://stackoverflow.com/documentation/php/205/functional-programming-in-php#t=201609060949099311128
class StaticSquareHolder
{
    public static function square($number)
    {
        return $number * $number;
    }
}

$initial_array = [1, 2, 3, 4, 5];
$final_array = array_map(['StaticSquareHolder', 'square'], $initial_array);
// or:
$final_array = array_map('StaticSquareHolder::square', $initial_array); // for PHP >= 5.2.3

var_dump($final_array); // prints the new array with 1, 4, 9, 16, 25
// $final_array = array_map([(new squaredHolder), 'square'], $initial_array);

function isEven($int) {
    return ($item % 2) == 0;
}
array_filter($array, 'isEven');
// array_map('strtoupper', $array);

if (!function_exists('codepoint_encode')) {
    function codepoint_encode($str) {
        return substr(json_encode($str), 1, -1);
    }
}

if (!function_exists('codepoint_decode')) {
    function codepoint_decode($str) {
        return json_decode(sprintf('"%s"', $str));
    }
}
#http://stackoverflow.com/documentation/php/4472/unicode-support-in-php#t=201609060941458015713
echo "\nUse JSON encoding / decoding\n";
var_dump(codepoint_encode("我好"));
var_dump(codepoint_decode('\u6211\u597d'));
var_dump('\u6211\u597d');

var_dump(mb_chr(0x010F));
$string = "0| PHP 1| CSS 2| HTML 3| AJAX 4| JSON";

//[0-9]: Any single character in the range 0 to 9
// +   : One or more of 0 to 9
$array = preg_split("/[0-9]+\|/", $string, -1, PREG_SPLIT_NO_EMPTY);
//Or
// []  : Character class
// \d  : Any digit
//  +  : One or more of Any digit
$array = preg_split("/[\d]+\|/", $string, -1, PREG_SPLIT_NO_EMPTY);
class Singleton {
    public static function getInstance() {
        // Static variable $instance is not deleted when the function ends
        static $instance;

        // Second call to this function will not get into the if-statement,
        // Because an instance of Singleton is now stored in the $instance
        // variable and is persisted through multiple calls
        if (!$instance) {
            // First call to this function will reach this line,
            // because the $instance has only been declared, not initialized
            $instance = new Singleton();
        }

        return $instance;

    }
}

$instance1 = Singleton::getInstance();
$instance2 = Singleton::getInstance();

// Comparing objects with the '===' operator checks whether they are
// the same instance. Will print 'true', because the static $instance
// variable in the getInstance() method is persisted through multiple calls
var_dump($instance1 === $instance2);

function gen_one_to_three() {
    $keys = ["first", "second", "third"];

    for ($i = 1; $i <= 3; $i++) {
        // Note that $i is preserved between yields.
        yield $keys[$i - 1] => $i;
    }
}

foreach (gen_one_to_three() as $key => $value) {
    echo "$key: $value\n";
}
$myClosure = function() {
    echo $this->property;
};

class MyClass
{
    public $property;

    public function __construct($propertyValue)
    {
        $this->property = $propertyValue;
    }
}

$myInstance = new MyClass('Hello world!');
$myBoundClosure = $myClosure->bindTo($myInstance);

$myBoundClosure(); // Shows "Hello world!"
// $myClosure->call($myInstance); //php7 Shows "Hello world!"
// 
function createCalculator($quantity) {
    return function($number) use($quantity) {
        return $number + $quantity;
    };
}

$calculator1 = createCalculator(1);
$calculator2 = createCalculator(2);

var_dump($calculator1(2)); // Shows "3"
var_dump($calculator2(2)); // Shows "4"

$array = array(1, 2, 3, 4, 5);
array_walk($array, function(&$value, $key) {
    $value++;
});
$array = array(1, array(2, 3, array(4, 5), 6));
array_walk_recursive($array, function($value, $key) {
    echo $value . ' ';
});
// prints "1 2 3 4 5 6"


$numbers = [16,3,5,8,1,4,6];

$even_indexed_numbers = array_filter($numbers, function($index) {
    return $index % 2 === 0;
}, ARRAY_FILTER_USE_KEY);//16,5,1,6

// print_r(explode(',',$fruits,2)); // ['apple', 'pear,grapefruit,cherry']
// print_r(explode(',',$fruits,-1)); // ['apple', 'pear', 'grapefruit']
$myArray = array(
    'foo' => 'bar',
    'func' => function($elem) {
        echo $elem;
    }
);
$myArray['func']('I am a string....cool.');
call_user_func($myArray['func'], 'I am a string....cool.');
$parameters = ['foo' => 'bar', 'bar' => 'baz', 'boo' => 'bam'];
$allowedKeys = ['foo', 'bar'];
$filteredParameters = array_intersect_key($parameters, array_flip($allowedKeys));

// $filteredParameters contains ['foo' => 'bar', 'bar' => 'baz]
$result = array_reduce([10, 23, 211, 34, 25], function($carry, $item){
        return $item > $carry ? $item : $carry;//211
});

$result = array_reduce(["hello", "world", "PHP", "language"], function($carry, $item){
        return !$carry ? $item : $carry . "-" . $item ;
});//result:"hello-world-PHP-language"
// 所以值大于100http://stackoverflow.com/documentation/php/204/arrays#t=201609060609481550276
$result = array_reduce([101, 230, 210, 341, 251], function($carry, $item){
        return $carry && $item > 100;
}, true); //default value must set true

#SELECT * FROM users ORDER BY id ASC LIMIT 0, 2

#SELECT * FROM users ORDER BY id ASC LIMIT 2 默认从0开始
#SELECT * FROM users ORDER BY id ASC LIMIT 2 OFFSET 2 ;limit 2,2
// UPDATE myjson SET dict=JSON_ARRAY_APPEND(dict,'$.variations','scheveningen') WHERE id = 2;
/*
mysql> select @@long_query_time;
+-------------------+
| @@long_query_time |
+-------------------+
|          3.000000 |
+-------------------+
1 row in set (0.02 sec)
SELECT @@slow_query_log; -- Is capture currently active? (1=On, 0=Off)
SELECT @@slow_query_log_file; -- filename for capture. Resides in datadir
SELECT @@datadir; -- to see current value of the location for capture file

SET GLOBAL slow_query_log=0; -- Turn Off
ALTER TABLE your_table_name AUTO_INCREMENT = 101;
http://stackoverflow.com/documentation/mysql/2627/alter-table#t=201609070355296350997
SELECT username FROM users WHERE users LIKE 'admin_';
SELECT  st.name,
        st.percentage, 
        CASE WHEN st.percentage >= 35 THEN 'Pass' ELSE 'Fail' END AS `Remark` 
    FROM student AS st ;
SELECT  st.name,
        st.percentage, 
        IF(st.percentage >= 35, 'Pass', 'Fail') AS `Remark` 
    FROM student AS st ;

mysqladmin -uroot -p<password> drop <db1>
RENAME TABLE `<old name>` TO `<new name>`;
RENAME TABLE `<old db>`.`<name>` TO  `<new db>`.`<name>`;
ALTER TABLE fish_data.fish DROP PRIMARY KEY;

SELECT i, RAND() FROM t;
SELECT SQRT(16); -> 4
mysqldump -u root -p --host=localhost --opt --skip-lock-tables --single-transaction \
        --verbose --hex-blob --routines --triggers --all-databases |
    gzip -9 | s3cmd put - s3://s3-bucket/db-server-name.sql.gz
    mysqldump [options] > dump.sql
mysql [options] < dump.sql

SELECT c.CustomerName, COUNT(*) AS 'Order Count'
    FROM Customers AS c
    INNER JOIN Orders AS o
        ON c.CustomerID = o.CustomerID
    GROUP BY c.CustomerID;
    ORDER BY c.CustomerName;

    SELECT  c.CustomerName,
        ( SELECT COUNT(*) FROM Orders WHERE CustomerID = c.CustomerID ) AS 'Order Count'
    FROM Customers AS c
    ORDER BY c.CustomerName;

    SELECT  c.CustomerName,
    FROM Customers AS c
    WHERE EXISTS ( SELECT * FROM Orders WHERE CustomerID = c.CustomerID )
    ORDER BY c.CustomerName;

    DROP INDEX idx_name ON my_table;
GRANT ALL PRIVILEGES ON my_db.* TO 'my_new_user@localhost' identified by 'my_password';
select '123ABC' * 2;246
SELECT student_name, AVG(test_score) FROM student GROUP BY `group`
$ mysql -uroot -proot test -e'select * from people'
$ mysql -uroot -proot test -s -e'select * from people' > out.txt
$ mysql -uroot -proot test -e'source my_script.sql'
sudo mysqld_safe --skip-grant-tables &
SET PASSWORD FOR 'root'@'localhost' = PASSWORD('new_password');
FLUSH PRIVILEGES;

ORDER BY FIND_IN_SET(card_type, "MASTER-CARD,VISA,DISCOVER") -- sort 'MASTER-CARD' first.
ORDER BY x IS NULL, x  -- order by `x`, but put `NULLs` last.
SELECT * FROM some_table WHERE id IN (118, 17, 113, 23, 72) 
ORDER BY FIELD(id, 118, 17, 113, 23, 72);
http://stackoverflow.com/documentation/mysql/1487/delete#t=201609070355267903708
DELETE p2
FROM pets p2
WHERE p2.ownerId in (
    SELECT p1.id
    FROM people p1
    WHERE p1.name = 'Paul')

DELETE p2    -- remove only rows from pets
FROM people p1
JOIN pets p2
ON p2.ownerId = p1.id
WHERE p1.name = 'Paul';



*/



$i = 1;$sum=2;
while ($i<234) {
        $sum++;
if ($sum % 2 == 0  || $sum % 3 == 0) {
        $i++;
}
}
// http://www.qlcoder.com/task/751e
$num=2;$i=0;$arr=[];

while($num++){
 if($num %2==0||$num%3==0){
   $i++;$arr[]=$num;
   if($i==2332) {
   break;
   }
 }
}
//var_dump($arr);
echo $num.'<br>';echo $i;

$bom = trim($bom, "\xEF\xBB\xBF");
// http://www.thinkphp.cn/code/1423.html
   function base64_upload($base64) {
    $base64_image = str_replace(' ', '+', $base64);
    //post的数据里面，加号会被替换为空格，需要重新替换回来，如果不是post的数据，则注释掉这一行
    //PHP解析GET参数时，会经过过滤，即urldecode()处理，而urldecode会解码给出的已编码字符串中的任何 %##。 加号（'+'）被解码成一个空格字符。
    //解决方法：传递参数时，对GET参数进行url编码，注意最好不使用urlencode()，否则会编码空格为+。应参考RFC 1738对url进行编码，使用rawurlencode()，将加号编码为 。这样上面例子中param=abc百分20百分2B，php接收到的param才会是abc +
    //另外POST方式会 使用application/x-www-form-urlencoded此编码编码body中的数据，所以不会出现上述例子中的问题。
    //字符串base64后传输之前可以先把“+”号替换掉，用“_”,“|”等等都可以，然后另一个页面接收的时候再替换过来即可（str_replace）。最后把替换之后的base64再解码。ok
    //https://iyaozhen.com/post-get-urlcode.html
    //重定向后的地址中加密后的name参数，其中包含“+”符号，而浏览器的地址栏中碰到“+”符号时会将加号转换为空格，于是要保证base64_decode进行正确的解码操作，我们可以先将参数中的空格替换成加号
    ////在实际开发中，我们很多时候要构造这种URL，这是没有问题的
$url_decode    ="jellybool.com?username=jelly&bool&password=jelly";
/*注意上面两个变量的差别：第一个的username=jellybool，
                        第二个为username=jelly&bool
这种情况下用$_GET()来接受是会出问题的，这是可以用下面的方法解决 
*/
$username="jelly&bool";
$url_decode    ="jellybool.com?username=".urlencode($username)."&password=jelly";
//这是可以很好的解决问题
    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image, $result)){
        //匹配成功
        if($result[2] == 'jpeg'){
            $image_name = uniqid().'.jpg';
            //纯粹是看jpeg不爽才替换的
        }else{
            $image_name = uniqid().'.'.$result[2];
        }

        $image_file = "./upload/test/{$image_name}";
        //服务器文件存储路径
        if (file_put_contents($image_file, base64_decode(str_replace($result[1], '', $base64_image)))){
            return $image_name;
        }else{
            return false;
        }
    }else{
        return false;
    }
 }
 /**
 * 对象数组转为普通数组
 * JSON字串经decode解码后为一个对象数组，
 * 为此必须转为普通数组后才能进行后续处理
 * 此函数支持多维数组处理。
 *
 * @param array
 * return array
 */
 function objarray_to_array($obj){
    $ret = array();
    foreach ($obj as $key => $value) {
        if (gettype($value) == "array" || gettype($value) == "object") {
            $ret[$key] = objarray_to_array($value);
        } else {
            $ret[$key] = $value;
        }
    }
    return $ret;
 }
 // php获取一个月的第一天和最后一天
 $date = date('Y-m-d H:i:s'); //当前时间
 function getthemonth($date)
 {
    $firstday = date('Y-m-01', strtotime($date));
    $lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day"));
    return array($firstday, $lastday);
 }
$firstday= date('Y-m-d', mktime(0, 0, 0, date('m'), 1));
$lastday =date('Y-m-d', mktime(0, 0, 0,date('m')+1,1)-1);
echo cal_days_in_month(CAL_GREGORIAN,5,2016); //一个月天数,也就是最后一天 第一天 永远是1
echo date('Y-m-t');//最后一天
// ignore_user_abort();
 //即使Client断开(如关掉浏览器)，PHP脚本也可以继续执行.
set_time_limit(0);
/*$interval=60*5;
 do{
$fp= fopen("test.txt","a");
fwrite($fp,"rn".date('Y-m-d H:i:s',time())."rn");
fclose($fp);
sleep($interval);
 }while(true);*/
echo '<pre>';
$prize_arr = array( 
    '0' => array('id' => 1, 'prize' => '一等奖', 'v' => 5), 
    '1' => array('id' => 2, 'prize' => '二等奖', 'v' => 5), 
    '2' => array('id' => 3, 'prize' => '三等奖', 'v' => 5), 
    '3' => array('id' => 4, 'prize' => '四等奖', 'v' => 5), 
    '4' => array('id' => 5, 'prize' => '五等奖', 'v' => 5), 
    '5' => array('id' => 6, 'prize' => '六等奖', 'v' => 5), 
    '6' => array('id' => 7, 'prize' => '七等奖', 'v' => 5), 
    '7' => array('id' => 8, 'prize' => '八等奖', 'v' => 5), 
    '8' => array('id' => 9, 'prize' => '九等奖', 'v' => 5), 
    '9' => array('id' => 10, 'prize' => '十等奖', 'v' => 5), 
    '10' => array('id' => 11, 'prize' => '十一等奖', 'v' => 25), 
    '11' => array('id' => 12, 'prize' => '十二等奖', 'v' => 25), 
 );
foreach ($prize_arr as $k=>$v) { 
    $arr[$v['id']] = $v['v']; 
 
 } 
 
$prize_id = getRand($arr); //根据概率获取奖项id  
 foreach($prize_arr as $k=>$v){ //获取前端奖项位置 
    if($v['id'] == $prize_id){ 
     $prize_site = $k; 
     break; 
    } 
 } 
$res = $prize_arr[$prize_id - 1]; //中奖项  http://www.thinkphp.cn/code/1240.html
 
$data['prize_name'] = $res['prize']; 
$data['prize_site'] = $prize_site;//前端奖项从-1开始 

print_r($data);
// echo getipinfo();
if (get_magic_quotes_gpc()){//magic_quotes_gpc是否为ON
        // $value = stripslashes($value);
    }
$week_this_monday =strtotime('last Monday'); //本周一
$tomorrow =strtotime("+1 day");//明天
echo $week_last_monday = strtotime('last Monday') - 3600 * 24 * 7; //上周一
echo $week_last_sunday =strtotime('last Monday')- 3600 * 24; //上周日

function getipinfo(){
    header("Content-Type:text/html;   charset=utf-8");
    $url = 'http://1111.ip138.com/ic.asp';  //这儿填页面地址
    $info=file_get_contents($url);
    $p = "%<center>(.*?)</center>%si";
    preg_match_all($p, $info, $arr);
    
    $info=$arr[1];
    $str1 = explode("[",iconv('GB2312', 'UTF-8',$info[0]));
    $str2 = explode("]",$str1[1]);
    $ip=$str2[0].'_'.substr($str2[1],10);
    return $ip;
 }

// $pic = file_get_contents ( 'php://input' ) ? file_get_contents ( 'php://input' ) : gzuncompress ( $GLOBALS ['HTTP_RAW_POST_DATA'] );
$imgName = time();
$file_dir="images/".$imgName.".jpg";
/*
if($fp = fopen($file_dir,'w')){

	if(fwrite($fp,$content)){
	fclose($fp);
	}
}*/
 // var_dump(validateIDCard(''));
 //验证身份证是否有效
function validateIDCard($IDCard) {
    if (strlen($IDCard) == 18) {
        return check18IDCard($IDCard);
    } elseif ((strlen($IDCard) == 15)) {
        $IDCard = convertIDCard15to18($IDCard);
        return check18IDCard($IDCard);
    } else {
        return false;
    }
}
/**
 * 获取客户端IP地址
 * @return string
 */
function get_client_ip() { 
    if(getenv('HTTP_CLIENT_IP')){ 
        $client_ip = getenv('HTTP_CLIENT_IP'); 
    } elseif(getenv('HTTP_X_FORWARDED_FOR')) { 
        $client_ip = getenv('HTTP_X_FORWARDED_FOR'); 
    } elseif(getenv('REMOTE_ADDR')) {
        $client_ip = getenv('REMOTE_ADDR'); 
    } else {
        $client_ip = $_SERVER['REMOTE_ADDR'];
    } 
    return $client_ip; 
}   
/**
* 获取服务器端IP地址
 * @return string
 */
function get_server_ip() { 
    if (isset($_SERVER)) { 
        if($_SERVER['SERVER_ADDR']) {
            $server_ip = $_SERVER['SERVER_ADDR']; 
        } else { 
            $server_ip = $_SERVER['LOCAL_ADDR']; 
        } 
    } else { 
        $server_ip = getenv('SERVER_ADDR');
    } 
    return $server_ip; 
}
//计算身份证的最后一位验证码,根据国家标准GB 11643-1999
function calcIDCardCode($IDCardBody) {
    if (strlen($IDCardBody) != 17) {
        return false;
    }

    //加权因子 
    $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
    //校验码对应值 
    $code = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
    $checksum = 0;

    for ($i = 0; $i < strlen($IDCardBody); $i++) {
        $checksum += substr($IDCardBody, $i, 1) * $factor[$i];
    }

    return $code[$checksum % 11];
}

// 将15位身份证升级到18位 
function convertIDCard15to18($IDCard) {
    if (strlen($IDCard) != 15) {
        return false;
    } else {
        // 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码 
        if (array_search(substr($IDCard, 12, 3), array('996', '997', '998', '999')) !== false) {
            $IDCard = substr($IDCard, 0, 6) . '18' . substr($IDCard, 6, 9);
        } else {
            $IDCard = substr($IDCard, 0, 6) . '19' . substr($IDCard, 6, 9);
        }
    }
    $IDCard = $IDCard . calcIDCardCode($IDCard);
    return $IDCard;
}

// 18位身份证校验码有效性检查 
function check18IDCard($IDCard) {
    if (strlen($IDCard) != 18) {
        return false;
    }

    $IDCardBody = substr($IDCard, 0, 17); //身份证主体
    $IDCardCode = strtoupper(substr($IDCard, 17, 1)); //身份证最后一位的验证码

    if (calcIDCardCode($IDCardBody) != $IDCardCode) {
        return false;
    } else {
        return true;
    }
}
// 下一篇文章$query = mysql_query("SELECT id,title FROM article WHERE id>'$id' ORDER BY id ASC LIMIT 1"); 
// $next = mysql_fetch_array($query);
    #TODO case:http://www.thinkphp.cn/code/1427.html
    $aData = array(
        array('id'=>1,'name'=>'名称1'),
        array('id'=>2,'name'=>'名称2'),
        array('id'=>3,'name'=>'名称3'),
    );
    $aTitle = array(
        array('id','标记'),
        array('name','名称'),
    );
    // exportCSV($aData, $aTitle);

 function exportCSV($aData = [], $aTitle = [], $sFileName=false)
 {
    if (!is_array($aData) || !is_array($aTitle))
        return false;
    if (empty($aData) || empty($aTitle))
        return false;
    $sFileName = $sFileName ? mb_convert_encoding($sFileName, "GB2312", "UTF-8, GB2312") . ".csv": date("_YmdHis") . ".csv";
    
    header('Content-Type: text/csv; CHARSET=gb2312');
    header('Content-Disposition: attachment; filename=' . $sFileName);
    $output = fopen('php://output', 'w');
    
    for ($i=0;$i<count($aData);$i++) {
        for($j=0;$j<count($aTitle);$j++){
            $aList[$i][$j] = mb_convert_encoding($aData[$i][$aTitle[$j][0]], "GB2312", "UTF-8, GB2312");
        }
    }
    for ($i=0;$i<count($aTitle);$i++) {
        $aTitle[$i] = mb_convert_encoding($aTitle[$i][1], "GB2312", "UTF-8, GB2312");
    }
    fputcsv($output, $aTitle);
    
    foreach ($aList as $key) {
        fputcsv($output, $key);
    }
    return true;
 }
 /**
     * @name php获取中文字符拼音首字母
     * @param $str
     * @return null|string
     * @author 潘军伟<panjunwei@ruiec.cn>
     * @time 2015-09-14 17:58:14
     */
     function getFirstCharter($str)
    {
        if (empty($str)) {
            return '';
        }
        $fchar = ord($str{0});
        if ($fchar >= ord('A') && $fchar <= ord('z')) return strtoupper($str{0});
        $s1 = iconv('UTF-8', 'gb2312', $str);
        $s2 = iconv('gb2312', 'UTF-8', $s1);
        $s = $s2 == $str ? $s1 : $str;
        $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
        if ($asc >= -20319 && $asc <= -20284) return 'A';
        if ($asc >= -20283 && $asc <= -19776) return 'B';
        if ($asc >= -19775 && $asc <= -19219) return 'C';
        if ($asc >= -19218 && $asc <= -18711) return 'D';
        if ($asc >= -18710 && $asc <= -18527) return 'E';
        if ($asc >= -18526 && $asc <= -18240) return 'F';
        if ($asc >= -18239 && $asc <= -17923) return 'G';
        if ($asc >= -17922 && $asc <= -17418) return 'H';
        if ($asc >= -17417 && $asc <= -16475) return 'J';
        if ($asc >= -16474 && $asc <= -16213) return 'K';
        if ($asc >= -16212 && $asc <= -15641) return 'L';
        if ($asc >= -15640 && $asc <= -15166) return 'M';
        if ($asc >= -15165 && $asc <= -14923) return 'N';
        if ($asc >= -14922 && $asc <= -14915) return 'O';
        if ($asc >= -14914 && $asc <= -14631) return 'P';
        if ($asc >= -14630 && $asc <= -14150) return 'Q';
        if ($asc >= -14149 && $asc <= -14091) return 'R';
        if ($asc >= -14090 && $asc <= -13319) return 'S';
        if ($asc >= -13318 && $asc <= -12839) return 'T';
        if ($asc >= -12838 && $asc <= -12557) return 'W';
        if ($asc >= -12556 && $asc <= -11848) return 'X';
        if ($asc >= -11847 && $asc <= -11056) return 'Y';
        if ($asc >= -11055 && $asc <= -10247) return 'Z';
        return null;
    }

// $redis=new redis();

// $redis->connect('127.0.0.1','6379');





// print_r($redis->zRevRange('topward100', 0, 4, 'WITHSCORES'));

 
// Route::get('posts/{post_id}', function ($postId) {
    //
// });

require_once 'phpanalysis/phpanalysis.class.php';
$str = "PHPAnalysis分词系统是基于字符串匹配的分词方法进行分词的，这种方法又叫做机械分词方法，它是按照一定的策略将待分析的汉字串与 一个“充分大的”机器词典中的词条进行配，若在词典中找到某个字符串，则匹配成功（识别出一个词）。按照扫描方向的不同，串匹配分词方法可以分为正向匹配 和逆向匹配；按照不同长度优先匹配的情况，可以分为最大（最长）匹配和最小（最短）匹配；按照是否与词性标注过程相结合，又可以分为单纯分词方法和分词与 标注相结合的一体化方法。常用的几种机械分词方法如下： ";
  $pa=new PhpAnalysis();
// http://www.cnblogs.com/xshang/p/3603037.html
  $pa->SetSource($str);

  $pa->resultType=2;

  $pa->differMax=true;

  $pa->StartAnalysis();

  $arr=$pa->GetFinallyIndex();
// print_r(count_chars($str,1));
 function is_assoc_array($array)
{
    return array_keys($array) !== range(0, count($array) - 1);
}
var_dump("0x123" == "291");

var_dump(is_numeric("0x123"));
final class Product
{

    /**
     * @var self
     */
    private static $instance;

    /**
     * @var mixed
     */
    public $mix;


    /**
     * Return self instance
     *
     * @return self
     */
    public static function getInstance() {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
    }

    private function __clone() {
    }
}

$firstProduct = Product::getInstance();
$secondProduct = Product::getInstance();

$firstProduct->mix = 'test';
$secondProduct->mix = 'example';

print_r($firstProduct->mix);
// example
print_r($secondProduct->mix);
// example
$i = '100';
$result = filter_var(
    $i,

    FILTER_VALIDATE_INT,
    //设定校验的数值范围
    array(
      'options' => array('min_range' => 1, 'max_range' => 10)
    )
);
var_dump($result);//bool(false)
$str =2228282829299292;
 //失败
echo (string)$str;  //2.2282828292993E+15  失败
echo '<br>';
echo ' '.$str; //2.2282828292993E+15
echo '<br>';
echo strval($str); //2.2282828292993E+15
echo '<br>';
 //成功
echo sprintf("%.0f", $str);
echo '<br>';
echo number_format($str);// 三位逗号分隔
  // print_r($arr);
/**
     * 函数说明：验证身份证是否真实
     * 注：加权因子和校验码串为互联网统计  尾数自己测试11次 任意身份证都可以通过
     * 传递参数：
     * $number身份证号码
     * 返回参数：http://www.thinkphp.cn/code/1873.html
     * true验证通过
     * false验证失败
     */
    function isIdCard($number) {
        $sigma = '';
        //加权因子 
        $wi = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
        //校验码串 
        $ai = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
        //按顺序循环处理前17位 
        for ($i = 0;$i < 17;$i++) { 
            //提取前17位的其中一位，并将变量类型转为实数 
            $b = (int) $number{$i}; 
            //提取相应的加权因子 
            $w = $wi[$i]; 
            //把从身份证号码中提取的一位数字和加权因子相乘，并累加 得到身份证前17位的乘机的和 
            $sigma += $b * $w;
        }
    //echo $sigma;die;
        //计算序号  用得到的乘机模11 取余数
        $snumber = $sigma % 11; 
        //按照序号从校验码串中提取相应的余数来验证最后一位。 
        $check_number = $ai[$snumber];
        if ($number{17} == $check_number) {
            return true;
        } else {
            return false;
        }
    }
    //eg
    if (!isIdCard('000000000000000001')) {
    echo "身份证号码不合法";
    } else {
    echo "身份证号码正确";
    }
/**
 * 数字到字母列
 * @author rainfer <81818832@qq.com>
 */
 function num2alpha($intNum, $isLower = false)
 {
    $num26 = base_convert($intNum, 10, 26);
    $addcode = $isLower ? 49 : 17;
    $result = '';
    for ($i = 0; $i < strlen($num26); $i++) {
        $code = ord($num26{$i});
        if ($code < 58) {
            $result .= chr($code + $addcode);
        } else {
            $result .= chr($code + $addcode - 39);
        }
    }
    return $result;
 }
echo num2alpha(6546);
$str =2228282829299292;
 //失败
echo (string)$str;  //2.2282828292993E+15  失败
echo '<br>';
echo ' '.$str; //2.2282828292993E+15
echo '<br>';
echo strval($str); //2.2282828292993E+15
echo '<br>';
 //成功
echo sprintf("%.0f", $str);
echo '<br>';
echo number_format($str);// 三位逗号分隔

$string="I Love 黑帽联盟www.heimaolianmeng.com";
echo preg_replace("/([\x80-\xff]+)/","<font color=red>\\1</font>",$string);

 /**
     * 生成唯一订单号
     */
     function build_order_no()
    {
        $no = date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
        //检测是否存在
        $db = M('Order');
        $info = $db->where(array('number'=>$no))->find();
        (!empty($info)) && $no = $this->build_order_no();
        return $no;
        
    }
    // 获取远程文件的大小
function remote_filesize($url, $user = "", $pw = "")
{
	ob_start();
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_NOBODY, 1);

	if(!empty($user) && !empty($pw))
	{
	$headers = array('Authorization: Basic ' . base64_encode("$user:$pw"));
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	}

	$ok = curl_exec($ch);
	curl_close($ch);
	$head = ob_get_contents();
	ob_end_clean();

	$regex = '/Content-Length:\s([0-9].+?)\s/';
	$count = preg_match($regex, $head, $matches);

	return isset($matches[1]) ? $matches[1] . " 字节" : "unknown";
}
/**
 * 舍去法取整 版本的 number_format() 函数
 * @author leeyi <leeyisoft@qq.com>
 */
 function number_format_floor($number, $decimals=0, $dec_point='.', $thousands_sep=',') {
    $tmp = pow(10,$decimals);
    return number_format(floor($tmp*($number))/$tmp, $decimals, $dec_point, $thousands_sep);
 }
 $url = 'https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token=xxxxx';
parse_str(parse_url($url, PHP_URL_QUERY), $data);
echo $data['access_token'];
  function upload(){
        $base64 = I('post.str');
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64, $result)){
          $type = $result[2];
          $new_file = "./Uploads/".time().".{$type}";
          if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64)))){
            echo '新文件保存成功：', $new_file;
          }
         }
 }
// 实例测试
// echo remote_filesize("http://www.heimaolianmeng.com/luoyue/images/logo3.jpg");

function login()
{
	$curl = curl_init();
	// 在系统临时目录中生成一个文件，并返回其文件名
	$cookie_jar = tempnam('./tmp','cookie');echo $cookie_jar;
	curl_setopt($curl, CURLOPT_URL,'http://t.vhall.com/auth/login');//这里写上处理登录的界面
	curl_setopt($curl, CURLOPT_POST, 1);
	$request = 'account=lsp&password=123456';
	curl_setopt($curl, CURLOPT_POSTFIELDS, $request);//传 递数据
	curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_jar);// 把返回来的cookie信息保存在$cookie_jar文件中
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//设定返回 的数据是否自动显示
	curl_setopt($curl, CURLOPT_HEADER, false);//设定是否显示头信 息
	curl_setopt($curl, CURLOPT_NOBODY, false);//设定是否输出页面 内容
	curl_exec($curl);//返回结果
	curl_close($curl); //关闭
	 
	$curl2 = curl_init();
	curl_setopt($curl2, CURLOPT_URL, 'http://t.vhall.com/user/message/?page=1');//登陆后要从哪个页面获取信息
	curl_setopt($curl2, CURLOPT_HEADER, false);
	curl_setopt($curl2, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl2, CURLOPT_COOKIEFILE, 'C:\Users\vhalllsp\AppData\Local\Temp\coo436E.tmp');
	$content = curl_exec($curl2);
	return $content;
}
function getImage($url,$save_dir='',$filename='',$type=0){
            if(trim($url)==''){
                return array('file_name'=>'','save_path'=>'','error'=>1);
            }
            if(trim($save_dir)==''){
                $save_dir='./';
            }
            if(trim($filename)==''){//保存文件名
                $ext=strrchr($url,'.');
            if($ext!='.gif'&&$ext!='.jpg'&&$ext!='.png'&&$ext!='.jpeg'){
                return array('file_name'=>'','save_path'=>'','error'=>3);
            }
                $filename=time().rand(0,10000).$ext;
            }
            if(0!==strrpos($save_dir,'/')){
                $save_dir.='/';
            }
            //创建保存目录
            if(!file_exists($save_dir)&&!mkdir($save_dir,0777,true)){
                return array('file_name'=>'','save_path'=>'','error'=>5);
            }
            //获取远程文件所采用的方法
            if($type){
                $ch=curl_init();
                $timeout=5;
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
                //当请求https的数据时，会要求证书，加上下面这两个参数，规避ssl的证书检查
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE );
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                $img=curl_exec($ch);
                curl_close($ch);
            }else{
                ob_start();
                readfile($url);
                $img=ob_get_contents();
                ob_end_clean();
            }
            //$size=strlen($img);
            //文件大小
            $fp2=@fopen($save_dir.$filename,'a');
            fwrite($fp2,$img);
            fclose($fp2);
            unset($img,$url);
            return array('file_name'=>$filename,'save_path'=>$save_dir.$filename,'error'=>0);
        }
// print_r(login());
// http://www.thinkphp.cn/code/1761.html
function hideStar($str) { //用户名、邮箱、手机账号中间字符串以*隐藏 
    if (strpos($str, '@')) { 
        $email_array = explode("@", $str); 
        $prevfix = (strlen($email_array[0]) < 4) ? "" : substr($str, 0, 3); //邮箱前缀 
        $count = 0; 
        $str = preg_replace('/([\d\w+_-]{0,100})@/', '***@', $str, -1, $count); 
        $rs = $prevfix . $str; 
    } else { 
        $pattern = '/(1[3458]{1}[0-9])[0-9]{4}([0-9]{4})/i'; 
        if (preg_match($pattern, $str)) { 
            $rs = preg_replace($pattern, '$1****$2', $str); // substr_replace($name,'****',3,4); 
        } else { 
            $rs = substr($str, 0, 3) . "***" . substr($str, -1); 
        } 
    } 
    return $rs; 
 }

/** +----------------------------------------------------------
 * 过滤用户昵称里面的emoji特殊字符 +----------------------------------------------------------
 * @param string    $str   待输出的用户昵称 +----------------------------------------------------------
 */
 function jsonName($str) {
    if($str){
        $tmpStr = json_encode($str);
        $tmpStr2 = preg_replace("#(\\\ud[0-9a-f]{3})#ie","",$tmpStr);
        $return = json_decode($tmpStr2);
        if(!$return){
            return jsonName($return);
        }
    }else{
        $return = '微信用户-'.time();
    }    
    return $return;
 }
  #修改数据库编码
#ALTER DATABASE database_name CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;
 
 #修改表
#ALTER TABLE table_name CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
 
 #修改列
#ALTER TABLE table_name CHANGE column_name column_name VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
// 微信红包算法
print_r(getRand([4,7,2,8,1]));
 function getRand($proArr) { //传入的为一维数字数组,此数组中数字即为相应概率 中奖概率问题应
        $result = '';
        //概率数组的总概率精度
        $proSum = array_sum($proArr);
        //概率数组循环
        foreach ($proArr as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        unset ($proArr);
        return $result;
    }
    //通过接口获取所在地址IP 根据IP查询经纬度
         function is_where($getIp='106.2.187.202'){
            // header("content-type:text/html;charset=utf8");
            $content = file_get_contents("http://api.map.baidu.com/location/ip?ak=7IZ6fgGEGohCrRKUE9Rj4TSQ&ip={$getIp}&coor=bd09ll");
            //echo $getIp;die;
            $json = json_decode($content);
            $arr = array($json->{'content'}->{'point'}->{'x'},$json->{'content'}->{'point'}->{'y'}, $json->{'content'}->{'address'});//按层级关系提取经度数据
            return json_encode($arr);
        } print_r(is_where());
function actionDlresume(){
        
        //数据查询http://www.thinkphp.cn/code/1654.html  将内容放到word文档city_name
            $re=['u_name'=>'php','g_sex'=>'na','school_type'=>1,'work_year'=>10,'g_school'=>'66','city_name'=>'ggg','work_email'=>'hhh','work_phone'=>'888','work_type'=>'555','edutation'=>'888','g_workj'=>'333','g_zuo'=>'000'];
            // print_r($re);die;
            $html ='<table width=800  align="center"  border="1" cellpadding="0" cellspacing="1" >
    <tr height="50"> 
      <td width=70 > 姓名</td> 
      <td width=300 >  '.$re['u_name'].'</td> 
      <td width=60 >性别</td> 
      <td width=100 >'.$re['g_sex'].'</td> 
      <td width=100 >学历</td> 
      <td width=240 >'.$re['school_type'].'</td> 
    </tr> 
    <tr> 
      <td width=70 >工作时间</td> 
      <td width=40 >'.$re['work_year'].'</td> 
      <td width=40 >毕业<br/>学校</td> 
      <td width=150 >'.$re['g_school'].'</td> 
      <td width=40 >所在<br/>城市</td> 
      <td width=390 >'.$re['city_name'].'</td> 
    </tr> 
    <tr> 
      <td width=110 >联系邮箱</td> 
      <td width=200 >'.$re['work_email'].'</td> 
      <td width=110 >联系<br/>电话</td> 
      <td width=280 >'.$re['work_phone'].'</td>
      <td width=110 >当前<br/>状态</td> 
      <td width=280 >'.$re['work_type'].'</td>
    </tr> 
    <tr> 
      <td width=120 ><br/><br/>教育<br/>背景<br/><br/></td> 
      <td width=580 >'.$re['edutation'].'</td>     
    </tr> 
    <tr> 
      <td width=120 ><br/><br/>工作<br/>经历<br/><br/></td> 
      <td width=580 >'.$re['g_workj'].'</td>     
    </tr> 
    <tr> 
      <td width=120 ><br/><br/><br/>作品<br/>展示<br/><br/><br/><br/></td> 
      <td width=580 >'.$re['g_zuo'].'</td> 
    </tr> 
    </table> <br/><br/><br/><br/>
';
 
 // print_r($html);die;
     // $word->start();
     
     ob_start();
        echo "<html xmlns:o='urn:schemas-microsoft-com:office:office'
        xmlns:w='urn:schemas-microsoft-com:office:word'
        xmlns='http://www.w3.org/TR/REC-html40'>";
     
     echo $html;
     echo "</html>";
      // $word->save($filename);
      $data = ob_get_contents();
      // print_r($data);die;
      // die;
        ob_end_clean();
        $filename = $re['u_name'].'.doc';
        $fp=fopen($filename,"wb");
        fwrite($fp,$data);
        fclose($fp);
      //文件的类型
      header('Content-type: application/word');
      header("Content-Disposition: attachment; filename=".$filename);
      readfile($filename);
      ob_flush();
      flush();
     exit();
    
    } 
        $sum = 10;  //总价钱
 
        $num = 8 ;  //人数
 
        $min = 0.01;    //最少值
 
        for($i=1;$i<$num;$i++){
 
            $row = ($sum-($num-$i)*$min)/($num-$i);// 安全值
 
            $money = mt_rand($min*100,$row*100)/100;
 
            $sum -= $money;
 
            echo '第'.$i.'人，领取'.$money.'元，剩下'.$sum.'元<br/>';
 
        }
 
        echo '第'.$num.'人，领取'.$sum.'元，剩下'.$sum.'元';

function get_rand($arr){
 
            $arr_sum = array_sum($arr);
 
            $arr_rand = mt_rand(1,$arr_sum);
 
            foreach($arr as $key => $arr_num){
 
                $arr_sum -= $arr_num;
 
                if($arr_rand>$arr_sum){
 
                    return $key;
 
                }
 
            }
 
        }
 
        $p = array(
 
            '0' => array('id'=>1,'info'=>'一等奖','v'=>1),
 
            '1' => array('id'=>2,'info'=>'二等奖','v'=>5),
 
            '2' => array('id'=>3,'info'=>'三等奖','v'=>10),
 
            '3' => array('id'=>4,'info'=>'四等奖','v'=>34)
 
            );
 
        foreach($p as $key => $value){
 
            $arr[$value['id']] = $value['v'];
 
        }
 
        $rid = get_rand($arr);
 
        $res['yes'] = $p[$rid-1]['info'];
 
        unset ($p[$rid-1]) ;
 
        shuffle ($p);
 
        for($i=0;$i<count($p);$i++){
 
            $pr[]= $p[$i]['info'];
 
        }
 
        $res['no'] = $pr;
 
        var_dump($res);
class Curl {

	private static $user_cookie = '_za=9940ad75-d123-421d-bba5-4';

	/**
	 * [request 执行一次curl请求]
	 * @param  [string] $method     [请求方法]
	 * @param  [string] $url        [请求的URL]
	 * @param  array  $fields     [执行POST请求时的数据]
	 * @return [stirng]             [请求结果]
	 */
	public static function request($method, $url, $fields = array())
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_COOKIE, self::$user_cookie);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		if ($method === 'POST')
		{
			curl_setopt($ch, CURLOPT_POST, true );
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		}
		$result = curl_exec($ch);
		return $result;
	}

	/**
	 * [getMultiUser 多进程获取用户数据]
	 * @param  [type] $user_list [description]
	 * @return [type]            [description]
	 */
	public static function getMultiUser($user_list)
	{
		$ch_arr = array();
		$text = array();
		$len = count($user_list);
		$max_size = ($len > 5) ? 5 : $len;
		$requestMap = array();

		$mh = curl_multi_init();
		for ($i = 0; $i < $max_size; $i++)
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_URL, 'http://www.zhihu.com/people/' . $user_list[$i] . '/about');
			curl_setopt($ch, CURLOPT_COOKIE, self::$user_cookie);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$requestMap[$i] = $ch;
			curl_multi_add_handle($mh, $ch);
		}

		$user_arr = array();
		do {
			while (($cme = curl_multi_exec($mh, $active)) == CURLM_CALL_MULTI_PERFORM);
			
			if ($cme != CURLM_OK) {break;}

			while ($done = curl_multi_info_read($mh))
			{
				$info = curl_getinfo($done['handle']);
				$tmp_result = curl_multi_getcontent($done['handle']);
				$error = curl_error($done['handle']);

				$user_arr[] = array_values(getUserInfo($tmp_result));

				//保证同时有$max_size个请求在处理
				if ($i < sizeof($user_list) && isset($user_list[$i]) && $i < count($user_list))
                {
                	$ch = curl_init();
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_URL, 'http://www.zhihu.com/people/' . $user_list[$i] . '/about');
					curl_setopt($ch, CURLOPT_COOKIE, self::$user_cookie);
					curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36');
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
					$requestMap[$i] = $ch;
					curl_multi_add_handle($mh, $ch);

                    $i++;
                }

                curl_multi_remove_handle($mh, $done['handle']);
			}

			if ($active)
                curl_multi_select($mh, 10);
		} while ($active);

		curl_multi_close($mh);
		return $user_arr;
	}

}


?>
<script type="text/javascript">
function deepReverse(arr){
    arr.reverse().map( elem => {
        if(Array.isArray(elem)){
            return deepReverse(elem);
        }
    });
};
var arr = [1, 2, 3, [1, 2, 3, ['a', 'b', 'c']]];

deepReverse(arr);

arrayToClone = [1, 2, 3, 4, 5];
clone1 = Array.from(arrayToClone);
clone2 = Array.of(...arrayToClone);
clone3 = [...arrayToClone] // the shortest way
clone1 = Array.prototype.slice.call(arrayToClone);
clone2 = [].slice.call(arrayToClone);
function wait(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));  
}

wait(5000).then(() => { 
    console.log('5 seconds have passed...');
});
function myPerformanceCritcalFunction() {
    try {
        doCalculations();
    } catch (e) {
        console.log(e);
    }
}

var list = document.getElementById("list");
var html = "";
for(var i = 1; i <= 5; i++) {
    html += `<li>item ${i}</li>`;
}
list.innerHTML = html;
var fragment = document.createDocumentFragment();
console.time("t");
let t0 = Date.now(); //stores current Timestamp in milliseconds since 1 January 1970 00:00:00 UTC
let arr = []; //store empty array
for (let i = 0; i < 10; i++) { //1 million iterations
   arr.push(i); //push current i value
}
console.log(Date.now() - t0); 
console.timeEnd("t");
function fact(num) {
  return (num === 0)? 1 : num * fact(num - 1);
}
class Something {
    constructor(data) {
        this.data = data
    }

    doSomething(text) {
        return {
            data: this.data,
            text
        }
    }
}

var s = new Something({})
s.doSomething("hi") // returns: { data: {}, text: "hi" }

class SuperClass {

    constructor() {
        this.logger = console.log;
    }

    log() {
        this.logger(`Hello ${this.name}`);
    }

}

class SubClass extends SuperClass {

    constructor() {
        super();
        this.name = 'subclass';
    }

}

const subClass = new SubClass();

subClass.log(); // logs: "Hello subclass"

const AnimalSays = {
    dog () {
        return 'woof';
    },

    cat () {
        return 'meow';
    },

    lion () {
        return 'roar';
    },

    // ... other animals

    default () {
        return 'moo';
    }
};
function makeAnimalSpeak (animal) {
    // Match the animal by type
    const speak = AnimalSays[animal] || AnimalSays.default;
    console.log(animal + ' says ' + speak());
}
makeAnimalSpeak('dog') // => 'dog says woof'
var place = `World`;
var greet = `Hello ${place}!`
function reverseString(str) {
    return [...String(str)].reverse().join('');    
}

console.log(reverseString('stackoverflow'));  // "wolfrevokcats"

var arr = ["bananas", "cranberries", "apples"];
arr.sort(function(a, b) {
    return a.localeCompare(b);
});
var x = '"Escaping " and  can become very annoying';

var codePoint = "😀".codePointAt();//128512
var string = "Hello, World!";
console.log( string.includes("Hello") ); // true

var b16 = 'c';

// base 10 Number
var b10 = parseInt(b16, 16); // 12
var b10 = 12;

// base 16 String representation
var b16 = b10.toString(16); // "c"

var isString = function(value) {
    return typeof value === "string" || value instanceof String;
};

var myString = "abc";
var n = 3;

new Array(n + 1).join(myString);  // Returns "abcabcabc"
"abc".repeat(3);  // Returns "abcabcabc"
const arrayLike = {0: 'Value 0', 1: 'Value 1', length: 2};
arrayLike.forEach(value => {/* Do something */}); // Errors
const realArray = Array.from(arrayLike);
[...arrayLike]


var domList = document.querySelectorAll('#myDropdown option');

domList.forEach(function () { 
    // Do stuff
}); // Error! forEach is not defined.

Array.prototype.forEach.call(domList, function () { 
    // Do stuff
}); // Wow! this works
// {one: 1, two: 2, three: 3}
var array = [
  {
    key: 'one',
    value: 1
  }, {
    key: 'two',
    value: 2
  }, {
    key: 'three',
    value: 3
  }
];
array.reduce(function(obj, current) {
  obj[current.key] = current.value;
  return obj;
}, {});
array.reduce((obj, current) => Object.assign(obj, {
  [current.key]: current.value
}), {});


var arr = [4, 2, 1, -10, 9]

arr.reduce(function(a, b) {
  return a < b ? a : b
}, Infinity);
// → -10
function map(list, fn) {
  return list.reduce(function(newList, item) {
    return newList.concat(fn(item));
  }, []);
}

// Usage:http://stackoverflow.com/documentation/javascript/187/arrays#t=20160907082036764069
map([1, 2, 3], function(n) { return n * n; });
// → [1, 4, 9]
['one', 'two', 'three', 'four'].map(value => value.length);
// → [3, 3, 5, 4]

['s', 't', 'a', 'c', 'K', 'o', 'v', 'E', 'r', 'f', 'l', 'W', '2', '1'].sort((a, b) => {
    a = a.toLowerCase();
    b = b.toLowerCase();
    return a === b ? 0 : a < b ? -1 : 1;        
});
[10, 21, 4, 15, 7, 99, 0, 12].sort(function(a, b) {
    return (a & 1) - (b & 1) || a - b;
});

//[0, 4, 10, 12, 7, 15, 21, 99] 先偶数后奇数
const [b,c, ...xs] = [2, 3, 4, 5];
console.log(b, c, xs); // → 2, 3, [4, 5]
var myArray = [1, 2, 3, 4], i = 0,
    sum = 0;
while(i++ < myArray.length) {
  sum += i;
}
 
function onlyUnique(value, index, self) { 
  return self.indexOf(value) === index;
}

// usage example:
var array = ['a', 1, 'a', 2, '1', 1];
var uniqueArray = array.filter(onlyUnique); // returns ['a', 1, 2, '1']
var uniqueArray = [... new Set(array)];


let myArray = [1, 2, 3, 4];
for (let value of myArray) {
  let twoValue = value * 2;
  console.log("2 * value is: %d", twoValue);
}


</script>
