<?php
class Kentec_Garagesale_Block_Adminhtml_Form_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
 
  public function __construct()
  {
      parent::__construct();
      $this->setId('form_tabs');
      $this->setDestElementId('edit_form'); // this should be same as the form id define above
      $this->setTitle(Mage::helper('garagesale')->__('Garagesale Information'));
  }
 
  protected function _beforeToHtml()
  {
      $this->addTab('info', array(
          'label'     => Mage::helper('garagesale')->__('Item Information'),
          'title'     => Mage::helper('garagesale')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('garagesale/adminhtml_form_edit_tab_form')->toHtml(),
      ));


      
      return parent::_beforeToHtml();
  }
}