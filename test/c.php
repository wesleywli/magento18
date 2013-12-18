<?php
//THIS WORKS!!!!
$WSDLUrl = "http://10.9.100.1/magento18/index.php/api/soap/?wsdl";
$proxy1 = new SoapClient($WSDLUrl,array("trace"=>1));
$sessionId = $proxy1->login('wesley', 'wesleyapikey');

try {
    $result = $proxy1->call($sessionId, 'resource_name.methodName', '1');
}

catch (Exception $e) {
    echo $e->getMessage();
}

var_dump($result);