<?PHP
	if(isset($_POST['pwd']) && isset($_POST['submit'])){
		if(strlen($_POST['pwd'])<3){
			$result ="亲，不要太短哦~~~";
		}else {
			$string = trim($_POST['pwd']);
			$res = ord($string[0]);
			for($i=1; $i<strlen($string); $i++){
				$temp = ord($string[$i-1])-ord($string[$i]);
				$res.=(ord($string[$i])-$temp);
			}
			$result = strrev($res);
		}
		
	}
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Good Luck</title>
	<meta name="keywords" content="" />
	<meta name="description" content="description" />
</head>
<style type="text/css">
	body{font-size:28px;font-family:微软雅黑,宋体}
	table{padding-top:200px}
	#pwd{line-height:32px;font-size:28px}
	#submit{line-height:32px;font-size:28px;float:5px;}
	.out{color:red}
</style>
<body>
	<table align="center">
		<tr>
			<td>请输入密码：</td>
			<form method="post" action="">
			<td><input type="text" name="pwd" id="pwd" size="32" /></td>
			<td><input type="submit" name="submit" value="提交" id="submit" /></form></td>
		</tr>
		<tr>
			<td>输入的明文：</td>
			<td class="out"  colspan=2><?PHP if(isset($string)){
				echo $string;
			}?></td>
		</tr>
		<tr>
			<td>加密后结果：</td>
			<td class="out"  colspan=2><?PHP if(isset($result)){
				echo $result;
			}?></td>
		</tr>
	</table>

</body>
</html>