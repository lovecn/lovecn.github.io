<?php
	header('content-type:text/html;charset=utf-8');	
	session_start();
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
	//添加播出选手
	if(isset($_POST['submit'])){
		$player_id=intval($_POST['player_id']);
		$player_name=$_POST['player_name'];
		$player_tel=$_POST['player_tel'];
		$state=intval($_POST['state']);
		$descr=htmlspecialchars(stripslashes($_POST['descr']));
		$message_state=intval($_POST['message_state']);
		$vote_id=0;
		//state为1 player_id不为空时且不能重复
		if($state==1 && $player_id>0){
			$sql="select  count(*) from player where state=1 and player_id=?";
			$rs=$conn->prepare($sql);
			$rs->execute(array($player_id));
			$total = $rs->fetchColumn();
			unset($rs);
			if($total>0){
				echo("<script>alert('该编号已经存在');window.history.back(-1);</script>");die;
			}			
		}
		$tel_sql="select count(*) from player where player_tel=? ";
		$rs=$conn->prepare($tel_sql);
		$rs->execute(array($player_tel));
		$total = $rs->fetchColumn();
		unset($rs);
		if($total>0){
				echo("<script>alert('手机号不能重复');window.history.back(-1);</script>");die;
		}
		/*while($row = mysql_fetch_array($tel_rs)){
				$tel_rows[]=$row;
		}
		foreach($tel_rows as $value){
			if( in_array($player_tel,$value)){
				echo("<script>alert('手机号不能重复');window.history.back(-1);</script>");die;
			}
		}*/
		$insert_sql="insert into player(player_id,player_name,player_tel,descr,state,message_state,vote_id) values(?,?,?,?,?,?,?)";
		//$conn->exec($insert_sql);
		$rs=$conn->prepare($insert_sql);
		$rs->execute(array($player_id,$player_name,$player_tel,$descr,$state,$message_state,$vote_id));
		unset($rs);
		echo("<script>alert('添加成功');location.href='manage.php';</script>");
	//添加海选选手
	}elseif(isset($_POST['submit_live'])){
		$player_id=0;
		$player_name=$_POST['player_live_name'];
		$player_tel=$_POST['player_live_tel'];
		$state=intval($_POST['live_state']);
		$descr=$_POST['descr_live'];
		$message_state=intval($_POST['message_live_state']);
		$vote_id=intval($_POST['vote_live_id']);
		$tel_sql="select count(*) from player where player_tel=? ";
		$rs=$conn->prepare($tel_sql);
		$rs->execute(array($player_tel));
		$total = $rs->fetchColumn();
		unset($rs);
		if($total>0){
				echo("<script>alert('手机号不能重复');window.history.back(-1);</script>");die;
		}
		$vote_sql="select count(*) from player where vote_id=?";
		$rs=$conn->prepare($vote_sql);
		$rs->execute(array($vote_id));
		$total = $rs->fetchColumn();
		unset($rs);
		if($total>0){
			echo("<script>alert('投票号码不能重复');window.history.back(-1);</script>");die;
		}
		$insert_sql="insert into player(player_id,player_name,player_tel,descr,state,message_state,vote_id) values(?,?,?,?,?,?,?)";
		//$conn->exec($insert_sql);
		$rs=$conn->prepare($insert_sql);
		$rs->execute(array($player_id,$player_name,$player_tel,$descr,$state,$message_state,$vote_id));
		unset($rs);
		echo("<script>alert('添加成功');location.href='manage.php';</script>");		
	}
	unset($conn);
	$smarty->display("add.tpl");
?>
