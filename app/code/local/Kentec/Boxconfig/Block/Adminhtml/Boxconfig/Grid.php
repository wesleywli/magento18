<?php
 
class Kentec_Boxconfig_Block_Adminhtml_Boxconfig_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('boxconfigGrid');
        // This is the primary key of the database
        $this->setDefaultSort('boxconfig_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
 
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('boxconfig/boxconfig')->getCollection()->addAttributeToSelect('*');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
 
    protected function _prepareColumns()
    {
        $this->addColumn('boxconfig_id', array(
            'header'    => Mage::helper('boxconfig')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'entity_id',
        ));
 
        $this->addColumn('customer_id', array(
            'header'    => Mage::helper('boxconfig')->__('Customer Id'),
            'align'     =>'right',
            'index'     => 'customer_id',
        ));

        $this->addColumn('imei', array(
            'header'    => Mage::helper('boxconfig')->__('IMEI'),
            'align'     =>'left',
            'index'     => 'imei',
        ));

        $this->addColumn('mac_addr', array(
            'header'    => Mage::helper('boxconfig')->__('MAC Addr'),
            'align'     =>'left',
            'index'     => 'mac_addr',
        ));     
 
        /*
        $this->addColumn('content', array(
            'header'    => Mage::helper('<module>')->__('Item Content'),
            'width'     => '150px',
            'index'     => 'content',
        ));
        */
 
        $this->addColumn('created_at', array(
            'header'    => Mage::helper('boxconfig')->__('Creation Time'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'datetime',
            'default'   => '--',
            'index'     => 'created_at',
        ));
 
        $this->addColumn('updated_at', array(
            'header'    => Mage::helper('boxconfig')->__('Update Time'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'datetime',
            'default'   => '--',
            'index'     => 'updated_at',
        ));   
 
 
        $this->addColumn('status', array(
 
            'header'    => Mage::helper('boxconfig')->__('Status'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'status',
            'type'      => 'options',
            'options'   => array(
                1 => 'Active',
                0 => 'Inactive',
            ),
        ));
 
        return parent::_prepareColumns();
    }
 
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
 
    public function getGridUrl()
    {
      return $this->getUrl('*/*/grid', array('_current'=>true));
    }
 
 
}