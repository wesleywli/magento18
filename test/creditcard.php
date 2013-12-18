<?php

	$soap = new SoapClient('http://10.9.100.1/magento18/index.php/api/soap/?wsdl',array("trace"=>1));
	$session_id = $soap->login( 'wesley', 'wesleyapikey' );

	// get one creditcard information by customer Id
	// function getInfoByCustomerId($customerId)
	// return creditcard information
	// $result = $soap->call($session_id, 'checkoutexd_creditcard.getInfoByCustomerId','1');
	
	// get many creditcards information by customer Id
	// function getInfoByCustomerId($customerId)
	// return creditcard information
	$result = $soap->call($session_id, 'checkoutexd_creditcard.getCardsByCustomerId','1');

	// create creditcard
	// $creditcard = array(
	// 	'customer_id' => '1',
	// 	'name' => 'john li',
	// 	'type' => 'AE',
	// 	'number' => '987654321',
	// 	'exp_month' => '4',
	// 	'exp_year' => '2016',
	// 	'verify_number' => '321',
	// 	'comment' => 'update comment'
	// 	);
	// $result = $soap->call($session_id, 'checkoutexd_creditcard.create', array($creditcard));
	
	// update creditcard
	// $creditcard = array(
	// 	'customer_id' => '1',
	// 	'name' => 'john lu',
	// 	'type' => 'AE',
	// 	'number' => '987654321',
	// 	'exp_month' => '6',
	// 	'exp_year' => '2013',
	// 	'verify_number' => '123',
	// 	'comment' => 'update comment2'
	// 	);
	// $result = $soap->call($session_id, 'checkoutexd_creditcard.update', array('2', $creditcard));
	
	// delete creditcard
	// $result = $soap->call($session_id, 'checkoutexd_creditcard.delete', '8');
	
	var_dump($result);
