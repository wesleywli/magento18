<?php
class Kentec_Boxconfig_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
            $this->loadLayout();
            $this->renderLayout();
    }

    public function showCollectionAction() {
    		echo 'boxconfig start...';
		    $saleitem = Mage::getModel('boxconfig/boxconfig');
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
		        echo '<h2>CustomerId: ' . $entry->getCustomerId() . '</h2>';
		        echo '<p>IMEI: ' . $entry->getImei() . '</p>';
		        echo '<p>MacAddr: ' . $entry->getMacAddr() . '</p>';		   
		    }
		    echo '</br>Done</br>';
	}
	
	public function saveAction() {
		if ( $this->getRequest()->getPost() ) {
            try {
                $postData = $this->getRequest()->getPost();
                $boxconfigModel = Mage::getModel('boxconfig/boxconfig');
               
                $boxconfigModel->setId($this->getRequest()->getParam('id'))                 
                    ->setCustomerId($postData['customerid'])
                    ->setImei($postData['imei'])
                    ->setMacAddr($postData['macaddr'])
                    ->setComment($postData['comment'])
                    ->setStatus($postData['status'])
                    ->save();

            } catch (Mage_Core_Exception $e) {
                    $this->_fault('add_product_to_wishlist_fault', $e->getMessage());
            } catch (Exception $e) {
                    $this->_fault('add_product_to_wishlist_fault', $e->getMessage());
            }
                
            
        } 

        $this->loadLayout();
        $this->renderLayout();
	}

	public function itemByIdAction() {
		$customerId='1';
		$entry = Mage::getModel('boxconfig/boxconfig')
    			->getCollection()
    			->addAttributeToSelect('*')
    			->addFieldToFilter('customer_id',array('eq'=>$customerId))
    			->getFirstItem();

    	var_dump($entry->getData());
    	echo '<h2>ID: ' . $entry->getEntityId() . '</h2>';
		echo '<h2>CustomerId: ' . $entry->getCustomerId() . '</h2>';
		echo '<p>IMEI: ' . $entry->getImei() . '</p>';
		echo '<p>MacAddr: ' . $entry->getMacAddr() . '</p>';

		$e = Mage::getModel('boxconfig/boxconfig')
    			->getCollection()
    			->addAttributeToSelect('*')
    			->addFieldToFilter('customer_id',array('eq'=>$customerId));

		echo 'count: '.count($e);

		$saleitem = Mage::getModel('boxconfig/boxconfig');
		    // $entries = $saleitem->getCollection()
		    //     ->addAttributeToSelect('title')
		    //     ->addAttributeToSelect('date')
		    //     ->addAttributeToSelect('content');

		    $entries = Mage::getModel('boxconfig/boxconfig')->getCollection()->addAttributeToSelect('*')->addAttributeToSort('date', 'DESC');
		    $entries->load();
		    
		    foreach($entries as $entry)
		    {
		    	if($entry->getCustomerId() == '1') {
		    		// var_dump($entry->getData());
			        echo '<h2>ID: ' . $entry->getId() . '</h2>';
			        echo '<h2>CustomerId: ' . $entry->getCustomerId() . '</h2>';
			        echo '<p>IMEI: ' . $entry->getImei() . '</p>';
			        echo '<p>MacAddr: ' . $entry->getMacAddr() . '</p>';	
		    	}
		        	   
		    }
	}
}