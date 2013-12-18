<?php
    class Kentec_Boxconfig_Model_Item_Api extends Mage_Api_Model_Resource_Abstract
    {
       
        public function create($data)
        {
            try {
                $boxconfig = Mage::getModel('boxconfig/boxconfig')
                    ->setData($data)
                    ->save();
            } catch (Mage_Core_Exception $e) {
                $this->_fault('data_invalid', $e->getMessage());
                // We cannot know all the possible exceptions,
                // so let's try to catch the ones that extend Mage_Core_Exception
            } catch (Exception $e) {
                $this->_fault('data_invalid', $e->getMessage());
            }
            return $boxconfig->getId();
        }
     
        public function info($id)
        {
            $boxconfig = Mage::getModel('boxconfig/boxconfig')->load($id);
            if (!$boxconfig->getId()) {
                $this->_fault('not_exists');
                // If boxconfig not found.
            }
            return $boxconfig->toArray();
            // We can use only simple PHP data types in webservices.
        }
     
        public function items($filters)
        {
            $collection = Mage::getModel('boxconfig/boxconfig')->getCollection()
            ->addAttributeToSelect('*');

            if (is_array($filters)) {
                try {
                    foreach ($filters as $field => $value) {
                        $collection->addFieldToFilter($field, $value);
                    }
                } catch (Mage_Core_Exception $e) {
                    $this->_fault('filters_invalid', $e->getMessage());
                    // If we are adding filter on non-existent attribute
                }
            }

            $result = array();
            foreach ($collection as $item) {
                $result[] = $item->toArray();
            }

            return $result;
        }
     
        public function update($id, $data)
        {
        }
     
        public function delete($id)
        {
        }

        public function customerInfoByImei($imei) {
            $collection = Mage::getModel('boxconfig/boxconfig')->getCollection()
                            ->addAttributeToSelect('*')
                            ->addFieldToFilter('imei',$imei);
            if (count($collection) == 0) {
                $this->_fault('not_exists');
                // If boxconfig not found.
            }

            $customerid = $collection->getFirstItem()->getCustomerId();
            $customer = Mage::getModel('customer/customer')->load($customerid);

            return $customer->toArray();

        }
    }