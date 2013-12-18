<?php

	$soap = new SoapClient('http://emilk.kenmec.com/magento18/index.php/api/v2_soap/?wsdl');
	$session_id = $soap->login( 'wesley', 'wesleyapikey' );

	$result = $soap->garagesaleList($session_id);
	// $result = $soap->resourceNameMethodName($session_id,'zzzz');
	var_dump($result);
