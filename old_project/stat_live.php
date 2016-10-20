<?php
	header('content-type:text/html;charset=utf-8');
	session_start();
	include('config.php');
	include 'smarty/Smarty.class.php';
	check();//验证session   
	$smarty = new Smarty();
	$host=$config['db']['host'];
	$db=$config['db']['dbname'];
	$pdo_url="mysql:host=$host;dbname=$db;port=3306";
	$conn=new PDO($pdo_url,$config['db']['name'],$config['db']['pass']);
	$conn->query("set names utf8");
	if(isset($_GET['time'])){
		$time=$_GET['time'];
		$start_time=$time.' 00:00:00';
		$stop_time=$time.' 23:59:59';
	}else {
		$start_time=date('Y-m-d').' 00:00:00';
		$stop_time=date('Y-m-d').' 23:59:59';
	}	
	$sql="select a.*,(select count(*) from vote where vote.vote_id = a.vote_id and vote.whendo between '".$start_time."' and '".$stop_time."' ) votes,(select count(*) from message where message.player_uid = a.unique_id  and message.whendo between '".$start_time."' and '".$stop_time."' ) number,(select count(*) from call_detail b where b.transfer_num = a.player_tel  and b.begintime between '".$start_time."' and '".$stop_time."' ) calls from player a where  a.player_id=0  ";
	$p = isset($_GET['p'])?intval($_GET['p']):"";
    $pageSize = 15;
	$rs=$conn->query($sql);
	$recordTotal=count($rs->fetchall());
	unset($rs);
	$pageTotal = ceil($recordTotal/$pageSize);
	if($recordTotal==0) {
		echo("<script>alert('没有记录,请换一个时间查询');window.history.back(-1);</script>");die;
	}
    if($p=="" || $p < 1) $p=1;
    if($p >=$pageTotal) $p=$pageTotal;
	$offset = ($p-1)*$pageSize;
	$time=date('Y-m-d',time());
	if(isset($_GET['time'])){
		$time=$_GET['time'];
		$start_time=$time.' 00:00:00';
		$stop_time=$time.' 23:59:59';
		$page_url=$_SERVER['REQUEST_URI'];
		if(strpos($page_url,'?&p')) {
			$page_url=substr($page_url,0,strpos($page_url,'?&p'));
		}
	}else {
		$start_time=date('Y-m-d').' 00:00:00';
		$stop_time=date('Y-m-d').' 23:59:59';
	}
	$stat_sql="select a.*,(select count(*) from vote where vote.vote_id = a.vote_id and vote.whendo between ? and ? ) votes,(select count(*) from message where message.player_uid = a.unique_id  and message.whendo between ? and ? ) number,(select count(*) from call_detail b where b.transfer_num = a.player_tel  and b.begintime between ? and ? ) calls from player a where   a.player_id=0  order by votes desc ,number desc,calls desc, a.unique_id desc limit {$offset},{$pageSize}";
	$result=$conn->prepare($stat_sql);
	$result->execute(array($start_time,$stop_time,$start_time,$stop_time,$start_time,$stop_time));
	$rows=$result->fetchall();
	unset($result);
	for($i=1;$i<=$pageTotal; $i++){
		$num[]=$i;
	}	
	   $showPage =5;//每次显示个5个页码
       $curPagepos = 4;
       if($pageTotal <= $showPage){
       	 /*当总页码数小于每页显示的页面数时*/
       	 $start = 1;
       	 $end = $pageTotal;
       }
       else{
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
	unset($conn);
	$smarty->assign('url',$page_url);
	$smarty->assign('time',$time);
	$smarty->assign('xuanshou',$rows);
	$smarty->assign('p',$p);
	$smarty->assign('pageTotal',$pageTotal);
	$smarty->assign('num',$num);
	$smarty->assign('list',$list);
	$smarty->display("stat_live.tpl");
?>