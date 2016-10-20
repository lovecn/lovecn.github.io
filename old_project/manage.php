<?php
	header('content-type:text/html;charset=utf-8');
	session_start();
	header("Cache-Control: private");
	include 'config.php';
	include 'smarty/Smarty.class.php';
	check();//验证session 
	$smarty = new Smarty();
	$host=$config['db']['host'];
	$db=$config['db']['dbname'];
	$url="mysql:host=$host;dbname=$db;port=3306";
	$conn=new PDO($url,$config['db']['name'],$config['db']['pass']);
	$conn->query("set names utf8");
	if(isset($_POST['search']) ){
		$search=$_POST['number'];
		$sql="select count(*) from player where player_tel =?";
		$rs=$conn->prepare($sql);
		$rs->execute(array($search));
	}elseif(isset($_POST['delete']) ){
		//$id=intval($_GET['id']);
		//$sql='delete from player where unique_id=?';
		//$rs=$conn->prepare($sql);
		//$rs->exec(array($id));
		header('location:manage.php');
	}elseif(isset($_POST['logout']) ){
		session_destroy();
		setcookie(session_name(),'',time()-3600);
		$_SESSION = array();
		header('location:index.php');
	}else{
		$rs=$conn->query("select count(*) from player where vote_id=0 ");
		
	}
		
    $p = intval($_GET['p']);//播出选手分页
	$page = intval($_GET['page']);//海选选手分页
    $pageSize = 15;
	$recordTotal = $rs->fetchColumn();
	unset($rs);//linux下要及时注销
	if($recordTotal==0) {
		echo("<script>alert('没有找到记录');location.href='manage.php';</script>");die;
	}
	$pageTotal = ceil($recordTotal/$pageSize);
    if($p=="" || $p < 1) $p=1;
    if($p >=$pageTotal) $p=$pageTotal;
    $p = intval($p);
    $offset = ($p-1)*$pageSize;
	//pdo不能query 2个sql
	$res=$conn->prepare("select * from player where player_id=0 ");
	$res->execute();
	$total=count($res->fetchall());
	unset($res);
	if($total==0) {
		echo("<script>alert('没有找到记录');location.href='manage.php';</script>");die;
	}
	$page_Total = ceil($total/$pageSize);
    if($page=="" || $page < 1) $page=1;
    if($page >=$page_Total) $page=$page_Total;
    $page = intval($page);
    $live_offset = ($page-1)*$pageSize;
	
	if(isset($_POST['search']) ){
		$search=$_POST['number'];
		$sql="select a.*,(select count(*) from vote where vote.vote_id = a.vote_id) votes,(select count(*) from message where message.player_uid = a.unique_id) number,(select count(*) from call_detail b where b.transfer_num = a.player_tel) calls from player a where a.player_tel=?  order by a.unique_id desc limit {$offset},{$pageSize}";
		$result=$conn->prepare($sql);
		$result->execute(array($search));
		$rows=$result->fetchall();
		unset($result);
	}else{
		$sql="select a.*,(select count(*) from vote where vote.vote_id = a.vote_id) votes,(select count(*) from message where message.player_uid = a.unique_id) number,(select count(*) from call_detail b where b.transfer_num = a.player_tel) calls from player a where a.vote_id=0 order by a.unique_id desc limit {$offset},{$pageSize}";
		$result=$conn->prepare($sql);
		$result->execute();
		$rows=$result->fetchAll();
		unset($result);
	}

	$sql="select a.*,(select count(*) from vote where vote.vote_id = a.vote_id) votes,(select count(*) from message where message.player_uid = a.unique_id) number,(select count(*) from call_detail b where b.transfer_num = a.player_tel) calls from player a where a.player_id=0  order by a.unique_id desc limit {$live_offset},{$pageSize}";
	$result=$conn->prepare($sql);
	$result->execute();
	$live_rows=$result->fetchall();
	unset($result);
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

	for($i=1;$i<=$page_Total; $i++){
		$page_num[]=$i;
	}	
	   $showPage =5;
       $curPagepos = 4;
       if($page_Total <= $showPage){
       	 $start = 1;
       	 $end = $page_Total;
       }else{
       	 $start = $page - $curPagepos +1;
       	 $end = $start+$showPage - 1;
       	 if($start < 1){
       	 	$start = 1;
       	 	$end = $showPage;
       	 }
       	 if($end >= $page_Total){
       	 	$end = $page_Total;
       	 	$start = $end - $showPage +1;
       	 }
       }
	   for($i = $start ; $i<=$end;$i++){
			$page_list[]=$i;
	   }
	unset($conn);
	$smarty->assign('p',$p);
	$smarty->assign('pageTotal',$pageTotal);
	$smarty->assign('num',$num);
	$smarty->assign('list',$list);
	if (isset($_GET['page'])){
		$smarty->assign('page',$page);
	}
	$smarty->assign('page_Total',$page_Total);
	$smarty->assign('page_num',$page_num);
	$smarty->assign('page_list',$page_list);
	$smarty->assign('live_xuanshou',$live_rows);
	$smarty->assign('xuanshou',$rows);
	$smarty->display("manage.tpl");
?>

