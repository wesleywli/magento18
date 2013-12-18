<?php
	class Kentec_Boxconfig_Model_Resource_Boxconfig_Collection extends Mage_Eav_Model_Entity_Collection_Abstract
	{
	    protected function _construct()
	    {
	        $this->_init('boxconfig/boxconfig');
	    }
	}