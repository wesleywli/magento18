<?php
 
class Kentec_Garagesale_Block_Adminhtml_Garagesale_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('garagesaleGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }
 
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('garagesale/garagesaleitempost')->getCollection()->addAttributeToSelect('*');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
 
    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
          'header'    => Mage::helper('garagesale')->__('ID'),
          'align'     =>'right',
          'width'     => '10px',
          'index'     => 'entity_id',
        ));

        $this->addColumn('date', array(
          'header'    => Mage::helper('garagesale')->__('Date'),
          'align'     =>'left',
          'index'     => 'date',
          'width'     => '50px',
        ));
 
        $this->addColumn('title', array(
          'header'    => Mage::helper('garagesale')->__('Title'),
          'align'     =>'left',
          'index'     => 'title',
          'width'     => '50px',
        ));
 
          
        $this->addColumn('content', array(
            'header'    => Mage::helper('garagesale')->__('Content'),
            'width'     => '150px',
            'index'     => 'content',
        ));

        $this->addColumn('image', array(
          'header'    => Mage::helper('garagesale')->__('Image'),
          'align'     =>'left',
          'index'     => 'image',
          'width'     => '50px',
          'renderer'  => 'garagesale/adminhtml_garagesale_renderer_image'
        ));

        // $this->addColumn('action',
        // array(
        //         'header'    => Mage::helper('garagesale')->__('Action'),
        //         'type'      => 'action',
        //         'getter'     => 'getId',
        //         'width'     => '50px',
        //         'actions'   => array(
        //                 array(
        //                 'caption' => Mage::helper('garagesale')->__('Edit'),
        //                 'url'     => $this->getUrl("*/*/edit"),
        //                 'field'   => 'id'
        //                 ),
        //                 array(
        //                 'caption' => Mage::helper('garagesale')->__('Delete'),
        //                 'url'     => $this->getUrl("*/*/delete"),
        //                 'field'   => 'entity_id'
        //                 )
        //                 ),
        //                     'filter'    => false,
        //                     'sortable'  => false
        //                 ));

        return parent::_prepareColumns();
    }

    // public function getRowUrl($row)
    // {
    //     return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    // }
 
    // public function getGridUrl()
    // {
    //   return $this->getUrl('*/*/grid', array('_current'=>true));
    // }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('garagesale');
 
        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('garagesale')->__('Delete'),
             'url'      => $this->getUrl('*/*/delete'),
             'field'    => 'entity_id',
             'confirm'  => Mage::helper('garagesale')->__('Are you sure?')
        ));

        $this->getMassactionBlock()->addItem('update', array(
            'label' => Mage::helper('garagesale')->__('Update'),
            'url' => $this->getUrl('*/*/edit'),
            'fields' => array(0 => 'title',
                1 => 'content',
                2 => 'date'
            )
        ));
 
        // $statuses = Mage::getSingleton('garagesale/status')->getOptionArray();
 
        // array_unshift($statuses, array('label'=>'', 'value'=>''));
        // $this->getMassactionBlock()->addItem('status', array(
        //      'label'=> Mage::helper('garagesale')->__('Change status'),
        //      'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
        //      'additional' => array(
        //             'visibility' => array(
        //                  'name' => 'status',
        //                  'type' => 'select',
        //                  'class' => 'required-entry',
        //                  'label' => Mage::helper('garagesale')->__('Status'),
        //                  'values' => $statuses
        // )
        // )
        // ));
        return $this;
    }
}