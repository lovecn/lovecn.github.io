<?php
/*
CREATE TABLE `tb_user` (
  `id` int(10) NOT NULL auto_increment,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;


INSERT INTO `tb_user` VALUES (1, 'aaa');
INSERT INTO `tb_user` VALUES (2, 'bbb');
INSERT INTO `tb_user` VALUES (3, 'ccc');
INSERT INTO `tb_user` VALUES (4, 'ddd');
INSERT INTO `tb_user` VALUES (5, 'eee');
INSERT INTO `tb_user` VALUES (6, 'fff');
INSERT INTO `tb_user` VALUES (7, 'ggg');
INSERT INTO `tb_user` VALUES (8, 'hhh');
INSERT INTO `tb_user` VALUES (9, 'kkkk');






*/



?>
<a href='../link.php'>PHP用CURL伪造IP和来源</a>
<script>
var http_request=false;
  function send_request(url){//初始化，指定处理函数，发送请求的函数
    http_request=false;
    //开始初始化XMLHttpRequest对象
    if(window.XMLHttpRequest){//Mozilla浏览器
     http_request=new XMLHttpRequest();
     if(http_request.overrideMimeType){//设置MIME类别
       http_request.overrideMimeType("text/xml");
     }
    }
    else if(window.ActiveXObject){//IE浏览器
     try{
      http_request=new ActiveXObject("Msxml2.XMLHttp");
     }catch(e){
      try{
      http_request=new ActiveXobject("Microsoft.XMLHttp");
      }catch(e){}
     }
    }
    if(!http_request){//异常，创建对象实例失败
     window.alert("创建XMLHttp对象失败！");
     return false;
    }
    http_request.onreadystatechange=processrequest;
    //确定发送请求方式，URL，及是否同步执行下段代码
    http_request.open("GET",url,true);
    http_request.send(null);
  }
  //处理返回信息的函数
  function processrequest(){
   if(http_request.readyState==4){//判断对象状态
     if(http_request.status==200){//信息已成功返回，开始处理信息
      document.getElementById(reobj).innerHTML=http_request.responseText;
     }
     else{//页面不正常
      alert("您所请求的页面不正常！");
     }
   }
  }
  function dopage(obj,url){
   document.getElementById(obj).innerHTML="正在读取数据...";
   reobj = obj;
   send_request(url);
   }

</script>


<title>PHP+ajax分页演示</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<div id="result">
<?php
$terry=mysql_connect("localhost","root","root")or die("连接数据库失败:".mysql_error());
mysql_select_db("test",$terry);
mysql_query("set NAMES 'utf8'");
$result=mysql_query("select * from tb_user");

$total=mysql_num_rows($result) or die(mysql_error());

$page=isset($_GET['page'])?intval($_GET['page']):1;
$page_size=3;
$url='pager.php';

$pagenum=ceil($total/$page_size);
$page=min($pagenum,$page);
$prepage=$page-1;
$nextpage=($page==$pagenum?0:$page+1);
$pageset=($page-1)*$page_size;
$pagenav='';
$pagenav.="显示第<font color='red'>".($total?($pageset+1):0)."-".min($pageset+5,$total)."</font>记录&nbsp;共<b><font color='yellow'>".$total."</font></b>条记录&nbsp;现在是第&nbsp;<b><font color='blue'>".$page."</font></b>&nbsp;页&nbsp;";
if($page<=1)
$pagenav.="<a style=cursor:not-allowed;>首页</a>&nbsp;";
else
$pagenav.="<a onclick=javascript:dopage('result','$url?page=1') style=cursor:pointer;>首页</a>&nbsp;";
if($prepage)
$pagenav.="<a onclick=javascript:dopage('result','$url?page=$prepage') style=cursor:pointer;>上一页</a>&nbsp;";
else
$pagenav.="<a style=cursor:not-allowed;>上一页</a>&nbsp;";
if($nextpage)
$pagenav.="<a onclick=javascript:dopage('result','$url?page=$nextpage') style=cursor:pointer;>下一页</a>&nbsp;";
else
$pagenav.="<a style=cursor:not-allowed;>下一页</a>&nbsp;";
if($pagenum)
$pagenav.="<a onclick=javascript:dopage('result','$url?page=$pagenum') style=cursor:pointer;>尾页</a>&nbsp;";
else
$pagenav.="<a style=cursor:not-allowed;>尾页</a>&nbsp;";
$pagenav.="共".$pagenum."页";

if($page>$pagenum){
    echo "error:没有此页".$page;
    exit();
}
?>
<table align="center" border="2" width="300">
  <tr bgcolor="#cccccc" align="center">
    <td>用户名</td>
    <td>用户密码</td>
  </tr>
<?php
$info=mysql_query("select * from tb_user order by id desc limit $pageset,$page_size");
while($array=mysql_fetch_array($info)){
?>
  <tr align="center">
    <td><?php echo $array['id'];?></td>
    <td><?php echo $array['username'];?></td>
  </tr>
<?php    
}
?>
</table>
<?php
echo "<p align=center>$pagenav</p>";
?>
</div>
<script src="common/jquery.1.5.2.js"></script>
<script src="city.js"></script>
<select id="locG" style="width:80px;"><option value="-1">--国家--</option></select>
<select id="locS" style="width:80px; display:none; "><option value="-1">--省级--</option></select>
<select id="locC" style="width:80px; display:none;"><option value="-1">--地级--</option></select>
<select id="locR" style="width:80px; display:none;"><option value="-1">--县级--</option></select>
<script>
	//老家(1, 33, 7, 23);
	//阿尔及利亚('DZA', '', 'ALG', null);
	(function(){
		var target_obj = { 'G':$('#locG'), 'S':$('#locS'), 'C':$('#locC'), 'R':$('#locR') };
		var value_obj = { 'G':1, 'S':33, 'C':7, 'R':23 };

		target_obj.G.bind("change",function(){ loc.sLoad(target_obj); });
		target_obj.S.bind("change",function(){ loc.cLoad(target_obj); });
		target_obj.C.bind("change",function(){ loc.rLoad(target_obj); });

		loc.allLoad(target_obj, value_obj);
	})();
</script>


