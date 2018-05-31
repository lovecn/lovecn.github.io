<?PHP
	$title = '对不起，暂无内容';
	$contents = '对不起，暂无内容';
	if(isset($_GET['id']) && $_GET['id']!=''){
		$str = strip_tags($_GET['id']);
		$str = preg_replace('/drop|delete|create|update| or |\'|\"|\>|\<|\?|\\\|\/|\`|\;|\=|\||\-|\+|\_|\&|\%|\$|\!|\^|\@|\*|\]|\[|\:|\(|\)|\./','',$str);
		include('query.php');
		$conn = new DB();
		$sql = 'SELECT title,contents FROM contents WHERE id='.$str;
		$result = @$conn->get_all($sql);
		if(isset($result[1])){
			
			if($result[1]['title'] == 'ISAinZJICM' || $result[1]['contents'] == 'ISAinZJICM'){
				$title = '恭喜你通关成功';
				$contents = '恭喜你通关成功,通关答案为：'.'<font color=red>'.'ISAinZJICM'.'</font>';
			}
		}else {
			if(isset($result[0]['title'])&& isset($result[0]['contents'])){
				$title = $result[0]['title'];
				$contents = $result[0]['contents'];
			}
		}
	}
	

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html  lang="zh-CN">
<head id="Head">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>	浙江传媒学院 </title>	
	<meta name="keywords" content=" keywords" />
	<meta name="description" content="description" />
	<link id="_DesktopModules_WwwArticles" rel="stylesheet" type="text/css" href="http://www.zjicm.edu.cn/DesktopModules/WwwArticles/module.css" />
	<link id="_Portals__default_" rel="stylesheet" type="text/css" href="http://www.zjicm.edu.cn/Portals/_default/default.css" />
	<link id="_Portals_0_Skins_default_" rel="stylesheet" type="text/css" href="http://www.zjicm.edu.cn/Portals/0/Skins/default/skin.css" />
	<link id="_Portals_0_Containers_default_" rel="stylesheet" type="text/css" href="http://www.zjicm.edu.cn/Portals/0/Containers/default/container.css" />

</head>
<body id="Body">
    <noscript></noscript>
    <form name="Form" method="post" action="" id="Form" enctype="multipart/form-data" style="height: 100%;" autocomplete="off">
<div>
</div>
<div id="pagemaster" align="center">

<div id="skinmaster">

<table width="1000" border="0" align="center" cellspacing="0" cellpadding="0">
<tr><td id="dnn_ControlPanel"></td>
</tr>
</table>

<TABLE id="skinheader" cellSpacing="0" cellPadding="0" width="1000" border="0" align="center">
  <tr>
  <td><img src="http://www.zjicm.edu.cn/Portals/0/Skins/default/images/logo.jpg" /></td>
  <td valign="bottom" align="right">
    <div id="div_topright">
    <div id="div_search">

<input name="dnn$dnnSearch$txtSearch" type="text" maxlength="255" size="20" disabled="disabled" id="dnn_dnnSearch_txtSearch" class="NormalTextBox" />
<a id="dnn_dnnSearch_cmdSearch" class="dnn_search"><img src="http://www.zjicm.edu.cn/Portals/0/Skins/default//images/search.jpg" /></a>
        </div>
    <div id="div_toprightxq">
    <a href="" target="_blank"><img src="http://www.zjicm.edu.cn/Portals/0/Skins/default/images/zhongwen.jpg" border="0" /></a>
    <br />
     <a href="" target="_blank"><img src="http://www.zjicm.edu.cn/Portals/0/Skins/default/images/englishxq.jpg" border="0" /></a></div>
     </div>
  </td>
  </tr>
</TABLE>

<table width="100%" border="0" align="center" cellspacing="0" cellpadding="0">
<tr><td align="center" id="td_new_banner">
    <div id="div_new_banner">
     </div>
</td></tr>
</table>

<table width="100%" border="0" align="center" cellspacing="0" cellpadding="0">
     <tr>
     <td align="center" id="td_menu2">
     <object width='1000 height='80'><param name='movie' value='http://www.zjicm.edu.cn/Portals/0/Skins/default/banner/Banner.swf' /><embed src='http://www.zjicm.edu.cn/Portals/0/Skins/default/banner/Banner.swf' type='application/x-shockwave-flash' width='1000' height='80'></embed></object>
     </td></tr>
