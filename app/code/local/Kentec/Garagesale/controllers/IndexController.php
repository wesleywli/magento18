<?php
	class Kentec_Garagesale_IndexController extends Mage_Core_Controller_Front_Action {
	    public function addAction() {

	    	// save file first
	    	$file = array();
            $file['tmp_name'] = $_FILES['image']['tmp_name'];
            $file['name'] = $_FILES['image']['name'];
            $uploader = new Mage_Core_Model_File_Uploader($file);
            $uploader->setAllowedExtensions(array('jpg','png'));
            $uploader->setAllowRenameFiles(true);
            // $uploader->addValidateCallback('size', $this, 'validateMaxSize');
            $result = $uploader->save('/var/www/magento18/media/garagesale');
            var_export($result);
            echo 'file: '.$result['file'];

            // save field
	    	$title = $_POST['title'];
	    	$content = $_POST['content'];
	    	$image = $_FILES['image']['tmp_name'];
	    	$saleitem = Mage::getModel('garagesale/garagesaleitempost');
		    $saleitem->setTitle($title);
		    $saleitem->setContent($content);
		    $saleitem->setDate(now());
		    $saleitem->setImage($result['file']);
		    $saleitem->save();
	    	echo 'Title: '.$title.'<br>';
	    	echo 'Content: '.$content.'<br>';
	    	echo 'Image: '.$image.'<br>';
	    	echo 'GarageSale item save done. <br>';

	    	var_dump($_FILES['image']);


	    }

	    public function delAction() {
	    	$id = $this->getRequest()->getParam('id');
	    	$saleitem = Mage::getModel('garagesale/garagesaleitempost');
	    	$saleitem->load($id)->delete();
	    	echo 'ID: '.$id.' item delete done.';
	    }
	    public function IndexAction() {
	    	$saleitem = Mage::getModel('garagesale/garagesaleitempost');
		    $saleitem->load(1);
		    // var_dump($saleitem);

		    $this->loadLayout();

	        //create a text block with the name of "example-block"
	        $block = $this->getLayout()
	        ->createBlock('core/text', 'example-block')
	        ->setText($saleitem);

	        // $this->_addContent($block);

	        $this->renderLayout();
	    }

	    public function adminhtmlAction() {
	    	$this->loadLayout();
            $this->renderLayout();
	    }

	    public function populateEntriesAction() {
		    for ($i=0;$i<10;$i++) {
		        $saleitem = Mage::getModel('garagesale/garagesaleitempost');
		        $saleitem->setTitle('This is a test '.$i);
		        $saleitem->setContent('This is test content '.$i);
		        $saleitem->setDate(now());
		        $saleitem->save();
		    }

		    echo 'Done';
		}

		public function showCollectionAction() {
		    $saleitem = Mage::getModel('garagesale/garagesaleitempost');
		    // $entries = $saleitem->getCollection()
		    //     ->addAttributeToSelect('title')
		    //     ->addAttributeToSelect('date')
		    //     ->addAttributeToSelect('content');

		    $entries = $saleitem->getCollection()->addAttributeToSelect('*')->addAttributeToSort('date', 'DESC');
		    $entries->load();
		    
		    foreach($entries as $entry)
		    {
		        // var_dump($entry->getData());
		        echo '<h2>ID: ' . $entry->getId() . '</h2>';
		        echo '<h2>Title: ' . $entry->getTitle() . '</h2>';
		        echo '<p>Date: ' . $entry->getDate() . '</p>';
		        echo '<p>Content: ' . $entry->getContent() . '</p>';
		        echo '<p>Image: ' . $entry->getImage() . '</p>';
		        echo '<img src=http://localhost/magento17/media/garagesale/'.$entry->getImage().' height=50% width=50% />';
		    }
		    echo '</br>Done</br>';
		}

		public function testAction()
		{
		    $collection_of_products = Mage::getModel('garagesale/garagesaleitempost')->getCollection()
		    ->addAttributeToSelect('title')
		        ->addAttributeToSelect('date')
		        ->addAttributeToSelect('content');
		   
		    //var_dump($collection_of_products->getSelect()); //might cause a segmentation fault
		    var_dump(
		        (string) $collection_of_products->getSelect()
		    );
		}

		public function cartAction()
		{
			echo 'cart test start';
			// retrieve quote items array
			$items = Mage::getSingleton('checkout/cart')->getQuote('1',NULL)->getAllItems();
 
			foreach($items as $item) {
    				echo 'ID: '.$item->getProductId().'<br />';
    				echo 'Name: '.$item->getName().'<br />';
    				echo 'Sku: '.$item->getSku().'<br />';
    				echo 'Quantity: '.$item->getQty().'<br />';
    				echo 'Price: '.$item->getPrice().'<br />';
    				echo "<br />";           
			}
		
			$customer = Mage::getModel('customer/customer')->load('4');	
			// var_dump($customer);
			$website = Mage::app()->getWebsite('1');

            		// count cart items
            		$cartItemsCount = Mage::getModel('sales/quote')
                		->setWebsite($website)->loadByCustomer($customer)
                		->getItemsCollection(true)
                		->addFieldToFilter('parent_item_id', array('null' => true))
                		->getSize();
			echo 'cartItemCount: ';
			var_dump($cartItemsCount);

			$collection_of_carts = Mage::getModel('sales/quote')->getCollection();
    			//var_dump($collection_of_carts->getFirstItem()->getData());
			
			foreach($collection_of_carts as $entry)
		    	{
		        	// var_dump($entry->getData());
		        	echo '<h2>ID: ' . $entry->getId() . '</h2>';
		        	echo '<h2>EntityID: ' . $entry->getEntityId() . '</h2>';
		        	echo '<h2>CustomerId: ' . $entry->getCustomerId() . '</h2>';
		        	echo '<p>Date: ' . $entry->getDate() . '</p>';
		        	echo '<p>Content: ' . $entry->getContent() . '</p>';
		        	echo '<p>Image: ' . $entry->getImage() . '</p>';
		        	echo '<p>ItemsCount: '.$entry->getItemsCount().'</p>';
		    	}

		    $data = Mage::getModel('sales/quote')
    				->getCollection()
    				->addFieldToFilter('customer_id','4')
    				->getFirstItem()
    				->getId();
    		echo 'id: '.$data;

		    // var_dump(		 
    		// 		Mage::getModel('sales/quote')
    		// 		->getCollection()
    		// 		->addFieldToFilter('customer_id','4')
    		// 		->getData());

		}

		public function wishAction() {
			// $customer = Mage::getModel('customer/customer')->load('4');
			// // $customer = Mage::getSingleton('customer/session')->getCustomer();	
			// $wishList = Mage::getSingleton('wishlist/wishlist')->loadByCustomer($customer);
			// $wishListItemCollection = $wishList->getItemCollection();

			// if (count($wishListItemCollection)) {
			//     $arrProductIds = array();

			//     foreach ($wishListItemCollection as $item) {
			//         /* @var $product Mage_Catalog_Model_Product */
			//         $product = $item->getProduct();
			//         $arrProductIds[] = $product->getId();
			//     }
			// }

			// echo 'wishlist ids: ';
			// var_dump($arrProductIds[]);

			$wishlistId = Mage::getModel('wishlist/wishlist')
    				->getCollection()
    				->addFieldToFilter('customer_id','4')
    				->getFirstItem()
    				->getId();
    		echo 'wish id: '.$wishlistId;

    		$items = Mage::getModel('wishlist/item')
    				->getCollection()
    				->addFieldToFilter('wishlist_id',$wishlistId);

    		foreach($items as $item) {
    			echo "<br />";
    			echo 'item ID: '.$item->getId().'<br />';
    			echo 'product ID: '.$item->getProductId().'<br />';
    			echo "<br />";           
			}

			// load or create wishlist by customer
			$customerId = '6';
    		$wishlist = Mage::getModel('wishlist/wishlist')->loadByCustomer($customerId, true);	
    		echo 'customer id: 6 wishlist id:'.$wishlist->getId();	
    		
		}

		public function addwishAction() {
			// product name: Akio Dresser id: 41, try to add this
			$wishlistId = '2';
			$productId = '41';
			$storeId = '1';
			$qty = 1;
			$product = Mage::getModel('catalog/product')->load($productId);

			$itemId = Mage::getModel('wishlist/item')
    				->getCollection()
    				->addFieldToFilter('wishlist_id','2')
    				->addFieldToFilter('product_id',$productId)
    				->getFirstItem()
    				->getId();

    		if(!$itemId) {
    			$item = Mage::getModel('wishlist/item');
	            $item->setProductId($product->getId())
	                ->setWishlistId($wishlistId)
	                ->setAddedAt(now())
	                ->setStoreId($storeId)
	                ->setOptions($product->getCustomOptions())
	                ->setProduct($product)
	                ->setQty($qty)
	                ->save();

	            echo 'add product to wishlist ... and item id:'.$item->getId();
    		} else {
    			echo 'product already in wishlist ... and item id:'.$itemId;
    		}


		}


		public function removewishAction() {

			$wishlistId = '2';
			$wishlist = Mage::getModel('wishlist/wishlist')->load($wishlistId);
			if (!$wishlist) {
	            return ;
	        }

			$itemId = '6';
			$item = Mage::getModel('wishlist/item')->load($itemId);
	        if (!$item->getId()) {
	            return ;
	        }
	        
	        
	        try {
	            $item->delete();
	            $wishlist->save();
	            echo 'remove successed...';
	        } catch (Mage_Core_Exception $e) {
	            ;
	        } catch (Exception $e) {
	            ;
	        }

		}

		public function boxconfigAction() {
			$test = Mage::getModel('boxconfig/boxconfig')->load('1');
                $test->setImei('thisisnewimei')
                     ->save();
		}

		public function ccAction() {

			$ccModel = Mage::getModel('checkoutexd/creditcard');
			echo 'load model..... ok <br>';
			$ccModel->setCustomerId('1')
				->setName('thisisname')
				->setType('thisistype')
				->setNumber('thisisnumber')
				->setVerifyNumber('thisisverifynumber')
				->setComment('thisiscomment')
				->save();
			echo 'saved....';
			$collection = $ccModel->getCollection();
			foreach($collection as $item) {
				echo 'cc info: <br>';
				echo 'id: '.$item->getId().'<br>';
				echo 'customer id: '.$item->getCustomerId().'<br>';
				echo 'name: '.$item->getName().'<br>';
				echo 'type: '.$item->getType().'<br>';
				echo 'number: '.$item->getNumber().'<br>';
			}


		}

	}
