<?php 
	
	if (isset($_SESSION) && !empty($_SESSION['game'])) {
		header('location:index.php');
		die;
	}
	if (isset($_POST['reg'])) {
		// echo '<pre>';print_r($_POST);
		$db = new PDO('mysql:host=localhost;dbname=game', 'root', null);
		$db->exec('set names utf-8');
		$rs = $db->prepare("SELECT id FROM manager where name=:name");
		$rs->execute(array(':name'=>$_POST['account']));
		$result = $rs->fetchAll(PDO::FETCH_ASSOC);
		if (count($result)) {
			header('location:register.php');
			die;
		}
		$stmt = $db->prepare("INSERT INTO manager (name, password) VALUES (:name, :password)");
		$stmt->execute(array(':name'=>$_POST['account'],':password'=>$_POST['pwd']));
		$db = null;
		session_start();
		$_SESSION['game'] = $_POST['account'];
		setCookie('');
		header('location:register.php');
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
<p>乐享推广员平台</p><a href="login.php" class="zc_hd">登录</a>
 </div>
 <form action="" method="post">
<div class="data_top1">
 <h3 class="dlsq_tit">注册</h3>
 <p class="login_bt">账号</p>
 <input name="account" type="text" class="login_input" id="account">
 <p class="login_bt">密码</p>
 <input name="pwd" type="password" class="login_input" id="pwd"> 
  <p class="login_bt">确认密码</p>
 <input name="pwd_again" type="password" class="login_input" id="pwd_again"> 
<div class="xy_fxk">
<input id="agreement" type="checkbox" /><a href="" class="xy_fxk_l">同意乐享棋牌《用户协议》</a>
</div>

<div class="login_btn">
  <button type="submit" class="login_btn1" name="reg">注册</button>
  <a href="" class="Reset1">重置</a>  
</div>  
</form>
 
</div>

<p class="botom">©2015-2016  乐享游戏  客服微信：wechat</p>
<script type="text/javascript" src="//code.jquery.com/jquery.js"></script>
<script type="text/javascript">
	$(function(){
		$('.login_btn1').click(function(){
			var account = $('#account').val();
			var pwd = $('#pwd').val();
			var pwd_again = $('#pwd_again').val();
			if (account.length < 1) {
				alert('账号不能为空');
				return false;
			};
			if (pwd.length < 1) {
				alert('账号不能为空');
				return false;
			};
			if (pwd.length < 1) {
				alert('账号不能为空');
				return false;
			};
			if (pwd !== pwd_again) {
				alert('密码不一致');
				return false;
			};
			if (!$('#agreement').is(':checked')) {
				alert('请先选择同意《用户协议》');
				return false;
			};
			$.ajax({
				url: 'do_register.php',
				type: 'post',
				dataType: 'json',
				data: {account: account,pwd:pwd},
			})
			.done(function() {
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		})
	});
</script>
</body>
</html>