</table>

<TABLE cellSpacing="0" cellPadding="0" width="850" id="skinmain" align=center border="0">

    <tr><td style="border-bottom:solid 1px #999999;">
        <div id="yourlocation2">
         您当前的位置 <span id="dnn_dnnBREADCRUMB_lblBreadCrumb"><a href="" class="SkinObject">首页</a></span>
  
        </div>
    </td>
    </tr>
    
    <tr><td style="border-top:solid 0px #999999;">
        <TABLE cellspacing="3" cellpadding="3" width="850" align="center" border="0">
  <TR>
    <TD id="dnn_TopPane" class="toppane DNNEmptyPane" colspan="3" valign="top" align="center"></TD>

  </TR>
  <TR valign="top">
    <TD id="dnn_LeftPane" class="leftpane DNNEmptyPane" valign="top" align="center"></TD>

    <TD id="dnn_ContentPane" class="contentpane" valign="top" align="center">

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="containermaster">
  <tr>
    <td>
      <TABLE border="0" cellpadding="0" cellspacing="0" width="100%" class="CustomLineTable">
	<TR>
	  <TD nowrap valign="top"></TD>
          <TD nowrap valign="top"></TD>
          <TD nowrap valign="top" width="100%">
          	&nbsp;<img a src='http://www.zjicm.edu.cn/Portals/0/Containers/default/images/title_icon.jpg' align="absmiddle" />
          	&nbsp;<span id="dnn_ctr1576_dnnTITLE_lblTitle" class="Head">详细内容</span>



          </TD>
        </TR>
</TABLE>
    </td>
  </tr>
    <TR>
          <TD id="dnn_ctr1576_ContentPane" align="center" class="CustomLineContent DNNAligncenter"><div id="dnn_ctr1576_ModuleContent">
	

<div class="ArticleTitle">
<span id="dnn_ctr1576_ArticleDetails_lblTitle" class="Head"><?PHP echo $title;?></span>
</div>
<div class="ArticleInfo">
    
    
    <span id="dnn_ctr1576_ArticleDetails_lblPostedDate">发布日期:</span>
    <span id="dnn_ctr1576_ArticleDetails_lblDatePosted">2012-5-14</span>&nbsp;&nbsp;
    
    
</div>
<hr />

<div align="left" class="ArticleContent" width="100%">
    
    <span id="dnn_ctr1576_ArticleDetails_lblArticle">
	
	<?PHP echo $contents;?>


</span>
</div>


<a class="CommandButton" href="javascript:window.close();">关闭窗口</a>



</div></TD>

        </TR> 
</table>
<TABLE width="100%" align=center border="0" cellpadding="2" cellspacing="0">
              <TR valign="bottom">
                <TD align="left" nowrap></TD>
                <TD align="right" nowrap>
                
                
                
                </TD>
        </TR>
</TABLE></TD>

    <TD id="dnn_RightPane" class="rightpane DNNEmptyPane" valign="top" align="center"></TD>

  </TR>
  <TR>
    <TD id="dnn_BottomPane" class="bottompane DNNEmptyPane" colspan="3" valign="top" align="center"></TD>

  </TR>
</TABLE>
    </td></tr>
</TABLE>

<table width="100%" border="0" align="center" cellspacing="0" cellpadding="0">
<tr><td>
    <div id="div_red1024"></div>
</td></tr>
</table>

<table width="850" border="0" align="center" cellspacing="0" cellpadding="0">
<tr><td>
    <div id="div_footer">
        <span id="dnn_dnnCOPYRIGHT_lblCopyright" class="SkinObject">Copyright &copy;  浙江传媒学院党委宣传部 2008-2011 <a href="" target="blank" class="skinobject">浙ICP备0501457号</a><br>中国·浙江·杭州下沙高教园区学源街998号<br>&nbsp;&nbsp;&nbsp;&nbsp;技术支持：浙江传媒学院信息化办公室</span>

        <a id="dnn_dnnLOGIN_cmdLogin" class="SkinObject">后台管理</a>
    </div>
</td></tr>
</table>

</div>

</div>
</form>
</body>
</html>