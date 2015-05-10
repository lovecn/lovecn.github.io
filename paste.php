<div id="box" style="width:200px;height:200px;border:1px solid;" contenteditable></div>

//javascript http://segmentfault.com/q/1010000000633255 

document.querySelector('#box').addEventListener('paste', function(e) {
    // chrome
    if (e.clipboardData && e.clipboardData.items[0].type.indexOf('image') > -1) {
        var that = this,
            reader = new FileReader();
            file = e.clipboardData.items[0].getAsFile();

        reader.onload = function(e) {
            var xhr = new XMLHttpRequest(),
                fd = new FormData();

            xhr.open('POST', '../upload.php', true);
            xhr.onload = function () {
                var img = new Image();
                img.src = xhr.responseText;
                that.appendChild(img);  // 这里是把上传后得到的地址插入到#box里
            }

            fd.append('file', this.result); // this.result得到图片的base64
            xhr.send(fd);
        }
        reader.readAsDataURL(file);
    }
}, false);
php

<?php
header("Access-Control-Allow-Origin:*");
$url = 'http://'.$_SERVER['HTTP_HOST'];
$file = $_POST["file"];
$data = base64_decode(str_replace('data:image/png;base64,', '', $file));  //截图得到的只能是png格式图片，所以只要处理png就行了
$name = md5(time()) . '.png';  // 这里把文件名做了md5处理
file_put_contents($name, $data);
echo "$url/$name";
