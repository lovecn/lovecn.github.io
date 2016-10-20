<?php
	header('content-type:text/html;charset=utf-8');
	session_start();
	include('config.php');
	include 'smarty/Smarty.class.php';
	check();//验证session  
	$smarty = new Smarty();
	$host=$config['db']['host'];
	$db=$config['db']['dbname'];
	$url="mysql:host=$host;dbname=$db;port=3306";
	$conn=new PDO($url,$config['db']['name'],$config['db']['pass']);
	$conn->query("set names utf8");
	$id=intval($_GET['vote']);
	if(isset($_GET['time'])){
		$time=$_GET['time'];
		$vote_id=intval($_GET['id']);
		$rs=$conn->query("select count(*) from vote where vote_id =$vote_id and whendo between '".$time.' 00:00:00'."' and '".$time.' 23:59:59'."' ");
	}else {
		$rs=$conn->query("select count(*) from vote  where vote_id=$id");
	}	
	$p = isset($_GET['p'])?intval($_GET['p']):"";
    $pageSize = 10;
	$recordTotal=$rs->fetchColumn();
	unset($rs);
	$pageTotal = ceil($recordTotal/$pageSize);
	if($recordTotal==0) {
		echo("<script>alert('没有记录,请换一个时间查询');window.history.back(-1);</script>");die;
	}
    if($p=="" || $p < 1) $p=1;
    if($p >=$pageTotal) $p=$pageTotal;
	$offset = ($p-1)*$pageSize;
	if(isset($_GET['time'])){
		$time=$_GET['time'];
		$vote_id=intval($_GET['id']);
		$start_time=$time.' 00:00:00';
		$stop_time=$time.' 23:59:59';
		$vote_sql="select * from vote where vote_id =? and whendo between ? and ? order by whendo desc  limit {$offset},{$pageSize} ";
		$result=$conn->prepare($vote_sql);
		$result->execute(array($vote_id,$start_time,$stop_time));
		$rows=$result->fetchall();
		unset($result);
	}else {
		$vote_sql="select * from vote where vote_id=? order by whendo desc  limit {$offset},{$pageSize} ";
		$result=$conn->prepare($vote_sql);
		$result->execute(array($id));
		$rows=$result->fetchall();
		unset($result);
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
	   $url=$_SERVER['REQUEST_URI'];
		if(strpos($url,'&p')) {
			$url=substr($url,0,strpos($url,'&p'));
		}
	unset($conn);
	$smarty->assign('url',$url);
	$smarty->assign('id',$id);
	$smarty->assign('xuanshou',$rows);
	$smarty->assign('p',$p);
	$smarty->assign('pageTotal',$pageTotal);
	$smarty->assign('num',$num);
	$smarty->assign('list',$list);
	$smarty->display("vote.tpl");
?>