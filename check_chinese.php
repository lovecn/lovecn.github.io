
//在javascript中，要判断字符串是中文是很简单的。比如：
var str = "php编程";
if (/^[\u4e00-\u9fa5]+$/.test(str)) {
alert("该字符串全部是中文");
} else {
alert("该字符串不全部是中文");
}
//error
$str = "php编程";
if (preg_match("/^[\u4e00-\u9fa5]+$/",$str)) {
print("该字符串全部是中文");
} else {
print("该字符串不全部是中文");
}

//php \x表示的十六进制数据
$str = "编程";
if (preg_match("/^[\x7f-\xff]+$/", $str)) { //兼容gb2312,utf-8
    echo "正确输入";
} else {
    echo "错误输入";
}


if (preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$str)) {
print("该字符串全部是中文");
} else {
print("该字符串不全部是中文");
}
