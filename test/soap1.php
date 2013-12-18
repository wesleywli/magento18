<?php

$proxy = new SoapClient('http://emilk.kenmec.com/magento17/index.php/api/v2_soap/?wsdl');
$sessionId = $proxy->login((object)array('username'=>"wesley",'apiKey'=>"wesleyapikey"));
// $products = $proxy->catalogProductList((object)array("sessionId" => $sessionId->result, "filters" => null));
// $products = $proxy->catalogProductAttributeSetList((object)array('sessionId' => $sessionId->result));

$products = $proxy->catalogProductCreate((object)array('sessionId' => $sessionId->result, 'type' => 'simple', 'set' => '9', 'sku' => 'simple_sku',
'productData' => ((object)array(
    'name' => 'Product name',
    'description' => 'Product description',
    'short_description' => 'Product short description',
    'weight' => '10',
    'status' => '1',
    'visibility' => '4',
    'price' => '100',
    'tax_class_id' => 1,
))));


var_dump($products->result);
