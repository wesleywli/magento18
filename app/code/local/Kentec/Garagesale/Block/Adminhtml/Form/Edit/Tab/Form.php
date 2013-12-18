<?php
class Kentec_Garagesale_Block_Adminhtml_Form_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('garagesale_form', array('legend'=>Mage::helper('garagesale')->__('Item information')));
          
        $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('garagesale')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
        ));

        $fieldset->addField('content', 'editor', array(
            'name'      => 'content',
            'label'     => Mage::helper('garagesale')->__('Content'),
            'title'     => Mage::helper('garagesale')->__('Content'),
            'style'     => 'width:98%; height:200px;',
            'wysiwyg'   => false,
            'required'  => true,
        ));

        $fieldset->addField('image', 'file', array(
          'label'     => Mage::helper('garagesale')->__('Upload'),
          'value'  => 'Image',
          'disabled' => false,
          'readonly' => true,
          'after_element_html' => '<small>Image file</small>',
          'tabindex' => 1
        ));

          
        return parent::_prepareForm();
    }
}