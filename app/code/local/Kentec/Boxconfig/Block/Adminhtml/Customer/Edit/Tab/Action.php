<?php 

/**
 * Adminhtml customer action tab
 *
 */
class Kentec_Boxconfig_Block_Adminhtml_Customer_Edit_Tab_Action
 extends Mage_Adminhtml_Block_Template
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    public function __construct()
    {
        $this->setTemplate('boxconfig/action.phtml');

    }

    public function getBoxconfigInfo(){

        $customer = Mage::registry('current_customer');
        $customtab='My Custom tab Action Contents Here';
		return $customtab;
		}

    /**
     * Return Tab label
     *
     * @return string
     */
    public function getTabLabel()
    {
        return $this->__('Boxconfig');
    }

    /**
     * Return Tab title
     *
     * @return string
     */
    public function getTabTitle()
    {
        return $this->__('Box Information');
    }

    /**
     * Can show tab in tabs
     *
     * @return boolean
     */
    public function canShowTab()
    {
        $customer = Mage::registry('current_customer');
        return (bool)$customer->getId();
    }

    /**
     * Tab is hidden
     *
     * @return boolean
     */
    public function isHidden()
    {
        return false;
    }

     /**
     * Defines after which tab, this tab should be rendered
     *
     * @return string
     */
    public function getAfter()
    {
        return 'tags';
    }

    public function getBoxconfig() {

        $item = '';
        
        $item = Mage::getModel('boxconfig/boxconfig')
                ->getCollection()
                ->addAttributeToSelect('*')
                ->addFieldToFilter('customer_id', Mage::registry('current_customer')->getId())
                ->getFirstItem();

        
        // $entries = Mage::getModel('boxconfig/boxconfig')->getCollection()->addAttributeToSelect('*')->addAttributeToSort('date', 'DESC');
        // $entries->load();
            
        // foreach($entries as $entry) {
        //     if($entry->getCustomerId() == Mage::registry('current_customer')->getId()) {
        //         $item = $entry;    
        //     }
        // }

        return $item;
    }

    public function getActionUrl() {
        return $this->getUrl('boxconfig/adminhtml_item/saveBoxconfig', array('id' => Mage::registry('current_customer')->getId() ));
    }

}