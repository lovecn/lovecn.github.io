<?php

$a1 = array(1=>'abc', 3=>10);  
$a2 = array(1=>'efg', 3=>20);  
print_r(array_merge($a1, $a2));
//我们预想中的是
Array
(
    [1] => efg
    [3] => 20
)
//实际上输出的是：不但没有被覆盖，而且数字键被重新连续索引了。
Array
(
    [0] => abc
    [1] => 10
    [2] => efg
    [3] => 20
)

//「如果输入的数组中有相同的字符串键名，则该键名后面的值将覆盖前一个值。然而，如果数组包含数字键名，后面的值将不会覆盖原来的值，而是附加到后面。
如果只给了一个数组并且该数组是数字索引的，则键名会以连续方式重新索引。」http://php.net/manual/zh/function.array-merge.php
//+ 和 array_merge的区别在遇到相等key时，用+时，左边数组会覆盖掉右边数组的值，array_merge相反，后面的数组覆盖掉前面的。

$a = array("a" => "apple", "b" => "banana");
$b = array("a" => "pear", "b" => "strawberry", "c" => "cherry");

$c = $a + $b; // Union of $a and $b
echo "Union of \$a and \$b: \n";
var_dump($c);

$c = array_merge($a, $b); // Union of $b and $a
echo "array_merge of \$b and \$a: \n";
var_dump($c);
Union of $a and $b: 
array(3) {
  ["a"]=>
  string(5) "apple"
  ["b"]=>
  string(6) "banana"
  ["c"]=>
  string(6) "cherry"
}
array_merge of $b and $a: 
array(3) {
  ["a"]=>
  string(4) "pear"
  ["b"]=>
  string(10) "strawberry"
  ["c"]=>
  string(6) "cherry"
}

$a = array("apple", "banana");
$b = array(1 => "banana", "0" => "apple");

var_dump($a == $b); // bool(true)
var_dump($a === $b); // bool(false)

$var = 'test';
if (isset($var['somekey']))
{
    echo 'reach here!!!';
}

var_dump($var['somekey']);
//=>output:  string(1) "t" 因为php在这里做了隐式的类型转换，将这里的字符串转换成int型。你试过intval('somekey')函数的话就知道得到的就是0，所以 $var['somekey']最终就是 $var[0]了。最后，得到了 't'。

$foo = 0;
$bar = 'a3b4c5';
if ( $foo < $bar ) {
    echo 'output';
}
if ( $foo == 'a1b2c3' ) {
    echo 'output';
}
$checkedKeys = array('someKey1', 'someKey2');
$arrTest = array('someKey1' => 'someValue', 'otherValue');
foreach ($arrTest as $key => $value)
{
	if (in_array($key, $checkedKeys))
	{
		echo "The key valid: $key \n";
	}
}
//这里会有两次输出，第二次输出的$key是0，理解了吗？解决办法是在 in_array()函数中加上第三个参数并设为true，进行严格的类型比较









