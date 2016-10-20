<?php /* Smarty version 2.6.25, created on 2013-02-20 03:30:24
         compiled from index.html */ ?>
<body bgcolor="#CBE7F5">
<table border="1" width="50%" height="50%" cellspacing=0 cellpadding=0  align='center'>
<form method="post" action="index.php" id="loginform"  name="frm">
<tr><td colspan='2' align='center'>登陆管理</td></tr>
<tr>
<td align='center'>手机号：</td><td><input type="text" name="mobile" id="mobile" maxlength="11" class="size" placeholder="请输入手机号"/><font id="mobile_error" color="red"></font>
</td>
</tr>
<tr>
<td align='center'>密&nbsp;&nbsp;&nbsp;码：</td><td><input type="password" name="password" id="password" maxlength="16"  class="size" autocomplete="off"/><font color="red" id="pswd_error" ></font>
</td>
</tr>
<input type="hidden" name="mdauth" value="" id="mdauth" >
<input type="hidden" name="login" value="main" id="login">
  <tr>
  <td align='center' colspan='2'><input type='submit' value='登录' name='submit' style="cursor:pointer"></td>
   
  </tr>
</table>
</form>

<script src="common/jquery.ckform.js" type="text/javascript"></script>
<script src="common/jquery.1.5.2.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
ckform('loginform',[
	{ name:'mobile',msg:'手机号码',type:'mobile',min:11,max:11,sp:'mobile_error'},
	{ name:'password',msg:'密码',type:'password',min:6,max:16,sp:'pswd_error'}
	]
	);
</script>
</body>