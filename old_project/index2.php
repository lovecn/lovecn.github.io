<?php
	header('content-type:text/html;charset=utf-8');
include('RcPager.php');
//include('RcAdoSlave.php');
//include('adodb-time.inc.php');

	$conn = mysql_connect("222.35.101.188","destiny","yellow8751");
	mysql_query("set names utf8");
	$db = mysql_select_db("destiny");
	if(isset($_POST['submit']) ){
		$search=intval($_POST['submit']);
		//$sql='select * from player where player_id='.$search.' or player_tel='.$search.'  order by unique_id desc ';
		$rs = mysql_query('select * from player where player_id='.$search.' order by unique_id desc ');
	}elseif(isset($_POST['delete']) ){
		$rs = mysql_query('delete from player where player_id='.intval($_GET['id']));
		header('location:index.php');
	}else{
		$rs = mysql_query("select * from player order by unique_id desc ");
	}
		//$db=new RcAdoSlave();
		//$queryarray['table'] = array('a'=>'player');
		//$queryarray['where'] = array('a.unique_id'=>1);
		//$queryarray['show'] = '*';//只查所需要的字段
		//$query = $db->select($queryarray);
		//print_r($query);
	/*当前页，第一访问可能没有值*/
    $p = intval($_GET['p']);
   //$conn= mysql_connect($config['db']['host'],$config['db']['name'],$config['db']['pass']);
  //echo($conn . "<br>");
   //mysql_select_db($config['db']['dbname']);
    /*每页的记录数*/
    $pageSize = 1;
    /*总记录数*/
    $recordTotal = mysql_num_rows($rs);
	if($recordTotal==0) {
		echo("<script>alert('没有找到记录');location='index.php';</script>");die;
	}
    /*总页数*/
    $pageTotal = ceil($recordTotal/$pageSize);
    //mysql_free_result($result);
    
    /*$p需要有效*/
    if($p=="" || $p < 1) $p=1;
    if($p >=$pageTotal) $p=$pageTotal;
    $p = intval($p);
    /*当前页要显示的记录的sql语句*/
    $offset = ($p-1)*$pageSize;
	if(isset($_POST['submit']) ){
		$sql1 = "select * from  player where player_id=".$_POST['submit']." limit {$offset},{$pageSize}";

	}else{
		$sql1 = "select * from  player limit {$offset},{$pageSize}";
	}
    $result1 = mysql_query($sql1);
?>	
<title>选手管理</title>
<body bgcolor="#CBE7F5">
<link rel="stylesheet" href="common.css" type="text/css" />
	<script src="jquery.ckform.js" type="text/javascript"></script>
    <script src="jquery.1.5.2.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript">
$(function(){
	$('#search').focus(function(){
		if($('#search').val()=='请输入选手编号') $('#search').val('');
	});
	$('#search').blur(function(){
		if($('#search').val()=='') $('#search').val('请输入选手编号');
	});
});        
 function del() {
	if(window.confirm('你确定要删除该选手?')){
                 return true;
              }else{
                 return false;
             }
}
        //pagecount 为显示页数
         //PageClick 为回调函数
         //pageclickednumber 为点击页码
        /*$(document).ready(function() {
            $("#pager").pager({ pagenumber: 1, pagecount: 10, buttonClickCallback: PageClick });
        });

        PageClick = function(pageclickednumber) {
            $("#pager").pager({ pagenumber: pageclickednumber, pagecount: 10, buttonClickCallback: PageClick });
            $("#result").html("Clicked Page " + pageclickednumber);
        }*/
       //document.write('总共<font size="30px" color="red"><?php  echo $pageTotal?></font>页');
</script>
<div class='player'>
<table border="1" width="60%" height="60%" cellspacing=0 cellpadding=0 style="valign：middle;margin:auto" align='center'>
	<tr><td colspan='7' align='center'>选手管理</td></tr>
	<form name='form' method='post'>
		<tr><td colspan='6' style='' align='center'><input type='text' name='submit' value='请输入选手编号' id='search'><input type='submit' value='搜索' style="cursor:pointer"></td>
	</form>
	<td align='center'  class='player'>
	</td>
	</tr>
    <tr>
       <td class='player' valign="middle"  align='center'>选手编号</td>
       <td class='player'>选手电话</td>
       <td class='player'>选手状态</td>
       <td class='player'>选手投票号码</td>
	   <td class='player'>选手留言</td>
	   <td class='player'>选手描述</td>
	   <td class='player'>操作</td>
    </tr>
    <?php 
        while($row = mysql_fetch_array($result1)){
        	?>
        	<tr>
        	  <td  class='player'><?php  echo  $row['player_id']?></td>
        	  <td class='player' ><?php  echo  $row['player_tel']?></td>
        	  <td class='player' ><?php  if($row['state']==1){ echo  '开启'; }else{echo  '关闭' ;}?></td>
        	  <td class='player' ><?php  echo  $row['vote_id']?></td>
			  <td class='player' ><?php  if($row['message_state']==1) { echo  '开启'; }else{echo  '关闭' ;}?></td>
			  <td class='player' ><textarea name='descr' value='' style="width:100%;height:100%" disabled><?php  echo  $row['descr']?></textarea></td>
			  <td class='player'>
				<form method='post' action="edit.php?id=<?php  echo  $row['unique_id']?>">
				<table>
				<tr>
					<td ><input type='submit' value='修改' name='edit' style="cursor:pointer"></td></tr>
				</table>
				</form>
				<form method='post' action="index.php?id=<?php  echo  $row['player_id']?>" id='del'>
					<table>
					<tr>
					<td ><input type='submit' value='删除' name='delete' id='delete' style="cursor:pointer" onclick="return del()"></td>
					</tr>
					</table>
				</form>
			  </td>
        	</tr>
       <?php  }
     ?>


 <tr>
	<td colspan='6' align='center'>总共<font size="30px" color="red"><?php  echo $pageTotal?></font>页&nbsp;当前是第<font size="30px" color="red"><?php  echo $p?></font>页
		<a href="index.php?p=1">首页</a>
 <?php 
   if($p > 1){
   	?>
   	<a href="index.php?p=<?php  echo $p-1?>">上一页</a>
   <?php }
   if($p < $pageTotal){
   	?>
   	<a href="index.php?p=<?php  echo $p+1?>">下一页</a>
   <?php }
 ?>
 
 
 <a href="index.php?p=<?php  echo $pageTotal?>">尾页</a>
		<select onchange="location.href='index.php?p='+this.value">
         <?php 
           for($i = 1; $i <= $pageTotal;$i++){
           	?>
           	<option value="<?php  echo $i;?>" <?php if($i==$p) echo("selected=\"selected\"") ?>>第<?php  echo $i;?>页</option>
           <?php }
         ?>
       </select>
		 <?php 
       $showPage =6;//每次显示个8个页码
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
         	?>
         	<a href="index2.php?p=<?php  echo $i;?>">
         	
         	    <?php 
         	    
         	      if($i==$p){
         	      	echo("<font size='30px' color='red'>".$i."</font>");
         	      }
         	      else{
         	      	echo($i);
         	      }
         	    ?>
         	</a>
         <?php }
       ?>
 </td>
 <td align='center'  class='player'>
	<form name='form' method='post' action='add.php'><input type='submit' value='添加选手' style="cursor:pointer"></form>
  </td>
</tr>  
</table>
  </div>
<?php
	mysql_free_result($rs);
	mysql_close($conn);


?>
<h1 id="result" style='display:none'>Click the pager below.</h1>
<div id="pager" ></div>

 </body>