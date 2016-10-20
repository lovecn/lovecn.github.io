<?php /* Smarty version 2.6.25, created on 2013-03-12 09:15:55
         compiled from add.html */ ?>
<body bgcolor="#CBE7F5">
<link rel="stylesheet" href="common/common.css" type="text/css" />
<style>
.tabbox { width:100%;height:100%;margin:20px auto;border:0px  solid;padding:10px;}
.tabbox ul { list-style-type:none;clear:both; display:inline;float:left;;z-index:20;width:100%;padding:0;margin:0;text-align:center;}
.tabbox ul li { display:inline;height:20px;line-height:20px;padding:0 15px;z-index:21;}
.tabbox ul li a { text-decoration:none;}
.tabbox ul li.hover { color:#0088CC;border:1px #0069CC solid;border-bottom:1px #0069CC solid;}
.tabbox .tabtext { display:none;clear:both;float:none;position:relative;z-index:15;border:0px  solid;padding:8px;}
</style>
<div class="tabbox">
	<ul>
		<li class="hover"><a href="#living">播出选手</a></li>
		<li><a href="#live">海选选手</a></li>
		<!--<li><a href="#guide">编导</a></li>-->
	</ul>
	<div id="living" class="tabtext"  style="display:block;">
	<form method='post' action='' id='mod'>
	<table border="1" width="60%"  height="60%"  cellspacing='0' cellpadding='0' style="valign：middle"  align='center'>
		<tr>
			<td colspan='2' align='center'>播出选手</td>
		</tr> 
		<tr>
			<td align='center'>选手编号</td>
			<td><input name='player_id'  maxlength="3" value='' id='player_id' ><font id="player_error" color="red"></font></td>
		</tr>
		<tr>
			<td align='center'>选手名字</td>
			<td><input name='player_name'  maxlength="6" value='' id='player_name' ><font id="name_error" color="red"></font></td>
		</tr>
		<tr>
			<td align='center'>选手电话</td><td><input name='player_tel'  maxlength="12" value='' id='player_tel' ><font id="mobile_error" color="red"></font></td>
		</tr>
		<tr>
			<td align='center'>选手状态</td>
			<td><label><input type='radio' name='state' value='1' checked>开启</label><label><input type='radio' name='state' value='0' >关闭</label></td>
		</tr>
		<tr>
			<td align='center'>选手留言</td>
			<td><label><input type='radio' name='message_state' value='1' checked>开启</label><label><input type='radio' name='message_state' value='0' >关闭</label></td>
		</tr>
		
		<tr>
			<td align='center'>选手描述</td>
			<td height='100'><textarea name='descr' value='' style="width:100%;height:100%"  maxlength="255" onkeypress='return descr(this)'></textarea></td>
		</tr>

		<tr>
			<td colspan='2' align='center'><input name='submit' value='提交' type='submit' style="cursor:pointer"><input type='button' onclick='window.history.back(-1)' value='取消' style="cursor:pointer"></td>
		</tr>
	</table>
</form>
</div>
<div id="live" class="tabtext"  style="display:block;" >
<form method='post' action='' id='mod_live'>
	<table border="1" width="60%"  height="60%"  cellspacing='0' cellpadding='0' style="valign：middle"  align='center'>
		<tr>
			<td colspan='2' align='center'>海选选手</td>
		</tr> 
		
		<tr>
			<td align='center'>选手名字</td>
			<td><input name='player_live_name'  maxlength="6" value='' id='player_live_name' ><font id="live_name_error" color="red"></font></td>
		</tr>
		<tr>
			<td align='center'>选手电话</td><td><input name='player_live_tel'  maxlength="12" value='' id='player_live_tel' ><font id="live_mobile_error" color="red"></font></td>
		</tr>
		<tr>
			<td align='center'>投票号码</td>
			<td><input name='vote_live_id'  maxlength="4" value='' id='vote_live_id' ><font id="live_vote_error" color="red"></font></td>
		</tr>
		<tr>
			<td align='center'>选手状态</td>
			<td><label><input type='radio' name='live_state' value='1' checked>开启</label><label><input type='radio' name='live_state' value='0' >关闭</label></td>
		</tr>
		<tr>
			<td align='center'>选手留言</td>
			<td><label><input type='radio' name='message_live_state' value='1' checked>开启</label><label><input type='radio' name='message_live_state' value='0' >关闭</label></td>
		</tr>
		
		<tr>
			<td align='center'>选手描述</td>
			<td height='100'><textarea name='descr_live' value='' style="width:100%;height:100%"  maxlength="255" onkeypress='return descr(this)'></textarea></td>
		</tr>

		<tr>
			<td colspan='2' align='center'><input name='submit_live' value='提交' type='submit' style="cursor:pointer"><input type='button' onclick='window.history.back(-1)' value='取消' style="cursor:pointer"></td>
		</tr>
	</table>
</form>
</div>
<!--<div id="guide" class="tabtext"  >编导添加
</div>-->
</div>
<script src="common/jquery.1.5.2.js" type="text/javascript"></script>
<script src="common/jquery.ckform.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
	ckform('mod',[
	{ name:'player_tel',msg:'手机号码',type:'mobile',min:11,max:12,sp:'mobile_error'}
	,{ name:'player_name',msg:'选手名字',type:'mix',min:2,max:12,sp:'name_error'}
	,{ name:'player_id',msg:'选手编号',type:'int',min:3,max:3,sp:'player_error'}
	]
	);
//if($('#live').is(":visible") ){
	ckform('mod_live',[
	{ name:'player_live_tel',msg:'手机号码',type:'mobile',min:11,max:12,sp:'live_mobile_error'}
	,{ name:'player_live_name',msg:'选手名字',type:'mix',min:2,max:12,sp:'live_name_error'}
	,{ name:'vote_live_id',msg:'投票号码',type:'number',min:4,max:4,sp:'live_vote_error'}
	]
	);
//	}
var descr=function(){return this.value.length<this.getattribute('maxlength'); };
$(function(){
		$('#live').hide();//默认让其隐藏 否则ckform验证不了
		var $li = $('.tabbox>ul>li');
		var $div = $('.tabbox').children('div.tabtext');
		$li.children('a').click(function(e){
			e.stopPropagation();
			e.preventDefault();
		});
		$li.mouseover(function(e){
			$(this).parent().children('li').removeClass('hover');
			$(this).addClass('hover');
			var ref = $(this).children('a').attr('href');
			if(ref!=undefined && ref!=''){
				$(ref).parent().children('div.tabtext').hide();
				$(ref).show();
				//$(ref).show().siblings().hide();
			}
		});
	});
</script>
</body>