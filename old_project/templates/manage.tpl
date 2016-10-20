
<title>选手管理</title>
<body bgcolor="#CBE7F5">
<link rel="stylesheet" href="common/common.css" type="text/css" />
<link rel="shortcut icon" href="mingyun60.ico" type="image/x-icon" />
<style>
.tabbox { width:100%;height:100%;margin:20px auto;border:0px  solid;padding:10px;}
.tabbox ul { list-style-type:none;clear:both; display:inline;float:left;;z-index:20;width:100%;padding:0;margin:0;text-align:center;}
.tabbox ul li { display:inline;height:20px;line-height:20px;padding:0 15px;z-index:21;}
.tabbox ul li a { text-decoration:none;}
.tabbox ul li.hover { border:1px #0088CC solid;border-bottom:1px #0088CC solid;}
.tabbox .tabtext { display:none;clear:both;float:none;position:relative;z-index:15;border:0px  solid;padding:8px;}

</style>
<script src="common/jquery.ckform.js" type="text/javascript"></script>
<script src="common/jquery.1.5.2.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
$(function(){
	$('.submit').click(function(){
		if($('.search').val()=='请输入选手号码'){
			alert('亲,请输入选手号码');
			$('.search').focus();
			return false;
		}
	});
	$('.live_submit').click(function(){
		if($('.live_search').val()=='请输入选手号码'){
			alert('亲,请输入选手号码');
			$('.live_search').focus();
			return false;
		}
	});
});  
	function del() {
		if(window.confirm('你确定要删除该选手?')){
                 return true;
              }else{
                 return false;
             }
	}
	//var stat=function(){location.href='stat.php';};
</script>
<div class='player tabbox'>
		<ul>
		<li class="hover" id='living_hover'><a href="manage.php?p=1" name='#living'>播出选手</a></li>
		<li id='live_hover'><a href="manage.php?page=1" name='#live'>海选选手</a></li>
		<!--<li><a href="#guide">编导</a></li>-->
		</ul>
	<div id="living" class="tabtext" style="display:block;">
<table border="1" width="80%" height="80%" cellspacing=0 cellpadding=0   align='center'>
	<form name='form' method='post' id='post'>
		<tr>
			<td colspan='9' align='center'>选手管理</td>
			<td align='center'>
				<input type='submit' value='退出' style="cursor:pointer" name='logout'>
			</td>
		</tr>
		
		<tr>
			<td colspan='9' style='background:repeat-x 0 -220px;' align='center'>
				<input type='text' name='number'  class='search'  maxlength='12' autocomplete="off" x-webkit-speech speech placeholder=""  value='请输入选手号码' style="border:1px solid #FFF;outline:none;font-size:14px;color:#999 !important;" onblur="if(this.value=='') this.value='请输入选手号码';"  onfocus="if(this.value=='请输入选手号码') this.value='';  ">
				<input type='submit' value='搜索' style="cursor:pointer" class='submit' name='search'>
			</td>
			<td align='center' >
				<input type='button' value='今日统计'  style="cursor:pointer" onclick="window.location = 'stat.php';" >
			</td>
	</form>
		<td align='center'  class='player'></td>
	</tr>
    <tr>
          <td class='player' valign="middle"  align='center'>选手编号</td>
          <td class='player'>选手名字</td>
          <td class='player'>选手电话</td>
          <td class='player'>选手状态</td>
          <td class='player'>投票号码</td>
	  <td class='player'>选手留言</td>
	  <!--<td class='player'>投票数</td>-->
	  <td class='player'>留言数</td>
	  <td class='player'>通话数</td>
	  <td class='player'>选手描述</td>
	  <td class='player'>操作</td>
    </tr>
   {#foreach from="$xuanshou" item='v'#}        	
   <tr>
        <td  class='player'>{#$v.player_id#}</td>
	 <td class='player' >{#if $v.player_name neq null#}{#$v.player_name#}{#else#}&nbsp; {#/if#}</td>
        <td class='player' >{#$v.player_tel#}</td>
        <td class='player' >{#if $v.state eq 1#}开启{#else#}关闭{#/if#}</td>
        <td class='player' >{#$v.vote_id#}</td>
	<td class='player' >{#if $v.message_state eq 1#}开启{#else#}关闭{#/if#}</td>
	<!--<td class='player'>
		{#if $v.votes gt 0#}<a href='vote.php?vote={#$v.vote_id#}' title='查看他的投票情况'><font size="10px" >{#$v.votes#}</font></a>
		{#else#}{#$v.votes#}
		{#/if#}
		</td>-->
	<td class='player' id='{#$v.unique_id#}'>
		{#if $v.number gt 0#}
			<a href='mess.php?player_unique={#$v.unique_id#}&secure={#$v.secure#}' title='查看他的留言情况'><font size="10px" >{#$v.number#}</font>
			  {#else#}
			  {#$v.number#}
			  {#/if#}</a>
			  <script >$(function(){
						(function(){
						var player_unique={#$v.unique_id#};
						var secure="{#$v.secure#}";
						//var liuyan="<a href=http://222.35.101.188/vxml/wav/message/"+player_unique  +" title='点击收听他的所有留言'>";
						var liuyan="<a href=mess.php?player_unique="+player_unique+"&secure="+secure +" title='点击收听他的所有留言'>";
						$.get("http://222.35.101.188/vxml/msg.php?player_unique="+player_unique+"&secure="+secure,"",function(data){
							if(data.count>0){
								//$('#{#$v.unique_id#}').html(liuyan+'<font size="10px" >'+data.count+'</font></a>');
							}else{
								//$('#{#$v.unique_id#}').html(data.count);
							}
						},'json');
					})();
				}); 
				</script></td>
		<td class='player' >
			{#if $v.calls gt 0#}
				<a href='tel.php?tel={#$v.player_tel#}' title='查看他的通话情况'><font size="10px" >{#$v.calls#}</font></a>
				{#else#}
				{#$v.calls#}
				{#/if#}
		</td>
		<td class='player' ><textarea name='descr' value='' style="width:100%;height:100%" disabled>{#$v.descr#}</textarea></td>
		<td class='' align='center'>
			<form method='post' action="edit.php?id={#$v.unique_id#}&player_id={#$v.player_id#}">
				<table border=0 cellspacing=0 cellpadding=0  >
				<tr>
					<td ><input type='submit' value='修改' name='edit' style="cursor:pointer"></td>
				</tr>
				</table>
			</form>
				<form method='post' action="manage.php?id={#$v.unique_id#}" id='del'>
					<table border=0 cellspacing=0 cellpadding=0  >
					<tr>
					<!--<td ><input type='submit' value='删除' name='delete' id='delete' style="cursor:pointer" onclick="return del()"></td>-->
					</tr>
					</table>
				</form>
			  </td>
        	</tr>
	{#/foreach#}
	<tr>
	<td colspan='9' align='center'>共<font size="30px" color="red">{#$pageTotal#}</font>页&nbsp;第<font size="30px" color="red">{#$p#}</font>页&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="manage.php?p=1">首页</a>
   {#if $p > 1#}
   	<a href="manage.php?p={#$p-1#}">上一页</a>
   {#/if#}
	{#foreach from="$list" item='v'#}
           	<a href="?&p={#$v#}" >{#if $v eq $p#}<font size='30px' color='red'>{#$v#}</font>{#else#}<font size='10px' >{#$v#}</font>{#/if#}</a>&nbsp;&nbsp;
   {#/foreach#}
   {#if $p < $pageTotal#}
   	<a href="manage.php?p={#$p+1#}">下一页</a>
   {#/if#}
 
 <a href="manage.php?p={#$pageTotal#}">尾页</a>
  
		<select onchange="location.href='manage.php?p='+this.value">
         {#foreach from="$num" item='v'#}
           	<option value="{#$v#}" {#if $v eq $p#}selected="selected"{#/if#}>第{#$v#}页</option>
         {#/foreach#}
       </select>
 </td>
 <td align='center'  class='player'>
	<form name='form' method='post' action='add.php'><input type='submit' value='添加选手' style="cursor:pointer"></form>
  </td>
</tr>  
</table>
</div>
<div id="live" class="tabtext"  >

<table border="1" width="80%" height="80%" cellspacing=0 cellpadding=0   align='center'>
	<form name='form' method='post' id='post'>
		<tr>
			<td colspan='8' align='center'>选手管理</td>
			<td align='center'>
				<input type='submit' value='退出' style="cursor:pointer" name='logout'>
			</td>
		</tr>
		
		<tr>
			<td colspan='8' style='background:repeat-x 0 -222px;' align='center'>
				<input type='text' name='number'  class='live_search'  maxlength='12' autocomplete="off" x-webkit-speech speech placeholder=""  value='请输入选手号码' style="border:1px solid #FFF;outline:none;font-size:14px;color:#999 !important;" onblur="if(this.value=='') this.value='请输入选手号码';"   onfocus="if(this.value=='请输入选手号码') this.value='';  ">
				<input type='submit' value='搜索' style="cursor:pointer" class='live_submit' name='search'>
			</td>
			<td align='center'>
				<input type='button' value='今日统计'  style="cursor:pointer" onclick="window.location = 'stat_live.php';" >
			</td>
	</form>
		<td align='center'  class='player'></td>
	</tr>
    <tr>
       <td class='player' valign="middle"  align='center'>选手编号</td>
	   <td class='player'>选手名字</td>
       <td class='player'>选手电话</td>
       <td class='player'>选手状态</td>
       <td class='player'>投票号码</td>
	   <td class='player'>选手留言</td>
	   <td class='player'>投票数</td>
	   <!--<td class='player'>留言数</td>
	   <td class='player'>通话数</td>-->
	   <td class='player'>选手描述</td>
	   <td class='player'>操作</td>
    </tr>
	{#foreach from="$live_xuanshou" item='v'#}        	
			<tr>
        	  <td  class='player'>{#$v.player_id#}</td>
			  <td class='player' >{#if $v.player_name neq null#}{#$v.player_name#}{#else#}&nbsp; {#/if#}</td>
        	  <td class='player' >{#if $v.player_tel neq false#}{#$v.player_tel#}{#else#}&nbsp;{#/if#}</td>
        	  <td class='player' >{#if $v.state eq 1#}开启{#else#}关闭{#/if#}</td>
        	  <td class='player' >{#$v.vote_id#}</td>
			  <td class='player' >{#if $v.message_state eq 1#}开启{#else#}关闭{#/if#}</td>
			  <td class='player'>
				{#if $v.votes gt 0#}
					<a href='vote.php?vote={#$v.vote_id#}' title='查看他的投票情况'><font size="10px" >{#$v.votes#}</font></a>
				{#else#}
				{#$v.votes#}
				{#/if#}
			  </td>
			  <!--<td class='player' id='{#$v.unique_id#}'>
			  {#if $v.number gt 0#}
				<a href='mess.php?player_unique={#$v.unique_id#}&secure={#$v.secure#}' title='查看他的留言情况'><font size="10px" >{#$v.number#}</font>
			  {#else#}
			  {#$v.number#}
			  {#/if#}</a>
			  </td>
				<td class='player' >
				{#if $v.calls gt 0#}
					<a href='tel.php?tel={#$v.player_tel#}' title='查看他的通话情况'><font size="10px" >{#$v.calls#}</font></a>
				{#else#}
				{#$v.calls#}
				{#/if#}
				</td>-->
			  <td class='player' ><textarea name='descr' value='' style="width:100%;height:100%" disabled>{#$v.descr#}</textarea></td>
			  <td class='' align='center'>
				<form method='post' action="edit.php?id={#$v.unique_id#}&vote_id={#$v.vote_id#}">
				<table border=0 cellspacing=0 cellpadding=0  >
				<tr>
					<td ><input type='submit' value='修改' name='edit' style="cursor:pointer"></td>
				</tr>
				</table>
				</form>
				<form method='post' action="manage.php?id={#$v.unique_id#}" id='del'>
					<table border=0 cellspacing=0 cellpadding=0  >
					<tr>
					<!--<td ><input type='submit' value='删除' name='delete' id='delete' style="cursor:pointer" onclick="return del()"></td>-->
					</tr>
					</table>
				</form>
			  </td>
        	</tr>
	{#/foreach#}
 <tr>
	<td colspan='8' align='center'>共<font size="30px" color="red">{#$page_Total#}</font>页&nbsp;第<font size="30px" color="red">{#if isset($page)#}{#$page#}{#else#}1{#/if#}</font>页&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="manage.php?page=1">首页</a>
   {#if isset($page) && $page > 1#}
   	<a href="manage.php?page={#$page-1#}">上一页</a>
   {#/if#}
   {#foreach from="$page_list" item='v'#}
         <a href="?&page={#$v#}" >{#if $v eq $page#}<font size='30px' color='red'>{#$v#}</font>{#else#}<font size='10px' >{#$v#}</font>{#/if#}</a>&nbsp;&nbsp;
   {#/foreach#}
   {#if isset($page) && $page < $page_Total#}
   	<a href="manage.php?page={#$page+1#}">下一页</a>
   {#/if#}
 
 <a href="manage.php?page={#$page_Total#}">尾页</a>
  
	<select onchange="location.href='manage.php?page='+this.value">
         {#foreach from="$page_num" item='v'#}
           	<option value="{#$v#}" {#if $v eq $page#}selected="selected"{#/if#}>第{#$v#}页</option>
         {#/foreach#}
       </select>
 </td>
 <td align='center'  class='player'>
	<form name='form' method='post' action='add.php'><input type='submit' value='添加选手' style="cursor:pointer"></form>
  </td>
</tr>  
</table>
</div>
</div>
<script>
	$(function(){
		var $li = $('.tabbox>ul>li');
		var $div = $('.tabbox').children('div.tabtext');
		$li.mouseover(function(){
			$(this).parent().children('li').removeClass('hover');
			$(this).addClass('hover');
			var ref = $(this).children('a').attr('name');
			if(ref!=undefined && ref!=''){
				$(ref).parent().children('div.tabtext').hide();
				$(ref).show();
			}
		});
		{#if isset($page)#}
			$('#live_hover').addClass('hover');
			$('#living_hover').removeClass('hover');
			$('#live').show();
			$('#living').hide();
		{#/if#}
	});
//自动执行函数
/*(function() {
    var $backToTopTxt = "返回顶部", $backToTopEle = $('<div class="backToTop"></div>').appendTo($("body"))
        .text($backToTopTxt).attr("title", $backToTopTxt).click(function() {
            $("html, body").animate({ scrollTop: 0 }, 120);
    }), $backToTopFun = function() {
        var st = $(document).scrollTop(), winh = $(window).height();
        (st > 0)? $backToTopEle.show(): $backToTopEle.hide();    
        //IE6下的定位
        if (!window.XMLHttpRequest) {
            $backToTopEle.css("top", st + winh - 166);    
        }
    };
    $(window).bind("scroll", $backToTopFun);
    $(function() { $backToTopFun(); });
})();*/

var scrolltotop={
	setting:{
		startline:100, //起始行
		scrollto:0, //滚动到指定位置
		scrollduration:400, //滚动过渡时间
		fadeduration:[500,100] //淡出淡现消失
	},
	controlHTML:'<img src="http://www.jqshare.com/Uploads/demo/jq071/images/topback.gif" style="width:54px; height:54px; border:0;" />', //返回顶部按钮
	controlattrs:{offsetx:30,offsety:80},//返回按钮固定位置
	anchorkeyword:"#top",
	state:{
		isvisible:false,
		shouldvisible:false
	},scrollup:function(){
		if(!this.cssfixedsupport){
			this.$control.css({opacity:0});
		}
		var dest=isNaN(this.setting.scrollto)?this.setting.scrollto:parseInt(this.setting.scrollto);
		if(typeof dest=="string"&&jQuery("#"+dest).length==1){
			dest=jQuery("#"+dest).offset().top;
		}else{
			dest=0;
		}
		this.$body.animate({scrollTop:dest},this.setting.scrollduration);
	},keepfixed:function(){
		var $window=jQuery(window);
		var controlx=$window.scrollLeft()+$window.width()-this.$control.width()-this.controlattrs.offsetx;
		var controly=$window.scrollTop()+$window.height()-this.$control.height()-this.controlattrs.offsety;
		this.$control.css({left:controlx+"px",top:controly+"px"});
	},togglecontrol:function(){
		var scrolltop=jQuery(window).scrollTop();
		if(!this.cssfixedsupport){
			this.keepfixed();
		}
		this.state.shouldvisible=(scrolltop>=this.setting.startline)?true:false;
		if(this.state.shouldvisible&&!this.state.isvisible){
			this.$control.stop().animate({opacity:1},this.setting.fadeduration[0]);
			this.state.isvisible=true;
		}else{
			if(this.state.shouldvisible==false&&this.state.isvisible){
				this.$control.stop().animate({opacity:0},this.setting.fadeduration[1]);
				this.state.isvisible=false;
			}
		}
	},init:function(){
		jQuery(document).ready(function($){
			var mainobj=scrolltotop;
			var iebrws=document.all;
			mainobj.cssfixedsupport=!iebrws||iebrws&&document.compatMode=="CSS1Compat"&&window.XMLHttpRequest;
			mainobj.$body=(window.opera)?(document.compatMode=="CSS1Compat"?$("html"):$("body")):$("html,body");
			mainobj.$control=$('<div id="topcontrol"  style="z-index:99">'+mainobj.controlHTML+"</div>").css({position:mainobj.cssfixedsupport?"fixed":"absolute",bottom:mainobj.controlattrs.offsety,right:mainobj.controlattrs.offsetx,opacity:0,cursor:"pointer"}).attr({title:"返回顶部"}).click(function(){mainobj.scrollup();return false;}).appendTo("body");if(document.all&&!window.XMLHttpRequest&&mainobj.$control.text()!=""){mainobj.$control.css({width:mainobj.$control.width()});}mainobj.togglecontrol();
			$('a[href="'+mainobj.anchorkeyword+'"]').click(function(){mainobj.scrollup();return false;});
			$(window).bind("scroll resize",function(e){mainobj.togglecontrol();});
		});
	}
};
scrolltotop.init();
</script>
</body>
