<?php
 
class Kentec_Boxconfig_Block_Adminhtml_Boxconfig_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
 
    public function __construct()
    {
        parent::__construct();
        $this->setId('form_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('boxconfig')->__('Box Information'));
    }
 
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('boxconfig')->__('Item Information'),
            'title'     => Mage::helper('boxconfig')->__('Item Information'),
            'content'   => $this->getLayout()->createBlock('boxconfig/adminhtml_boxconfig_edit_tab_form')->toHtml(),
        ));
       
        return parent::_beforeToHtml();
    }
}