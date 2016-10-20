<?php
header('content-type:text/html;charset=utf-8');
/*
1. 留言查询接口
http://222.35.101.188/vxml/msg.php?player_unique=1&secure=5d2bbc279b5ce75815849d5e3f0533ec
player_unique是表player的unique_id
secure是校验串生成方式为md5("player" . $player_unique)

例如
http://222.35.101.188/vxml/msg.php?player_unique=1&secure=5d2bbc279b5ce75815849d5e3f0533ec
返回
{"msg":["130112135225_13601171280.wav","130130162548_13601171280.wav","130112135258_13601171280.wav","130114174451_15011485081.wav","130114122438_210.wav"],"count":5}

2. ftp连接
ftp://ftpuser:ftppwd@ip/player_unique/file.wav
例如
ftp://destinymsg:destinymsglovecn@222.35.101.188/1/130112135225_13601171280.wav
*/

$player = $_GET["player_unique"];
$secure = $_GET["secure"];
$arr = array();
$i = 0;
if ($player && md5("player" . $player) == $secure){
   // $base_dir = "/web/love/vxml/wav/message/$player";
$base_dir = "http://222.35.101.188/vxml/wav/message/$player";
    $fso  = opendir($base_dir);
    while($flist=readdir($fso)){
        if (substr($flist, strlen($flist) - 3) == "wav"){
            $arr["msg"][] = $flist;
            $i++;
        }
    }
    closedir($fso);
}
$arr["count"] = $i;
echo json_encode($arr);
?>