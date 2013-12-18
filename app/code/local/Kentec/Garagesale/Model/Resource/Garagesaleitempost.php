<?php
	class Kentec_Garagesale_Model_Resource_Garagesaleitempost extends Mage_Eav_Model_Entity_Abstract
	{
	    protected function _construct()
	    {
	        $resource = Mage::getSingleton('core/resource');
	        $this->setType('garagesale_garagesaleitempost');
	        $this->setConnection(
	            $resource->getConnection('garagesale_read'),
	            $resource->getConnection('garagesale_write')
	        );
	    }
	}