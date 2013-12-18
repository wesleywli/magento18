<?php
$client = new SoapClient('http://emilk.kenmec.com/magento17/index.php/api/v2_soap/?wsdl');

// If some stuff requires api authentification,
// then get a session token
$session = $client->login('wesley', 'wesleyapikey');
$filter = array('filter' => array(array('key' => 'status', 'value' => 'closed')));
$result = $client->salesOrderList($session);

var_dump ($result);
