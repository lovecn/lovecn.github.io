<?php
	header('content-type:text/html;charset=utf-8');
	session_start();
	//header("Pragma: no-cache");
	header("Cache-Control: private");
	include 'smarty/Smarty.class.php';
	include('config.php');
	check();//验证session 
	$smarty = new Smarty();	
	$host=$config['db']['host'];
	$db=$config['db']['dbname'];
	$url="mysql:host=$host;dbname=$db;port=3306";
	$conn=new PDO($url,$config['db']['name'],$config['db']['pass']);
	$conn->query("set names utf8");
	
	if(isset($_POST['edit'])){
		$id=intval($_GET['id']);
		$sql='select * from player where unique_id=?';
		$rs=$conn->prepare($sql);
		$rs->execute(array($id));
		$rows=$rs->fetchAll();
		unset($rs);
	}elseif(isset($_POST['submit'])){
		//state=1时player_id不重复即可
		$unique_id=intval($_GET['id']);
		$player_id=isset($_POST['player_id'])?intval($_POST['player_id']):0;
		$player_name=$_POST['player_name'];
		$player_tel=$_POST['player_tel'];
		$state=intval($_POST['state']);
		$descr=$_POST['descr'];
		$message_state=intval($_POST['message_state']);
		$vote_id=isset($_POST['vote_id'])?intval($_POST['vote_id']):0;
		if($state==1 && $player_id>0){
			$state_sql="select  player_id from player where state=1 and unique_id!=?";
			$rs=$conn->prepare($state_sql);
			$rs->execute(array($unique_id));
			$rows=$rs->fetchAll();
			unset($rs);			
		foreach($rows as $value){
			if(in_array($player_id,$value)){
				echo("<script>alert('该编号已经存在');window.history.back(-1);</script>");die;
			}
		}
	}
	$tel_sql="select player_tel from player where unique_id!=?";
	$tel_rs=$conn->prepare($tel_sql);
	$tel_rs->execute(array($unique_id));
	$tel_rows=$tel_rs->fetchAll();
	unset($tel_rs);	
	foreach($tel_rows as $value){
			if( in_array($player_tel,$value)){
				echo("<script>alert('手机号不能重复');window.history.back(-1);</script>");die;
			}
	}
	if($vote_id>0){
			$vote_sql="select vote_id from player where unique_id!=?";
			$vote_rs=$conn->prepare($vote_sql);
			$vote_rs->execute(array($unique_id));
			$vote_rows=$vote_rs->fetchAll();
			unset($vote_rs);
			foreach($vote_rows as $value){
				if(in_array($vote_id,$value)){
					echo("<script>alert('投票号码不能重复');window.history.back(-1);</script>");die;
				}
			}
	}
	$update_sql="update  player set player_id=? ,player_name=? ,player_tel=? ,  state=? , descr=? ,  message_state =? , vote_id=? where  unique_id=?";
	$update_rs=$conn->prepare($update_sql);
	$update_rs->execute(array($player_id,$player_name,$player_tel,$state,$descr,$message_state,$vote_id,$unique_id));
	unset($update_rs);
	echo("<script>alert('修改成功');location.href='manage.php';</script>");
	}else{
		header('location:manage.php');
	}
	unset($conn);
	if(isset($_GET['player_id'])){
		$smarty->assign('player_id',$_GET['player_id']);
	}
	if(isset($_GET['vote_id'])){
		$smarty->assign('vote_id',$_GET['vote_id']);
	}
	$smarty->assign('id',$id);
	$smarty->assign('xuanshou',$rows);
	$smarty->display("edit.tpl");


?>
