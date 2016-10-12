<?php 
	session_start();
	$randCode = $_SESSION['rand_code'] = md5(uniqid());
	if (isset($_SESSION) && !empty($_SESSION['game'])) {
		header('location:index.php');
		die;
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="target-densitydpi=device-dpi, width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>乐享游戏 后台登录</title>
<link rel="stylesheet" href="css/css.css" />
</head>

<body>
<div class="head">
<p>乐享推广员平台</p><a href="register.php" class="zc_hd">注册</a>
 </div>
<div class="data_top1">
 <h3 class="dlsq_tit">登录</h3>
 <p class="login_bt">账号</p>
 <input name="" type="text" class="login_input" id="account">
 <p class="login_bt">密码</p>
 <input name="" type="password" class="login_input" id="pwd"> 
 <p class="login_bt">验证码</p> 
 <div class="yzm_boy"><input name="" type="text" class="login_input1" id="captcha">
 <input name="" type="hidden" class="login_input1" id="rand_code" value="<?php echo $randCode;?>" >
<img id="code" src="create_code.php" alt="看不清楚,换一张" style="cursor: pointer; vertical-align:middle;" onclick="javascript:this.src='create_code.php?zZWa4zWG&tm='+Math.random()" /></div>
<div class="login_btn">
  <a href="index.html" class="login_btn1">登录</a>
  <a href="" class="Reset1">重置</a>  
</div>  

 
</div>

<p class="botom">©2015-2016  乐享游戏  客服微信：wechat</p>
<script type="text/javascript" src="//cdn.bootcss.com/jquery/1.11.1/jquery.js"></script>
<script type="text/javascript">
$(function(){
	$('.login_btn1').click(function(){
			var account = $('#account').val();
			var pwd = $('#pwd').val();
			var captcha = $('#captcha').val();
			var rand_code = $('#rand_code').val();
			if (account.length < 1) {
				alert('账号不能为空');
				return false;
			};
			if (pwd.length < 1) {
				alert('密码不能为空');
				return false;
			};
			if (captcha.length < 1) {
				alert('验证码不能为空');
				return false;
			};
			$.ajax({
				url: 'do_ajax.php',
				type: 'post',
				dataType: 'json',
				data: {account: account,pwd:pwd,captcha:captcha,rand_code:rand_code,type:'login'},
			})
			.done(function(res) {
				if (res.code === 1) {
					alert(res.msg);
					location.reload();
				} else {
					alert(res.msg);
				}
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			return false;
			
		});
});
</script>
</body>
</html>
