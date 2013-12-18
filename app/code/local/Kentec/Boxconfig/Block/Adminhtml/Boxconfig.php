<?php
 
class Kentec_Boxconfig_Block_Adminhtml_Boxconfig extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_boxconfig';
        $this->_blockGroup = 'boxconfig';
        $this->_headerText = Mage::helper('boxconfig')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('boxconfig')->__('Add Item');
        parent::__construct();
    }
}