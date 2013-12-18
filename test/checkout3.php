<?php

	$soap = new SoapClient('http://10.9.100.1/magento18/index.php/api/soap/?wsdl');
	$session_id = $soap->login( 'wesley', 'wesleyapikey' );
	$customerId = '7';
	
	// get Cart quoteId by customer Id
	// function getCartQuoteIdByCustomerId($customerId)
	// return Cart quoteId
	//$result = $soap->call($session_id, 'checkoutexd.getCartQuoteIdByCustomerId','4');


	// get Wishlist Id by customer Id
	// function getWishlistIdByCustomerId($customerId)
	// return Wishlist Id
	 $wishId = $soap->call($session_id, 'checkoutexd.getWishlistIdByCustomerId',$customerId);

	// get items from Wishlist by Wishlist Id
	// function getWishlistItemByWishlistId($wishlistId)
	// return items array
	// $result = $soap->call($session_id, 'checkoutexd.getWishlistItemByWishlistId','2');
	
	// add product to Wishlist
	// function addProductToWishlist($wishlistId, $productId)
	// return item id from table wishlist/item
	$result = $soap->call($session_id, 'checkoutexd.addProductToWishlist', array($wishId, '171') );
	
	// remove product from Wishlist
	// function removeProductFromWishlistById($wishlistId, $itemId)
	// return true or false
	// $result = $soap->call($session_id, 'checkoutexd.removeProductFromWishlistById', array('2', '7') );
	
	var_dump($result);
