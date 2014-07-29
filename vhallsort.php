<?php
//ref:
//对存储数字的二维数组，按照每个一维数组数字之和的平均值重新排序
$arr = array(
		array(1,18,3,6,2147483648),
		array(4,16,2,10,1),
		array(11,2,3,5,9),
		array(3,8,12,4,8)
);
// 方法一
function vhall_sort($arr){
	$tmp = $new = array();
	$len = count($arr);
	if ($len == 0 || !is_array($arr)) {
		return false;
	}
	foreach ($arr as $k=>$v) {
		$num = floatval(array_sum($v));
		$tmp[$k] = $num / $len;
	}
	arsort($tmp);//倒序排列
	foreach ($tmp as $k=>$v){
	    $new[$k] = $arr[$k];//保持key
	}
	return $new;
}
echo '<pre>';
print_r($arr);
print_r(vhall_sort($arr));

// 方法二 require php5.3+

	uasort($arr, function($v1, $v2){ 
		return (array_sum($v1)/count($v1) > array_sum($v2)/count($v2)) ? -1 : 1;
	});
print_r($arr);

?>
<script>
// js版
Array.prototype.sum=function(){
	var num = 0;
	var len = this.length;
	if (len <= 0) {
		throw 'eror';
		return false;
	}
	for (var i = 0;i < len;i++) {
		if (this[i] !== +this[i]) {//判断数字
			throw 'eror';
			return false;
		}
		num += this[i];
	}
	return num;
}
// 高级浏览器支持es5 可Array.prototype.sum=function(){res=this.reduce(function(a,b){return a+b;});return res;}
function vhall_sort(arr){
	arr.sort(function(a,b){
		return b.sum()/b.length - a.sum()/a.length;
	});
}
arr = [[1,18,3,6,3],[4,16,2,10,1],[11,2,3,5,9],[3,8,12,4,8]];
vhall_sort(arr);
console.log(arr);

</script>
