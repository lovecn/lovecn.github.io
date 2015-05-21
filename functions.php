<?php


function getUserLocation($services) {

        $ctx = stream_context_create(array('http' => array('timeout' => 15))); // 15 seconds timeout

        for ($i = 0; $i < count($services); $i++) {

            // Configuring curl options
            $options = array (
                CURLOPT_RETURNTRANSFER => true, // return web page
                //CURLOPT_HEADER => false, // don't return headers
                CURLOPT_HTTPHEADER => array('Content-type: application/json'),
                CURLOPT_FOLLOWLOCATION => true, // follow redirects
                CURLOPT_ENCODING => "", // handle compressed
                CURLOPT_USERAGENT => "test", // who am i
                CURLOPT_AUTOREFERER => true, // set referer on redirect
                CURLOPT_CONNECTTIMEOUT => 5, // timeout on connect
                CURLOPT_TIMEOUT => 5, // timeout on response
                CURLOPT_MAXREDIRS => 10 // stop after 10 redirects
            ); 

            // Initializing curl
            $ch = curl_init($services[$i]);
            curl_setopt_array ( $ch, $options );

            $content = curl_exec ( $ch );
            $err = curl_errno ( $ch );
            $errmsg = curl_error ( $ch );
            $header = curl_getinfo ( $ch );
            $httpCode = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );

            curl_close ( $ch );

            //echo 'service: ' . $services[$i] . '</br>';
            //echo 'err: '.$err.'</br>';
            //echo 'errmsg: '.$errmsg.'</br>';
            //echo 'httpCode: '.$httpCode.'</br>';
            //print_r($header);
            //print_r(json_decode($content, true));

            if ($err == 0 && $httpCode == 200 && $header['download_content_length'] > 0) {

                return json_decode($content, true);

            } 

        }
    }
$ip_srv = array("http://freegeoip.net/json/$this->ip","http://smart-ip.net/geoip-json/$this->ip");

getUserLocation($ip_srv);
