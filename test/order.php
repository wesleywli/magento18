<?php
/**
 * Example of order creation
 * Preconditionsare as follows:
 * 1. Create a customer
 * 2. Сreate a simple product */

$user = 'wesley';
$password = 'wesleyapikey';
    $proxy = new SoapClient('http://emilk.kenmec.com/magento18/index.php/api/v2_soap/?wsdl');
    $sessionId = $proxy->login($user, $password);
    $cartId = $proxy->shoppingCartCreate($sessionId, 1);
    // load the customer list and select the first customer from the list
    $customerList = $proxy->customerCustomerList($sessionId, array());
    $customer = (array) $customerList[2];
    $customer['mode'] = 'customer';
    var_dump($customer);
    $proxy->shoppingCartCustomerSet($sessionId, $cartId, $customer);
    // load the product list and select the first product from the list
    $productList = $proxy->catalogProductList($sessionId);
    $product = (array) $productList[0];
    $product['qty'] = 1;
    $proxy->shoppingCartProductAdd($sessionId, $cartId, array($product));

    $address = array(
        array(
            'mode' => 'shipping',
            'firstname' => $customer['firstname'],
            'lastname' => $customer['lastname'],
            'street' => 'street address',
            'city' => 'city',
            'region' => 'region',
            'telephone' => 'phone number',
            'postcode' => 'postcode',
            'country_id' => 'country ID',
            'is_default_shipping' => 0,
            'is_default_billing' => 0
        ),
        array(
            'mode' => 'billing',
            'firstname' => $customer['firstname'],
            'lastname' => $customer['lastname'],
            'street' => 'street address',
            'city' => 'city',
            'region' => 'region',
            'telephone' => 'phone number',
            'postcode' => 'postcode',
            'country_id' => 'country ID',
            'is_default_shipping' => 0,
            'is_default_billing' => 0
        ),
    );
     // add customer address
    $proxy->shoppingCartCustomerAddresses($sessionId, $cartId, $address);
    // add shipping method
    $proxy->shoppingCartShippingMethod($sessionId, $cartId, 'flatrate_flatrate');

    $paymentMethod =  array(
        'po_number' => null,
        'method' => 'checkmo',
        'cc_cid' => null,
        'cc_owner' => null,
        'cc_number' => null,
        'cc_type' => null,
        'cc_exp_year' => null,
        'cc_exp_month' => null
    );
     // add payment method
    $proxy->shoppingCartPaymentMethod($sessionId, $cartId, $paymentMethod);
     // place the order
    $orderId = $proxy->shoppingCartOrder($sessionId, $cartId, null, null);

	echo 'CartId: '.$cartId;
	echo 'OrderId: '.$orderId;
