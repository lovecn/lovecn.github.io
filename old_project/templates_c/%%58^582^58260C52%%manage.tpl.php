<?php /* Smarty version 2.6.25, created on 2013-04-08 12:39:18
         compiled from manage.tpl */ ?>

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
   <?php $_from = ($this->_tpl_vars['xuanshou']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>        	
   <tr>
        <td  class='player'><?php echo $this->_tpl_vars['v']['player_id']; ?>
</td>
	 <td class='player' ><?php if ($this->_tpl_vars['v']['player_name'] != null): ?><?php echo $this->_tpl_vars['v']['player_name']; ?>
<?php else: ?>&nbsp; <?php endif; ?></td>
        <td class='player' ><?php echo $this->_tpl_vars['v']['player_tel']; ?>
</td>
        <td class='player' ><?php if ($this->_tpl_vars['v']['state'] == 1): ?>开启<?php else: ?>关闭<?php endif; ?></td>
        <td class='player' ><?php echo $this->_tpl_vars['v']['vote_id']; ?>
</td>
	<td class='player' ><?php if ($this->_tpl_vars['v']['message_state'] == 1): ?>开启<?php else: ?>关闭<?php endif; ?></td>
	<!--<td class='player'>
		<?php if ($this->_tpl_vars['v']['votes'] > 0): ?><a href='vote.php?vote=<?php echo $this->_tpl_vars['v']['vote_id']; ?>
' title='查看他的投票情况'><font size="10px" ><?php echo $this->_tpl_vars['v']['votes']; ?>
</font></a>
		<?php else: ?><?php echo $this->_tpl_vars['v']['votes']; ?>

		<?php endif; ?>
		</td>-->
	<td class='player' id='<?php echo $this->_tpl_vars['v']['unique_id']; ?>
'>
		<?php if ($this->_tpl_vars['v']['number'] > 0): ?>
			<a href='mess.php?player_unique=<?php echo $this->_tpl_vars['v']['unique_id']; ?>
&secure=<?php echo $this->_tpl_vars['v']['secure']; ?>
' title='查看他的留言情况'><font size="10px" ><?php echo $this->_tpl_vars['v']['number']; ?>
</font>
			  <?php else: ?>
			  <?php echo $this->_tpl_vars['v']['number']; ?>

			  <?php endif; ?></a>
			  <script >$(function(){
						(function(){
						var player_unique=<?php echo $this->_tpl_vars['v']['unique_id']; ?>
;
						var secure="<?php echo $this->_tpl_vars['v']['secure']; ?>
";
						//var liuyan="<a href=http://222.35.101.188/vxml/wav/message/"+player_unique  +" title='点击收听他的所有留言'>";
						var liuyan="<a href=mess.php?player_unique="+player_unique+"&secure="+secure +" title='点击收听他的所有留言'>";
						$.get("http://222.35.101.188/vxml/msg.php?player_unique="+player_unique+"&secure="+secure,"",function(data){
							if(data.count>0){
								//$('#<?php echo $this->_tpl_vars['v']['unique_id']; ?>
').html(liuyan+'<font size="10px" >'+data.count+'</font></a>');
							}else{
								//$('#<?php echo $this->_tpl_vars['v']['unique_id']; ?>
').html(data.count);
							}
						},'json');
					})();
				}); 
				</script></td>
		<td class='player' >
			<?php if ($this->_tpl_vars['v']['calls'] > 0): ?>
				<a href='tel.php?tel=<?php echo $this->_tpl_vars['v']['player_tel']; ?>
' title='查看他的通话情况'><font size="10px" ><?php echo $this->_tpl_vars['v']['calls']; ?>
</font></a>
				<?php else: ?>
				<?php echo $this->_tpl_vars['v']['calls']; ?>

				<?php endif; ?>
		</td>
		<td class='player' ><textarea name='descr' value='' style="width:100%;height:100%" disabled><?php echo $this->_tpl_vars['v']['descr']; ?>
</textarea></td>
		<td class='' align='center'>
			<form method='post' action="edit.php?id=<?php echo $this->_tpl_vars['v']['unique_id']; ?>
&player_id=<?php echo $this->_tpl_vars['v']['player_id']; ?>
">
				<table border=0 cellspacing=0 cellpadding=0  >
				<tr>
					<td ><input type='submit' value='修改' name='edit' style="cursor:pointer"></td>
				</tr>
				</table>
			</form>
				<form method='post' action="manage.php?id=<?php echo $this->_tpl_vars['v']['unique_id']; ?>
" id='del'>
					<table border=0 cellspacing=0 cellpadding=0  >
					<tr>
					<!--<td ><input type='submit' value='删除' name='delete' id='delete' style="cursor:pointer" onclick="return del()"></td>-->
					</tr>
					</table>
				</form>
			  </td>
        	</tr>
	<?php endforeach; endif; unset($_from); ?>
	<tr>
	<td colspan='9' align='center'>共<font size="30px" color="red"><?php echo $this->_tpl_vars['pageTotal']; ?>
</font>页&nbsp;第<font size="30px" color="red"><?php echo $this->_tpl_vars['p']; ?>
</font>页&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="manage.php?p=1">首页</a>
   <?php if ($this->_tpl_vars['p'] > 1): ?>
   	<a href="manage.php?p=<?php echo $this->_tpl_vars['p']-1; ?>
">上一页</a>
   <?php endif; ?>
	<?php $_from = ($this->_tpl_vars['list']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
           	<a href="?&p=<?php echo $this->_tpl_vars['v']; ?>
" ><?php if ($this->_tpl_vars['v'] == $this->_tpl_vars['p']): ?><font size='30px' color='red'><?php echo $this->_tpl_vars['v']; ?>
</font><?php else: ?><font size='10px' ><?php echo $this->_tpl_vars['v']; ?>
</font><?php endif; ?></a>&nbsp;&nbsp;
   <?php endforeach; endif; unset($_from); ?>
   <?php if ($this->_tpl_vars['p'] < $this->_tpl_vars['pageTotal']): ?>
   	<a href="manage.php?p=<?php echo $this->_tpl_vars['p']+1; ?>
">下一页</a>
   <?php endif; ?>
 
 <a href="manage.php?p=<?php echo $this->_tpl_vars['pageTotal']; ?>
">尾页</a>
  
		<select onchange="location.href='manage.php?p='+this.value">
         <?php $_from = ($this->_tpl_vars['num']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
           	<option value="<?php echo $this->_tpl_vars['v']; ?>
" <?php if ($this->_tpl_vars['v'] == $this->_tpl_vars['p']): ?>selected="selected"<?php endif; ?>>第<?php echo $this->_tpl_vars['v']; ?>
页</option>
         <?php endforeach; endif; unset($_from); ?>
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
	<?php $_from = ($this->_tpl_vars['live_xuanshou']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>        	
			<tr>
        	  <td  class='player'><?php echo $this->_tpl_vars['v']['player_id']; ?>
</td>
			  <td class='player' ><?php if ($this->_tpl_vars['v']['player_name'] != null): ?><?php echo $this->_tpl_vars['v']['player_name']; ?>
<?php else: ?>&nbsp; <?php endif; ?></td>
        	  <td class='player' ><?php if ($this->_tpl_vars['v']['player_tel'] != false): ?><?php echo $this->_tpl_vars['v']['player_tel']; ?>
<?php else: ?>&nbsp;<?php endif; ?></td>
        	  <td class='player' ><?php if ($this->_tpl_vars['v']['state'] == 1): ?>开启<?php else: ?>关闭<?php endif; ?></td>
        	  <td class='player' ><?php echo $this->_tpl_vars['v']['vote_id']; ?>
</td>
			  <td class='player' ><?php if ($this->_tpl_vars['v']['message_state'] == 1): ?>开启<?php else: ?>关闭<?php endif; ?></td>
			  <td class='player'>
				<?php if ($this->_tpl_vars['v']['votes'] > 0): ?>
					<a href='vote.php?vote=<?php echo $this->_tpl_vars['v']['vote_id']; ?>
' title='查看他的投票情况'><font size="10px" ><?php echo $this->_tpl_vars['v']['votes']; ?>
</font></a>
				<?php else: ?>
				<?php echo $this->_tpl_vars['v']['votes']; ?>

				<?php endif; ?>
			  </td>
			  <!--<td class='player' id='<?php echo $this->_tpl_vars['v']['unique_id']; ?>
'>
			  <?php if ($this->_tpl_vars['v']['number'] > 0): ?>
				<a href='mess.php?player_unique=<?php echo $this->_tpl_vars['v']['unique_id']; ?>
&secure=<?php echo $this->_tpl_vars['v']['secure']; ?>
' title='查看他的留言情况'><font size="10px" ><?php echo $this->_tpl_vars['v']['number']; ?>
</font>
			  <?php else: ?>
			  <?php echo $this->_tpl_vars['v']['number']; ?>

			  <?php endif; ?></a>
			  </td>
				<td class='player' >
				<?php if ($this->_tpl_vars['v']['calls'] > 0): ?>
					<a href='tel.php?tel=<?php echo $this->_tpl_vars['v']['player_tel']; ?>
' title='查看他的通话情况'><font size="10px" ><?php echo $this->_tpl_vars['v']['calls']; ?>
</font></a>
				<?php else: ?>
				<?php echo $this->_tpl_vars['v']['calls']; ?>

				<?php endif; ?>
				</td>-->
			  <td class='player' ><textarea name='descr' value='' style="width:100%;height:100%" disabled><?php echo $this->_tpl_vars['v']['descr']; ?>
</textarea></td>
			  <td class='' align='center'>
				<form method='post' action="edit.php?id=<?php echo $this->_tpl_vars['v']['unique_id']; ?>
&vote_id=<?php echo $this->_tpl_vars['v']['vote_id']; ?>
">
				<table border=0 cellspacing=0 cellpadding=0  >
				<tr>
					<td ><input type='submit' value='修改' name='edit' style="cursor:pointer"></td>
				</tr>
				</table>
				</form>
				<form method='post' action="manage.php?id=<?php echo $this->_tpl_vars['v']['unique_id']; ?>
" id='del'>
					<table border=0 cellspacing=0 cellpadding=0  >
					<tr>
					<!--<td ><input type='submit' value='删除' name='delete' id='delete' style="cursor:pointer" onclick="return del()"></td>-->
					</tr>
					</table>
				</form>
			  </td>
        	</tr>
	<?php endforeach; endif; unset($_from); ?>
 <tr>
	<td colspan='8' align='center'>共<font size="30px" color="red"><?php echo $this->_tpl_vars['page_Total']; ?>
</font>页&nbsp;第<font size="30px" color="red"><?php if (isset ( $this->_tpl_vars['page'] )): ?><?php echo $this->_tpl_vars['page']; ?>
<?php else: ?>1<?php endif; ?></font>页&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="manage.php?page=1">首页</a>
   <?php if (isset ( $this->_tpl_vars['page'] ) && $this->_tpl_vars['page'] > 1): ?>
   	<a href="manage.php?page=<?php echo $this->_tpl_vars['page']-1; ?>
">上一页</a>
   <?php endif; ?>
   <?php $_from = ($this->_tpl_vars['page_list']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
         <a href="?&page=<?php echo $this->_tpl_vars['v']; ?>
" ><?php if ($this->_tpl_vars['v'] == $this->_tpl_vars['page']): ?><font size='30px' color='red'><?php echo $this->_tpl_vars['v']; ?>
</font><?php else: ?><font size='10px' ><?php echo $this->_tpl_vars['v']; ?>
</font><?php endif; ?></a>&nbsp;&nbsp;
   <?php endforeach; endif; unset($_from); ?>
   <?php if (isset ( $this->_tpl_vars['page'] ) && $this->_tpl_vars['page'] < $this->_tpl_vars['page_Total']): ?>
   	<a href="manage.php?page=<?php echo $this->_tpl_vars['page']+1; ?>
">下一页</a>
   <?php endif; ?>
 
 <a href="manage.php?page=<?php echo $this->_tpl_vars['page_Total']; ?>
">尾页</a>
  
	<select onchange="location.href='manage.php?page='+this.value">
         <?php $_from = ($this->_tpl_vars['page_num']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
           	<option value="<?php echo $this->_tpl_vars['v']; ?>
" <?php if ($this->_tpl_vars['v'] == $this->_tpl_vars['page']): ?>selected="selected"<?php endif; ?>>第<?php echo $this->_tpl_vars['v']; ?>
页</option>
         <?php endforeach; endif; unset($_from); ?>
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
		<?php if (isset ( $this->_tpl_vars['page'] )): ?>
			$('#live_hover').addClass('hover');
			$('#living_hover').removeClass('hover');
			$('#live').show();
			$('#living').hide();
		<?php endif; ?>
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