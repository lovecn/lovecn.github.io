<?php
header("Content-Type: application/x-bittorrent");//http://iwww.me/315.html
$torrentnameprefix = '下载中文文件';$row=['save_as'=>'php'];
if ( str_replace("Gecko", "", $_SERVER['HTTP_USER_AGENT']) != $_SERVER['HTTP_USER_AGENT'])
{	
	header ("Content-Disposition: attachment; filename=\"$torrentnameprefix.".$row["save_as"].".torrent\"; charset=utf-8");
}
else if ( str_replace("Firefox", "", $_SERVER['HTTP_USER_AGENT']) != $_SERVER['HTTP_USER_AGENT'] )
{
	header ("Content-Disposition: attachment; filename=\"$torrentnameprefix.".$row["save_as"].".torrent\"; charset=utf-8");
}
else if ( str_replace("Opera", "", $_SERVER['HTTP_USER_AGENT']) != $_SERVER['HTTP_USER_AGENT'] )
{
	header ("Content-Disposition: attachment; filename=\"$torrentnameprefix.".$row["save_as"].".torrent\"; charset=utf-8");
}
else if ( str_replace("IE", "", $_SERVER['HTTP_USER_AGENT']) != $_SERVER['HTTP_USER_AGENT'] )
{
	header ("Content-Disposition: attachment; filename=".str_replace("+", "%20", rawurlencode("$torrentnameprefix." . $row["save_as"] .".torrent")));
}
else
{
	header ("Content-Disposition: attachment; filename=".str_replace("+", "%20", rawurlencode("$torrentnameprefix." . $row["save_as"] .".torrent")));
}
header("Content-Type: application/x-bittorrent");
header("Content-Disposition: attachment; filename=" . "$torrentnameprefix." . rawurlencode($row["save_as"] .".torrent") . ";filename*=". "$torrentnameprefix." . rawurlencode($row["save_as"] .".torrent"));
print(benc($dict));