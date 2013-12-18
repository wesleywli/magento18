<?php
 
class Kentec_Boxconfig_Block_Adminhtml_Boxconfig_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
               
        $this->_objectId = 'id';
        $this->_blockGroup = 'boxconfig';
        $this->_controller = 'adminhtml_boxconfig';
 
        $this->_updateButton('save', 'label', Mage::helper('boxconfig')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('boxconfig')->__('Delete Item'));
    }
 
    public function getHeaderText()
    {
        if( Mage::registry('boxconfig_data') && Mage::registry('boxconfig_data')->getId() ) {
            return Mage::helper('boxconfig')->__("Edit CustomerId: '%s'", $this->htmlEscape(Mage::registry('boxconfig_data')->getCustomerId()));
        } else {
            return Mage::helper('boxconfig')->__('Add Item');
        }
    }
}