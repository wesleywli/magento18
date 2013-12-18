<?php
    class Kentec_Checkoutexd_Model_Cart_Api extends Mage_Api_Model_Resource_Abstract
    {
    	public function getCartQuoteIdByCustomerId($customerId) {

    		$quoteId = Mage::getModel('sales/quote')
    				->getCollection()
    				->addFieldToFilter('customer_id',$customerId)
    				->getFirstItem()
    				->getId();

    		return $quoteId;
    	}

        public function getWishlistIdByCustomerId($customerId) {

            $wishlist = Mage::getModel('wishlist/wishlist')
                ->loadByCustomer($customerId, true);

            return $wishlist->getId();
        }

        public function addProductToWishlist($wishlistId, $productId) {

            // by default store
            $storeId = '1';
            $qty = 1;
            $product = Mage::getModel('catalog/product')->load($productId);

            $itemId = Mage::getModel('wishlist/item')
                    ->getCollection()
                    ->addFieldToFilter('wishlist_id', $wishlistId)
                    ->addFieldToFilter('product_id', $productId)
                    ->getFirstItem()
                    ->getId();

            if(!$itemId) {
                try {
                    $item = Mage::getModel('wishlist/item');
                    $item->setProductId($product->getId())
                        ->setWishlistId($wishlistId)
                        ->setAddedAt(now())
                        ->setStoreId($storeId)
                        ->setOptions($product->getCustomOptions())
                        ->setProduct($product)
                        ->setQty($qty)
                        ->save();

                } catch (Mage_Core_Exception $e) {
                    $this->_fault('add_product_to_wishlist_fault', $e->getMessage());
                } catch (Exception $e) {
                    $this->_fault('add_product_to_wishlist_fault', $e->getMessage());
                }
                
                return $item->getId();
            } else {
                return $itemId;
            }
        }

        public function removeProductFromWishlistById($wishlistId, $itemId) {

            $wishlist = Mage::getModel('wishlist/wishlist')->load($wishlistId);
            if (!$wishlist) {
                return false;
            }

            $item = Mage::getModel('wishlist/item')->load($itemId);
            if (!$item->getId()) {
                return false;
            }
            
            try {
                $item->delete();
                $wishlist->save();
                return true;
            } catch (Mage_Core_Exception $e) {
                $this->_fault('remove_product_from_wishlist_fault', $e->getMessage());
            } catch (Exception $e) {
                $this->_fault('remove_product_from_wishlist_fault', $e->getMessage());
            }
        }

        public function getWishlistItemByWishlistId($wishlistId) {
            
            $collection = Mage::getModel('wishlist/item')
                    ->getCollection()
                    ->addFieldToFilter('wishlist_id',$wishlistId);

            $result = array();
            foreach ($collection as $item) {
                $result[] = $item->toArray();
            }

            return $result;
        }

    }

    