<?php /* Smarty version 2.6.25, created on 2013-03-11 08:59:21
         compiled from stat.html */ ?>
<title>选手管理</title>
<body bgcolor="#CBE7F5">
<link rel="stylesheet" href="common/common.css" type="text/css" />
<link rel="shortcut icon" href="mingyun60.ico" type="image/x-icon" />
<link href="common/jquery-ui.css" rel="stylesheet" type="text/css" media="screen" />
<link href="common/jquery-ui-timepicker.css" rel="stylesheet" type="text/css" media="screen" />
<script src="common/jquery.1.5.2.js" type="text/javascript"></script>
<script type="text/javascript" src="common/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="common/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" charset="utf-8" defer>
	$(function(){
		$("#datetime").datepicker({
			changeMonth: true,changeYear: true,showWeek:true,navigationAsDateFormat:true,gotoCurrent:true,buttonImageOnly:true,hideIfNoPrevNext:true,minDateTime: 0,dateFormat:'yy-mm-dd'
		});
	});
</script>
<div class='player'>
<table border="1" width="80%" height="80%" cellspacing=0 cellpadding=0 style="valign：middle;margin:auto" align='center'>
	<form name='form' method='get' id='post'>
	<tr>
       <td  colspan='6' class='player' valign="middle"  align='center'>播出选手每日统计信息</td>
	</tr>
		<tr><td colspan='6' style='background:repeat-x 0 -222px;' align='center'><input type='text' name='time'   id="datetime" class="Wdate"   maxlength='12' autocomplete="off" x-webkit-speech speech placeholder="请选择时间" style="border:1px solid #FFF;outline:none;font-size:14px;color:#999 !important;"><input type='submit' value='搜索' style="cursor:pointer" id='submit' name='search'></td>
	</form>
	</tr>
    <tr>
       <td class='player' valign="middle"  align='center'>选手编号</td>
	   <td class='player'>选手名字</td>
       <td class='player'>选手电话</td>
	   <!--<td class='player'>投票数</td>-->
	   <td class='player'>留言数</td>
      <td class='player'>通话数</td>
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
			  <!--<td class='player' ><?php echo $this->_tpl_vars['v']['votes']; ?>
</td>-->
			  <td class='player' ><?php echo $this->_tpl_vars['v']['number']; ?>
</td>
			  <td class='player' ><?php echo $this->_tpl_vars['v']['calls']; ?>
</td>
			</tr>
	<?php endforeach; endif; unset($_from); ?>
<tr>
	<td colspan='5' align='center'>总共<font size="30px" color="red"><?php echo $this->_tpl_vars['pageTotal']; ?>
</font>页&nbsp;当前是第<font size="30px" color="red"><?php echo $this->_tpl_vars['p']; ?>
</font>页&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<!--<a href="manage.php?p=1">首页</a>
   <?php if ($this->_tpl_vars['p'] > 1): ?>
   	<a href="manage.php?p=<?php echo $this->_tpl_vars['p']-1; ?>
">上一页</a>
   <?php endif; ?>
   <?php if ($this->_tpl_vars['p'] < $this->_tpl_vars['pageTotal']): ?>
   	<a href="manage.php?p=<?php echo $this->_tpl_vars['p']+1; ?>
">下一页</a>
   <?php endif; ?>
 
 <a href="manage.php?p=<?php echo $this->_tpl_vars['pageTotal']; ?>
">尾页</a>-->
  <?php $_from = ($this->_tpl_vars['list']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
           	<a href="<?php echo $this->_tpl_vars['url']; ?>
?&p=<?php echo $this->_tpl_vars['v']; ?>
" ><?php if ($this->_tpl_vars['v'] == $this->_tpl_vars['p']): ?><font size='30px' color='red'><?php echo $this->_tpl_vars['v']; ?>
</font><?php else: ?><font size='10px' ><?php echo $this->_tpl_vars['v']; ?>
</font><?php endif; ?></a>&nbsp;&nbsp;
  <?php endforeach; endif; unset($_from); ?>
		<select onchange="location.href='<?php echo $this->_tpl_vars['url']; ?>
?&p='+this.value">
         <?php $_from = ($this->_tpl_vars['num']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
           	<option value="<?php echo $this->_tpl_vars['v']; ?>
" <?php if ($this->_tpl_vars['v'] == $this->_tpl_vars['p']): ?>selected="selected"<?php endif; ?>>第<?php echo $this->_tpl_vars['v']; ?>
页</option>
           <?php endforeach; endif; unset($_from); ?>
       </select>
	   <input type='button' onclick="window.location = 'manage.php';" value='首页' style="cursor:pointer">
 </td>
</tr>  
</table>
  </div>
</body>