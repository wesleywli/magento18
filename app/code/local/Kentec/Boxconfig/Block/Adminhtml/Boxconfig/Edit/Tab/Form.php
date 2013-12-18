<?php
 
class Kentec_Boxconfig_Block_Adminhtml_Boxconfig_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('boxconfig_form', array('legend'=>Mage::helper('boxconfig')->__('Item information')));
       
        $fieldset->addField('customer_id', 'text', array(
            'label'     => Mage::helper('boxconfig')->__('Customer Id'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'customer_id',
        ));

        $fieldset->addField('imei', 'text', array(
            'label'     => Mage::helper('boxconfig')->__('IMEI'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'imei',
        ));

        $fieldset->addField('mac_addr', 'text', array(
            'label'     => Mage::helper('boxconfig')->__('MAC Addr'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'mac_addr',
        ));
 
        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('boxconfig')->__('Status'),
            'name'      => 'status',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('boxconfig')->__('Active'),
                ),
 
                array(
                    'value'     => 0,
                    'label'     => Mage::helper('boxconfig')->__('Inactive'),
                ),
            ),
        ));
       
        $fieldset->addField('comment', 'editor', array(
            'name'      => 'comment',
            'label'     => Mage::helper('boxconfig')->__('Comment'),
            'title'     => Mage::helper('boxconfig')->__('Comment'),
            'style'     => 'width:98%; height:200px;',
            'wysiwyg'   => false,
        ));
       
        if ( Mage::getSingleton('adminhtml/session')->getBoxconfigData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getBoxconfigData());
            Mage::getSingleton('adminhtml/session')->setBoxconfigData(null);
        } elseif ( Mage::registry('boxconfig_data') ) {
            $form->setValues(Mage::registry('boxconfig_data')->getData());
        }
        return parent::_prepareForm();
    }
}