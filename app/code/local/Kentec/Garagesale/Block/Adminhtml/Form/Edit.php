<?php
class Kentec_Garagesale_Block_Adminhtml_Form_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                  
        $this->_objectId = 'id';
        $this->_blockGroup = 'garagesale';
        $this->_controller = 'adminhtml_form';
         
        $this->_updateButton('save', 'label', Mage::helper('garagesale')->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('garagesale')->__('Delete'));
         
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);
    }
 
    public function getHeaderText()
    {
        // return Mage::helper('garagesale')->__('My Form Container');
        if( Mage::registry('garagesale_data') && Mage::registry('garagesale_data')->getId() ) {
            return Mage::helper('garagesale')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('garagesale_data')->getTitle()));
        } else {
            return Mage::helper('garagesale')->__('Add Item');
        }
    }
}