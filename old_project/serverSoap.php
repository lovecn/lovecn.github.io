<?php
header('content-type:text/html;charset=utf-8');

$soap = new SoapServer(null,array('uri'=>"127.0.0.1"));//This uri is your SERVER ip.
$soap->addFunction('minus_func');                                                 //Register the function
$soap->addFunction(SOAP_FUNCTIONS_ALL);
$soap->handle();

function minus_func($i, $j){
    $res = $i - $j;
    return $res;
}

















