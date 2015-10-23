<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title></title>
<!-- bootstrap -->
<link href="http://www.vhall.com/static/css/bootstrap.min.css" rel="stylesheet">
 <script src="http://www.vhall.com/static/js/jquery-1.7.2.min.js"></script>
<script src="http://www.vhall.com/static/js/bootstrap.min.js"></script>
<!-- HTML5 shim and respond.js IE 8 supports of html5 elements and queries -->
<!--[if lt IE 9]>
<script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
body{background:#f3f4f6;}
.container{padding:0;margin:0 auto;}
.container img{width:53%;margin-left:10px;margin-top:50px;}
h1{font-family:'黑体';font-size:16px;color:#1074b9;font-weight:normal;line-height:50px;}
.fl{width:42%;margin-top:80px;}
.btn{background:#1074b9 url(http://www.vhall.com/static/images/myapp/icon.png) no-repeat 6px 6px;height:35px;color:#fff;padding-left:30px;font-size:14px; background-size:20px 48px;padding-right:8px;margin:5px auto;}
.modal-content{padding:10px;}
.android{background-position:4px -22px;padding-left:25px;}
@media screen and (min-width: 960px){.container{width:640px;margin:0 auto;}}
</style>
</head>
<?php 
    $http_agent = strtoupper($_SERVER['HTTP_USER_AGENT']);
    if(strpos($http_agent, 'MICROMESSENGER') === false && strpos($http_agent, 'WINDOWS PHONE') === false ){ 
        $weixin = 'N';
    }else{ 
        $weixin = 'Y';
    }
?>
<body role="document">
	<div class="container" <?php if ($weixin=='Y'){echo 'data-toggle="modal" data-target="#myModal"';}?>>
    	<img class="img-responsive pull-left" src="http://www.vhall.com/static/images/myapp/phone.png" />
        <div class="pull-left fl">
            <h1>微吼直播客户端</h1>
            <?php 
                if($weixin=='Y'){
                    echo '<a href="javascript:;" class="btn iphone">iPhone版下载</a><br/>
                          <a href="javascript:;" class="btn android">Android版下载</a>';
                }else{
                    echo ' <a href="http://itunes.apple.com/cn/app/id840884836" class="btn iphone" target="_blank">iPhone版下载</a><br/>
                           <a href="http://static.vhall.com/download/android_vhall_portal.apk" class="btn android">Android版下载</a>';
                }
            ?>
         
        </div>
    </div>
    <?php 
        if($weixin=='Y'){
            echo ' 
            <!-- 模态框（Modal） -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
               aria-labelledby="myModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <img class="img-responsive" src="http://www.vhall.com/static/images/myapp/pupup.jpg" />
                  </div><!-- /.modal-content -->
            </div><!-- /.modal -->';
        }
    ?>
</body>
</html>