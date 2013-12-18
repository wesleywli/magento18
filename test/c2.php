<?php
$WSDLUrl2 = "http://emilk.kenmec.com/magento18/index.php/api/v2_soap/?wsdl";
$proxy2 = new SoapClient($WSDLUrl2,array("trace"=>1));
$sessionId2 = $proxy2->login('wesley', 'wesleyapikey');

try {
    $result = $proxy2->resourceNameMethodName($sessionId2, "TestArg");
}

catch (Exception $e) {
    echo $e->getMessage();
    return;
}

var_dump($result);
