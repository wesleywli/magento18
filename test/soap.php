<?php

try {
    error_reporting(E_ALL | E_STRICT);
    ini_set('display_errors', 1);
    $proxy = new SoapClient('http://emilk.kenmec.com/magento17/index.php/api/v2_soap?wsdl', array('trace' => 1, 'connection_timeout' => 120));

    $session = $proxy->login(array('username' => 'wesley', 'apiKey' => 'wesleyapikey'));
    $sessionId = $session->result;

    $filters = array(
       'sku' => array('like'=>'zol%')
    );

    $products = $proxy->catalogProductList(array("sessionId" => $sessionId, "filters" => $filters));

    echo '<h1>Result</h1>';
    echo '<pre>';
    var_dump($products);
    echo '</pre>';

} catch (Exception $e) {
    echo '<h1>Error</h1>';
    echo '<p>' . $e->getMessage() . '</p>';
}
