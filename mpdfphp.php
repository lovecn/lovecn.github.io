<?php 
/*$fp = fopen("PHP+7-ThinkinLamp.pdf", "r");
header("Content-type: application/pdf");
fpassthru($fp);
fclose($fp);*/
// http://www.mpdf1.com/mpdf/index.php?page=Download http://www.yaocheap.com/phptec/52.html
set_time_limit(0);
include('mpdf56/mpdf.php');
    // $mpdf = new mPDF('zh-CN'); 
    $mpdf=new mPDF('utf-8','A4','','宋体',0,0,20,10);
    //设置字体,解决中文乱码
$mpdf->useAdobeCJK = true;
$mpdf->SetAutoFont(AUTOFONT_ALL);
    $mpdf->useAdobeCJK = true;
    $mpdf->SetDisplayMode('fullpage');
    $url = 'http://www.yaocheap.com/phptec/52.html';
    //设置PDF页眉内容
$header='<table width="95%" style="margin:0 auto;border-bottom: 1px solid #4F81BD; vertical-align: middle; font-family:
serif; font-size: 9pt; color: #000088;"><tr>
<td width="10%"></td>
<td width="80%" align="center" style="font-size:16px;color:#A0A0A0">页眉</td>
<td width="10%" style="text-align: right;"></td>
</tr></table>';
 
//设置PDF页脚内容
$footer='<table width="100%" style=" vertical-align: bottom; font-family:
serif; font-size: 9pt; color: #000088;"><tr style="height:30px"></tr><tr>
<td width="10%"></td>
<td width="80%" align="center" style="font-size:14px;color:#A0A0A0">页脚</td>
<td width="10%" style="text-align: left;">页码：{PAGENO}/{nb}</td>
</tr></table>';
 
//添加页眉和页脚到pdf中
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
    $strContent = file_get_contents($url); 
    $mpdf->showWatermarkText = true;
    $mpdf->WriteHTML($strContent);
    $mpdf->Output(); //直接输出pdf内容
    //$mpdf->Output('tmp.pdf',true);//保存成pdf文件