<?php
	class Kentec_Checkoutexd_Model_Resource_Creditcard extends Mage_Eav_Model_Entity_Abstract
	{
	    protected function _construct()
	    {
	        $resource = Mage::getSingleton('core/resource');
	        $this->setType('checkoutexd_creditcard');
	        $this->setConnection(
	            $resource->getConnection('checkoutexd_read'),
	            $resource->getConnection('checkoutexd_write')
	        );
	    }
	}