<?php 

function CurlRequest($url, $data = '')
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_TIMEOUT, 6);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $resultData = curl_exec($curl);
        if (curl_errno($curl)) {
            curl_close($curl);

            return false;
        } else {
            curl_close($curl);

            return $resultData;
        }
    }

// print_r(CurlRequest('http://m.kaolafm.com/event/meizu/detail.html?rid=367&from=timeline&isappinstalled=0','programid=367'));
/*for ($i=0; $i < 1000; $i++) { 
    system("curl -X POST -d 'programid=367' http://m.kaolafm.com/meizuapi/act/program/like?_=1444888956034");
}
die;*/

require_once './Opentok-PHP-SDK/vendor/autoload.php';
// include 'opentok.phar';
use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpenTok\OutputMode;
use OpenTok\ArchiveMode;
use OpenTok\Session;
use OpenTok\Role;
$opentok = new \OpenTok\OpenTok('45373362', 'd9ec618d0e559777a81fbd0f23942765552cba9d');
$redis = new redis();
$redis->connect("127.0.0.1",6379);
var_dump($opentok);
// $session = $opentok->createSession();
$session = $opentok->createSession(array( 'mediaMode' => MediaMode::ROUTED ));
var_dump($session);
// 2_MX40NTM3MzM2Mn5-MTQ0NDc4NzU1MjE5M35WTkxqd3BwSDVxZW5tdEJUdDFTSDdIdnB-fg
echo $sessionId = $session->getSessionId();echo '<br>';
// 1_MX40NTM3MzM2Mn5-MTQ0NDc4NzY2MDYyNX51NW5JTFRFVGp1WHJDdWxJREZXL3pzMlh-fg
// T1==cGFydG5lcl9pZD00NTM3MzM2MiZzaWc9MjViNDQ2OTdjMmQwZmRmODBlMjNjMDk2NzQ1YWIxZGM3MDA5ODUwNzpzZXNzaW9uX2lkPTFfTVg0ME5UTTNNek0yTW41LU1UUTBORGM0TnpZMk1EWXlOWDUxTlc1SlRGUkZWR3AxV0hKRGRXeEpSRVpYTDNwek1saC1mZyZjcmVhdGVfdGltZT0xNDQ0Nzg3NjYwJnJvbGU9cHVibGlzaGVyJm5vbmNlPTE0NDQ3ODc2NjAuOTg0NTc1Mzc3MDg4NA==
$archiveOptions = array(
    'name' => 'Important Presentation',     // default: null
    'hasAudio' => true,                     // default: true
    'hasVideo' => true,                     // default: true
    'outputMode' => OutputMode::INDIVIDUAL  // default: OutputMode::COMPOSED
);
echo $token = $opentok->generateToken($sessionId);echo '<br>';
$archive = $opentok->startArchive($sessionId,$archiveOptions);var_dump($archive);
echo $archiveId = $archive->id;die;
$redis->set('tokbox',$archiveId);

die;
?>
<!-- camera.html -->
<!DOCTYPE html>
<html lang="zh-CN">

<head>

    <meta charset="utf-8">
    <title>实时猫访问摄像头 Demo</title>

    <!-- 非必须，本例中使用 jQuery -->
    <script src="//dn-learning-tech.qbox.me/realtimecat/jquery.min.js"></script>

    <!-- 实时猫 RealTimeCat JavaScript SDK -->
    <script src="//dn-learning-tech.qbox.me/realtimecat/realtimecat-0.1.min.js"></script>

</head>

<body>

    <!-- 定义一个视频容器，命名为"localMediaContainer" -->
    <div id="localMediaContainer"></div>
<h3>您浏览器的检测结果 <a class="btn btn-default btn-sm" id='download-results'>下载检测结果</a></h3><div id="results"></div>
    <script>
        $(document).ready(function(){
            // 创建本地视频流
            var config = {audio: true, video: true, videoSize: ['800px', '600px']};

            // 定义本地视频流对象
            var localStream = new RTCat.Stream(config);

            // 监听已获得视频内容"access-accepted"事件
            localStream.on("access-accepted", function () {
                // 播放本地视频流到"localMediaContainer"
                localStream.play("localMediaContainer");
            });

            // 初始化视频流
            localStream.init();

        });



         (function ($) {
    // 下载检测结果方法https://shishimao.com/playground/browser-capatibility-test
    var JSDownloads = (function () {
        var download = function (filename, text) {
            var element = document.createElement('a');
            element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
            element.setAttribute('download', filename);

            element.style.display = 'none';
            document.body.appendChild(element);

            element.click();

            document.body.removeChild(element);
        };
        return {
            download: download
        }
    })();

    var resultLines;

    (function () {

        // 检测结果
        var browserDetect = new RTCat.Detect();

        browserDetect.getInputDevices(function (err, devices) {
            var beginLine = '===BEGIN OF REALTIMECAT BROWSER DETECT===';

            var userAgentLine = 'User Agent 浏览设备\n' + navigator.userAgent;
            var browserLine = '\nBrowser name 浏览器名称\n' + browserDetect.getBrowser();
            var versionLine = '\nBrowser version 浏览器版本\n' + browserDetect.getVersion();

            var isSupportedLine = '\nOfficially supported by RealTimeCat 已被官方支持\n' + browserDetect.isSupported();
            var getUserMediaLine = '\nUploading my video/audio (getUserMedia) 是否支持音视频上传\n' + browserDetect.WebRtcSupport().getUserMedia;
            var peerConnectionLine = '\nViewing video/audio of others (peerConnection) 是否支持查看他人音视频\n' + browserDetect.WebRtcSupport().peerConnection;
            var dataChannelLine = '\nTransporting files and data(dataChannel) 是否支持传送文件和数据\n' + browserDetect.WebRtcSupport().dataChannel;

            var devicesLine;

            if (err) {
                console.log(err);
                devicesLine = '\nError with Input Devices Test 输入设备测试出错\n' + err
            } else {
                devicesLine = '\nInput Devices 输入设备\n' + devices.map(function (device) {
                        return '\tLabel 名称\n' + device.label
                            + '\n\tID\n' + device.id
                            + '\n\tType 类型\n' + device.type;
                    }).join('');
            }

            var endLine = '\n===END OF REALTIMECAT BROWSER DETECT===';

            resultLines = [beginLine, '', userAgentLine, browserLine, versionLine, '',
                isSupportedLine, getUserMediaLine, peerConnectionLine, dataChannelLine, '',
                devicesLine, endLine].join('\n');

            document.querySelector('#results').innerHTML =
                '<pre class="prettyprint">{resultLines}</pre>'.replace('{resultLines}', resultLines);

            // prettyPrint();
        });
    })();

console.log(resultLines);
    // 下载检测结果
    $('#download-results').click(function () {
        JSDownloads.download('tokbox.txt', resultLines)
    });

}).apply(this, [jQuery]);

    </script>

</body>

</html>
