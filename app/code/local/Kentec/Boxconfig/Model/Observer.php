<?php
  
class Kentec_Boxconfig_Model_Observer {
    
    public function saveBoxconfigTabData($observer)
    {
        $customer = Mage::registry('current_customer');
        if($_POST['customer_id']) {
            try {
                $boxconfigModel = Mage::getModel('boxconfig/boxconfig');
                $boxconfigModel->setId($_POST['item_id'])
                            ->setCustomerId($_POST['customer_id'])
                            ->setImei($_POST['imei'])
                            ->setMacAddr($_POST['mac_addr'])
                            ->setComment($_POST['comment'])
                            ->setStatus($_POST['status'])
                            ->save();
                    
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }    
        }       
        
        
    }


    public function deleteBoxconfigTabData($observer)
    {
        $customer = Mage::registry('current_customer');
        $model = Mage::getModel('boxconfig/boxconfig');

        try {
            
            if($customer) {
                $item = $model->getCollection()
                ->addAttributeToSelect('*')
                ->addFieldToFilter('customer_id', $customer->getId())
                ->getFirstItem()
                ->delete();  
            } else {
                $ids = $_POST['customer'];
                if(  $ids != NULL ) {
                    foreach($ids as $id) {
                        $item = $model->getCollection()
                            ->addAttributeToSelect('*')
                            ->addFieldToFilter('customer_id', $id)
                            ->getFirstItem()
                            ->delete();    
                    }
                }
            }
            
                    
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }   
        
        
    }
      
    
}