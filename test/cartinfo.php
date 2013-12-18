<?php
$proxy = new SoapClient('http://emilk.kenmec.com/magento17/index.php/api/v2_soap/?wsdl',array("trace"=>1)); // TODO : change url
$sessionId = $proxy->login('wesley', 'wesleyapikey'); // TODO : change login and pwd if necessary

$result = $proxy->shoppingCartInfo($sessionId, '5');
var_dump($result);
echo $proxy->__getLastRequest();
