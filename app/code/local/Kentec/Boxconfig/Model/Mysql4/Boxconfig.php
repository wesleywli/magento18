<?php
 
class Kentec_Boxconfig_Model_Mysql4_Boxconfig extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {   
        $this->_init('boxconfig/boxconfig', 'boxconfig_id');
    }
}