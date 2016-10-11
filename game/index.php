<?php 
	session_start();
	if (empty($_SESSION['game'])) {
		header('location:register.php');
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
<style type="text/css">
body{ background:#fff;}
</style>
</head>

<body>
<div class="head">
<a href="index.php" class="fanhi displayc"></a>
<p>乐享推广员平台</p>
<button class="logout" style="float:right;">退出登录</button>
</div>

<div class="head_top">
 <div class="head_top_left">
 <p class="htl_name">欢迎回来 <?php echo $_SESSION['game'];?></p></div><img src="images/portrait.png" class="htad_tx">
 <div class="head_top_right">我的房卡：0张</div>
</div>
<!---->
<div class="data_boy">
<div class="data_top1">
 <h3 class="dlsq_tit">玩家充值</h3>
 <p class="dlsq_bt">请输入玩家ID</p>
 <input name="" type="text" class="inpt_style1">

 <p class="dlsq_bt">请输入卡数</p>
 <div><input name="" type="text" class="inpt_style1 inpt_style3"> <span class="ks_right">张卡</span></div>
 
<div class="login_btn">
 <a href="" class="Recharge">充值</a> 
</div> 
</div>


<div class="data_top1">
<div class="login_btn">
 <a href="authorization.php" class="Recharge1">查询玩家充值记录></a> 
 <a href="returncard.php" class="Recharge2">查看玩家充值列表></a>  
</div> 
</div>
 
</div>
<!---->
 

    
<p class="botom">©2015-2016  乐享棋牌  客服微信：wechat</p>
<script type="text/javascript" src="//cdn.bootcss.com/jquery/1.11.1/jquery.js"></script>
<script type="text/javascript">
	$(function(){
		$('.logout').click(function(){
			$.ajax({
				url: 'do_ajax.php',
				type: 'post',
				dataType: 'json',
				data: {account: "<?php echo $_SESSION['game'];?>",type:'logout'},
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
		})
	})
</script>
</body>
</html>
