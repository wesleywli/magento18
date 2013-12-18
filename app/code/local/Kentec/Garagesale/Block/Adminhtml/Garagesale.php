<?php
	class Kentec_Garagesale_Block_Adminhtml_Garagesale extends Mage_Adminhtml_Block_Widget_Grid_Container
	{
	  public function __construct()
	  {
	    $this->_controller = 'adminhtml_garagesale';
	    $this->_blockGroup = 'garagesale';
	    $this->_headerText = Mage::helper('garagesale')->__('Garagesale Manager');
	    $this->_addButtonLabel = Mage::helper('garagesale')->__('Add Garagesale');
	    parent::__construct();
	  }
	}