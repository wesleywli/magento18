<?php
    class Kentec_Garagesale_Model_Item_Api extends Mage_Api_Model_Resource_Abstract
    {
       
        public function create($garagesaleData)
        {
            try {
                $garagesale = Mage::getModel('garagesale/garagesaleitempost')
                    ->setData($garagesaleData)
                    ->save();
            } catch (Mage_Core_Exception $e) {
                $this->_fault('data_invalid', $e->getMessage());
                // We cannot know all the possible exceptions,
                // so let's try to catch the ones that extend Mage_Core_Exception
            } catch (Exception $e) {
                $this->_fault('data_invalid', $e->getMessage());
            }
            return $garagesale->getId();
        }
     
        public function info($garagesaleId)
        {
            $garagesale = Mage::getModel('garagesale/garagesaleitempost')->load($garagesaleId);
            if (!$garagesale->getId()) {
                $this->_fault('not_exists');
                // If customer not found.
            }
            return $garagesale->toArray();
            // We can use only simple PHP data types in webservices.
        }
     
        public function items($filters)
        {
            $collection = Mage::getModel('garagesale/garagesaleitempost')->getCollection()
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
     
        public function update($garagesaleId, $garagesaleData)
        {
        }
     
        public function delete($garagesaleId)
        {
        }
    }