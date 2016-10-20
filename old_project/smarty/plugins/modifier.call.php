<?php
//统计通话时间
function smarty_modifier_call($string){
	if($string>=60){
		if($string % 60 ==0){
			$str=$string/60;
			Return $str.'分';
		}else{
			$str=floor($string/60);
			//list($min,$sec)=explode('.',$string/60);
			$sec=$string/60-$str;
			Return $str.'分'.($sec*60).'秒';
		}
	}
	Return $string.'秒';

}







?>





