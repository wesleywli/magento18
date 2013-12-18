<?php
/**
 * Example of order creation
 * Preconditionsare as follows:
 * 1. Create a customer
 * 2. Сreate a simple product */

$user = 'wesley';
$password = 'wesleyapikey';
    $proxy = new SoapClient('http://emilk.kenmec.com/magento17/index.php/api/v2_soap/?wsdl');
    $sessionId = $proxy->login($user, $password);
    $cartId = $proxy->shoppingCartCreate($sessionId, 1);
    // load the customer list and select the first customer from the list
    $customerList = $proxy->customerCustomerList($sessionId, array());
    $customer = (array) $customerList[0];
    $customer['mode'] = 'customer';
    $proxy->shoppingCartCustomerSet($sessionId, $cartId, $customer);
    // load the product list and select the first product from the list
    $productList = $proxy->catalogProductList($sessionId);
    $product = (array) $productList[0];
    $product['qty'] = 1;
    $proxy->shoppingCartProductAdd($sessionId, $cartId, array($product));
    echo 'cartId: '.$cartId;
