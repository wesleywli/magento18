<?php

	$soap = new SoapClient('http://emilk.kenmec.com/magento18/index.php/api/soap/?wsdl');
	$session_id = $soap->login( 'wesley', 'wesleyapikey' );

	$result = $soap->call($session_id, 'checkoutexd.getCartQuoteIdByCustomerId','4');
	var_dump($result);
