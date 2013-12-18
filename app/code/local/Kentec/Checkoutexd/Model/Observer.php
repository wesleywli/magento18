<?php

class Kentec_Checkoutexd_Model_Observer {

    // public function __construct() {
    // }
    

    public function saveCheckoutexdTabData($observer)
    {
        $customer = Mage::registry('current_customer');
        if($_POST['customer_id']) {
            try {
                $boxconfigModel = Mage::getModel('checkoutexd/creditcard');

                foreach ($_POST['creditcard'] as $card) {
                    if($card['delete'] == '1') {
                        $boxconfigModel->load($card['item_id'])->delete();
                    } else {
                        $boxconfigModel->setId($card['item_id'])
                            ->setCustomerId($_POST['customer_id'])
                            ->setName($card['cc_name'])
                            ->setType($card['cc_type'])
                            ->setNumber($card['cc_number'])
                            ->setExpYear($card['cc_exp_year'])
                            ->setExpMonth($card['cc_exp_month'])
                            ->setVerifyNumber($card['cc_cid'])
                            // ->setComment('active')
                            // ->setStatus(1)
                            ->save();
                    }
                    
                }
               
                    
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }    
        }       
        
        
    }


    public function deleteCheckoutexdTabData($observer)
    {
        $customer = Mage::registry('current_customer');
        $model = Mage::getModel('checkoutexd/creditcard');

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