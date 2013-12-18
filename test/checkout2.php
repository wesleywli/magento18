<?php

	$soap = new SoapClient('http://emilk.kenmec.com/magento18/index.php/api/v2_soap/?wsdl');
	$session_id = $soap->login( 'wesley', 'wesleyapikey' );

	$result = $soap->checkoutexdGetCartQuoteIdByCustomerId($session_id, '4');
	var_dump($result);
