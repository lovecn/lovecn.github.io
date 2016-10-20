<?php
//error_reporting(0);
	header('content-type:text/html;charset=utf-8');
	header("Cache-Control: private");
	session_start();
	include('config.php');
	include 'smarty/Smarty.class.php';
	$smarty = new Smarty();
	$host=$config['db']['host'];
	$db=$config['db']['dbname'];
	$url="mysql:host=$host;dbname=$db;port=3306";
	$conn=new PDO($url,$config['db']['name'],$config['db']['pass']);
	$conn->query("set names utf8");

	if(isset($_SESSION['sec']) && $_SESSION['sec']==md5('mingyun'.$_SESSION['mb'])){
		echo("<script>location.href='manage.php';</script>");die;
		
	}
	if(isset($_POST['submit'])){
		if(!preg_match("/^[0-9]{11}$/",$_POST['mobile'])){
			echo("<script>alert('手机号为11位');window.history.back(-1);</script>");die;
		}
		if(!preg_match("/^[a-zA-Z0-9]{6,16}$/",$_POST['password'])){
			echo("<script>alert('密码长度为6-16位');window.history.back(-1);</script>");die;
		}
		$mobile=$_POST['mobile'];
		$password=$_POST['password'];
		$password=md5('mingyun_'.md5($password));
		$sql="select count(*) from admin where admin_tel=? and pwd=? ";//先查出用户密码再比对也可以
		$result=$conn->prepare($sql);
		$result->execute(array($mobile,$password));
		$total=$result->fetchColumn();
		if($total>0) {
			$_SESSION['mb']=$mobile;
			$_SESSION['sec']=md5('mingyun'.$mobile);
			header('location:manage.php');
		}else{
			echo("<script>alert('手机号或密码有误');window.history.back(-1);</script>");die;
		}
		unset($result);
	}
	unset($conn);
	$smarty->display("index.tpl");
?>