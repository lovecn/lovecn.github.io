<?php /* Smarty version 2.6.25, created on 2013-03-04 07:52:04
         compiled from edit.html */ ?>
<body bgcolor="#CBE7F5">
	<link rel="stylesheet" href="common/common.css" type="text/css" />
	<link rel="shortcut icon" href="mingyun60.jpg" />
	<script src="common/jquery.ckform.js" type="text/javascript"></script>
	<script src="common/jquery.1.5.2.js" type="text/javascript"></script>
	<form method='post' action="edit.php?id=<?php echo $this->_tpl_vars['id']; ?>
" id='mod'>
		<table border="1" width="60%"  height="60%" cellspacing=0 cellpadding=0 style="valign：middle" align='center'>
		<?php $_from = ($this->_tpl_vars['xuanshou']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?> 
		<tr>
			<td colspan='2' align='center'>选手资料修改</td>
		</tr>    
		<tr>
			<td align='center' >选手编号</td>
			<td><input name='player_id' maxlength="3" id='player_id' value=<?php echo $this->_tpl_vars['v']['player_id']; ?>
><font id="player_error" color="red"></font></td>
		</tr>
		<tr>
			<td align='center'>选手名字</td>
			<td><input name='player_name'  maxlength="6"  id='player_name'  value=<?php echo $this->_tpl_vars['v']['player_name']; ?>
><font id="name_error" color="red"></font></td>
		</tr>
		<tr>
			<td align='center'>选手电话</td>
			<td><input name='player_tel' maxlength="12" id='player_tel' value= <?php echo $this->_tpl_vars['v']['player_tel']; ?>
><font id="mobile_error" color="red"></font></td>
		</tr>
		<tr>
			<td align='center'>选手状态</td>
			<td><label><input type='radio' name='state' value='1' <?php if ($this->_tpl_vars['v']['state'] == 1): ?>checked<?php endif; ?>>开启</label><label><input type='radio' name='state' value='0' <?php if ($this->_tpl_vars['v']['state'] == 0): ?>checked<?php endif; ?>>关闭</label></td>
		</tr>
       <tr>
			<td align='center'>选手留言</td>
			<td><label><input type='radio' name='message_state' value='1' <?php if ($this->_tpl_vars['v']['message_state'] == 1): ?>checked<?php endif; ?> >开启</label><label><input type='radio' name='message_state' value='0'  <?php if ($this->_tpl_vars['v']['message_state'] == 0): ?>checked<?php endif; ?>>关闭</label></td>
	   </tr>
		<tr>
			<td align='center'>投票号码</td>
			<td><input name='vote_id' id='vote_id' maxlength="4" value=<?php echo $this->_tpl_vars['v']['vote_id']; ?>
><font id="vote_error" color="red"></font></td></tr>
		<tr>
			<td align='center'>选手描述</td>
			<td  height='100'><textarea style="width:100%;height:100%" maxlength="255" name='descr'   onkeypress='return descr(this)'><?php echo $this->_tpl_vars['v']['descr']; ?>
</textarea></td>
		</tr>
		<tr>
			
			<td align='center' colspan='2'><input type='submit' value='提交' name='submit' style="cursor:pointer"><input type='button' onclick='window.history.back(-1)' value='取消' style="cursor:pointer"></td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
	</table>
	</form>
	 <script type="text/javascript" charset="utf-8">

ckform('mod',[
	{ name:'player_tel',msg:'手机号码',type:'mobile',min:11,max:12,sp:'mobile_error'}
	//,{ name:'player_name',msg:'选手名字',type:'mix',min:2,max:12,sp:'name_error'}
	//,{ name:'player_id',msg:'选手编号',type:'int',min:3,max:3,sp:'player_error'}
	//,{ name:'vote_id',msg:'选手投票号码',type:'number',min:4,max:4,sp:'vote_error'}
	]
	);
	var descr=function(){return this.value.length<this.getattribute('maxlength'); };
</script>
</body>