<?php
	class Kentec_Boxconfig_Model_Resource_Boxconfig extends Mage_Eav_Model_Entity_Abstract
	{
	    protected function _construct()
	    {
	        $resource = Mage::getSingleton('core/resource');
	        $this->setType('boxconfig_boxconfig');
	        $this->setConnection(
	            $resource->getConnection('boxconfig_read'),
	            $resource->getConnection('boxconfig_write')
	        );
	    }
	}