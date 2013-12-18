<?php

	$soap = new SoapClient('http://emilk.kenmec.com/magento18/index.php/api/soap/?wsdl');
	$session_id = $soap->login( 'wesley', 'wesleyapikey' );

	// $result = $soap->call($session_id, 'garagesale.info', array('param1' => 3));
	$result = $soap->call($session_id, 'garagesale.list');
	var_dump($result);
