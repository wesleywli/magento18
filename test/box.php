<?php

	$soap = new SoapClient('http://emilk.kenmec.com/magento/index.php/api/soap/?wsdl',array("trace"=>1));
	$session_id = $soap->login( 'wesley', 'wesleyapikey' );

	//$result = $soap->call($session_id, 'boxconfig.info', array('param1' => 1));
	//$result = $soap->call($session_id, 'boxconfig.list');
	// $result = $soap->call($session_id, 'boxconfig.customerinfo', array('param1' => '12345abcde'));
	$result = $soap->call($session_id, 'boxconfig.customerinfo', '0007501305208D0B2');
	var_dump($result);
