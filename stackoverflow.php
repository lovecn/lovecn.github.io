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
