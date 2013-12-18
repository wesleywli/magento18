<?php
	class Kentec_Checkoutexd_Model_Resource_Creditcard_Collection extends Mage_Eav_Model_Entity_Collection_Abstract
	{
	    protected function _construct()
	    {
	        $this->_init('checkoutexd/creditcard');
	    }
	}