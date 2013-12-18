<?php
 
class Kentec_Boxconfig_Model_Mysql4_Boxconfig_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('boxconfig/boxconfig');
    }
}