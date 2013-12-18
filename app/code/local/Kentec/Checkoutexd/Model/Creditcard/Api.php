<?php
class Kentec_Checkoutexd_Model_Creditcard_Api extends Mage_Api_Model_Resource_Abstract {

	public function getInfoByCustomerId($customerId) {

    	$info = Mage::getModel('checkoutexd/creditcard')
    			->getCollection()
    			->addAttributeToSelect('*')
    			->addFieldToFilter('customer_id',$customerId)
    			->getFirstItem();

    	return $info->toArray();
    }

    public function getCardsByCustomerId($customerId) {

        $cards = Mage::getModel('checkoutexd/creditcard')
                ->getCollection()
                ->addAttributeToSelect('*')
                ->addFieldToFilter('customer_id',$customerId)
                ->load();

        return $cards->toArray();
    }

    public function create($cardData) {
    	try {
            $card = Mage::getModel('checkoutexd/creditcard')
                ->setData($cardData)
                ->save();
        } catch (Mage_Core_Exception $e) {
            $this->_fault('data_invalid', $e->getMessage());
            // We cannot know all the possible exceptions,
            // so let's try to catch the ones that extend Mage_Core_Exception
        } catch (Exception $e) {
            $this->_fault('data_invalid', $e->getMessage());
        }
        return $card->getId();
    }

    public function update($cardId, $cardData) {
    	$card = Mage::getModel('checkoutexd/creditcard')->load($cardId);

        if (!$card->getId()) {
            $this->_fault('not_exists');
            // No customer found
        }

        $card->addData($cardData)->save();
        return true;

    }


    public function delete($cardId) {
        $card = Mage::getModel('checkoutexd/creditcard')->load($cardId);

        if (!$card->getId()) {
            $this->_fault('not_exists');
            // No customer found
        }

        try {
            $card->delete();
        } catch (Mage_Core_Exception $e) {
            $this->_fault('not_deleted', $e->getMessage());
            // Some errors while deleting.
        }

        return true;
    }


}