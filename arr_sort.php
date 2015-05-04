<?php

//二维数组去掉重复值
function array_unique_fb($array2D){
	foreach ($array2D as $v){
		$v=join(',',$v);  //降维,也可以用implode,将一维数组转换为用逗号连接的字符串
		$temp[]=$v;
	}
	$temp=array_unique($temp);    //去掉重复的字符串,也就是重复的一维数组
	foreach ($temp as $k => $v){
		$temp[$k]=explode(',',$v);   //再将拆开的数组重新组装
	}
	return $temp;
}

//二维数组去掉重复值,并保留键值
function array_unique_fb($array2D){
	foreach ($array2D as $k=>$v){
		$v=join(',',$v);  //降维,也可以用implode,将一维数组转换为用逗号连接的字符串
		$temp[$k]=$v;
	}
	$temp=array_unique($temp); //去掉重复的字符串,也就是重复的一维数组    
	foreach ($temp as $k => $v){
		$array=explode(',',$v); //再将拆开的数组重新组装
		//下面的索引根据自己的情况进行修改即可
		$temp2[$k]['id'] =$array[0];
		$temp2[$k]['title'] =$array[1];
		$temp2[$k]['keywords'] =$array[2];
		$temp2[$k]['content'] =$array[3];
	}
	return $temp2;
}

/*
*二维数组按指定的键值排序
*/
function array_sort($array,$keys,$type='asc'){
	if(!isset($array) || !is_array($array) || empty($array)){
		return '';
	}
	if(!isset($keys) || trim($keys)==''){
		return '';
	}
	if(!isset($type) || $type=='' || !in_array(strtolower($type),array('asc','desc'))){
		return '';
	}
	$keysvalue=array();
	foreach($array as $key=>$val){
		$val[$keys] = str_replace('-','',$val[$keys]);
		$val[$keys] = str_replace(' ','',$val[$keys]);
		$val[$keys] = str_replace(':','',$val[$keys]);
		$keysvalue[] =$val[$keys];
	}
	asort($keysvalue); //key值排序
	reset($keysvalue); //指针重新指向数组第一个
	foreach($keysvalue as $key=>$vals) {
		$keysort[] = $key;
	}
	$keysvalue = array();
	$count=count($keysort);
	if(strtolower($type) != 'asc'){
		for($i=$count-1; $i>=0; $i--) {
			$keysvalue[] = $array[$keysort[$i]];
		}
	}else{
		for($i=0; $i<$count; $i++){
			$keysvalue[] = $array[$keysort[$i]];
		}
	}
	return $keysvalue;
}
$array=array(
	0=>array('id'=>8,'username'=>'phpernote'),
	1=>array('id'=>9,'username'=>'com'),
	2=>array('id'=>5,'username'=>'www')
);

array_sort($array,'id','asc');

$trans = array ("a" => 1, "b" => 1, "c" => 2);
$trans = array_flip (array_flip($trans));
print_r($trans);
