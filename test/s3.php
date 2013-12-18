<?php
$api_url_v2 = "http://emilk.kenmec.com/magento18/index.php/api/v2_soap/?wsdl=1";
$username = 'wesley';
$password = 'wesleyapikey';
$cli = new SoapClient($api_url_v2,array("trace"=>1));
//retreive session id from login
$session_id = $cli->login($username, $password);
$complexFilter = array(
    'complex_filter' => array(
        array(
            'key' => 'type',
            'value' => array('key' => 'in', 'value' => 'simple,configurable')
        )
    )
);
$filter = array('filter' => array(
    array('key' => 'sku', 'value' => 'aaaa'),
    array('key' => 'name', 'value' => 'aaaa')
));
$ff  = array('filter' => array(
    array('key' => 'category_id', 'value' => '22')
));


//call customer.list method
$result = $cli->catalogProductList($session_id,$ff);
echo 'request'.$cli->__getLastRequest();
var_dump($result);
