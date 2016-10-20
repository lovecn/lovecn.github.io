<?php
	header('content-type:text/html;charset=utf-8');
	session_start();
	header("Cache-Control: private");
	include('config.php');
	include 'smarty/Smarty.class.php';
	if(!isset($_SESSION['user_agent'])){
		$_SESSION['user_agent'] = $_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'];
	}
	/* 如果用户session ID是伪造 */
	elseif ($_SESSION['user_agent'] != $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']) {
		session_regenerate_id();//重新分配session ID
	}
	if(!isset($_SESSION['sec']) || $_SESSION['sec']!=md5('mingyun'.$_SESSION['mb'])){
		echo("<script>alert('请先登录');location.href='index.php';</script>");die;
		
	}
	$smarty = new Smarty();
	$conn= mysql_connect($config['db']['host'],$config['db']['name'],$config['db']['pass']);	
    mysql_select_db($config['db']['dbname']);
	mysql_query("set names utf8",$conn);
	if(isset($_POST['search']) ){
		$search=$_POST['number'];
		$rs = mysql_query("select unique_id from player where player_tel='".$search."'",$conn);
	}elseif(isset($_POST['delete']) ){
		//$id=intval($_GET['id']);
		//$rs = mysql_query('delete from player where unique_id='.intval($_GET['id']),$conn);
		header('location:manage.php');
	}elseif(isset($_POST['logout']) ){
		session_destroy();
		setcookie(session_name(),'',time()-3600);
		$_SESSION = array();
		header('location:index.php');
	}else{
		$rs = mysql_query("select unique_id from player  ",$conn);
	}
    $p = intval($_GET['p']);
    $pageSize = 10;
    $recordTotal = mysql_num_rows($rs); 
	if($recordTotal==0) {
		echo("<script>alert('没有找到记录');location.href='manage.php';</script>");die;
	}
    $pageTotal = ceil($recordTotal/$pageSize);
    if($p=="" || $p < 1) $p=1;
    if($p >=$pageTotal) $p=$pageTotal;
    $p = intval($p);
    $offset = ($p-1)*$pageSize;
	if(isset($_POST['search']) ){
		$search=$_POST['number'];
		//$sql1 = "select a.*,count(b.vote_id) num from  player a left join vote b on a.vote_id=b.vote_id where player_tel='".$search."' group by player_id   order by unique_id desc limit {$offset},{$pageSize}";
		$sql="select a.*,(select count(*) from vote where vote.vote_id = a.vote_id) votes,(select count(*) from message where message.player_uid = a.unique_id) number,(select count(*) from call_detail b where b.transfer_num = a.player_tel) calls from player a where a.player_tel='".$search."'  order by a.unique_id desc limit {$offset},{$pageSize}";

	}else{
		//$sql1 = "select a.*,count(b.vote_id) num from  player a left join vote b on a.vote_id=b.vote_id group by player_id order by a.unique_id desc  limit {$offset},{$pageSize} ";
		$sql="select a.*,(select count(*) from vote where vote.vote_id = a.vote_id) votes,(select count(*) from message where message.player_uid = a.unique_id) number,(select count(*) from call_detail b where b.transfer_num = a.player_tel) calls from player a order by a.unique_id desc limit {$offset},{$pageSize}";
		
	}
    $result = mysql_query($sql,$conn);
	while($row = mysql_fetch_array($result)){
				$rows[]=$row;
	}
	foreach($rows as $key=>$value){
		//$rows[$key][]=$value['vote_id'];
		$secure=md5('player'.$value['unique_id']);
		$rows[$key]['secure']=$secure;
	}
	for($i=1;$i<=$pageTotal; $i++){
		$num[]=$i;
	}	
	   $showPage =5;//每次显示个5个页码
       $curPagepos = 4;
       if($pageTotal <= $showPage){
       	 /*当总页码数小于每页显示的页面数时*/
       	 $start = 1;
       	 $end = $pageTotal;
       }else{
       	 /*显示当前页的前几项 和后几项*/
       	 $start = $p - $curPagepos +1;
       	 $end = $start+$showPage - 1;
       	 if($start < 1){
       	 	$start = 1;
       	 	$end = $showPage;
       	 }
       	 if($end >= $pageTotal){
       	 	$end = $pageTotal;
       	 	$start = $end - $showPage +1;
       	 }
       }
	   for($i = $start ; $i<=$end;$i++){
			$list[]=$i;
	   }
	mysql_free_result($rs);
	mysql_close($conn);
	$smarty->assign('p',$p);
	$smarty->assign('pageTotal',$pageTotal);
	$smarty->assign('num',$num);
	$smarty->assign('list',$list);
	$smarty->assign('xuanshou',$rows);
	$smarty->display("manage.html");
?>

