<?php 

/**
 * Adminhtml customer action tab
 *
 */
class Kentec_Checkoutexd_Block_Adminhtml_Customer_Edit_Tab_Action
 extends Mage_Adminhtml_Block_Template
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    public function __construct()
    {
        $this->setTemplate('checkoutexd/customertab.phtml');

    }

    public function getCheckoutexdInfo(){

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
        return $this->__('CreditCard');
    }

    /**
     * Return Tab title
     *
     * @return string
     */
    public function getTabTitle()
    {
        return $this->__('CreditCard Information');
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

    public function getCreditcard() {

        $item = '';
        
        $item = Mage::getModel('checkoutexd/creditcard')
                ->getCollection()
                ->addAttributeToSelect('*')
                ->addFieldToFilter('customer_id', Mage::registry('current_customer')->getId())
                ->getFirstItem();

        return $item;
    }

    public function getCreditcards() {

        $items = array();
        
        $items = Mage::getModel('checkoutexd/creditcard')
                ->getCollection()
                ->addAttributeToSelect('*')
                ->addFieldToFilter('customer_id', Mage::registry('current_customer')->getId());
        $items->load();
        return $items;
    }

}