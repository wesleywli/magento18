<?php
 
class Kentec_Boxconfig_Adminhtml_BoxconfigController extends Mage_Adminhtml_Controller_Action
{
 
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('boxconfig/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        return $this;
    }   
   
    public function indexAction() {
        $this->_initAction();       
        $this->_addContent($this->getLayout()->createBlock('boxconfig/adminhtml_boxconfig'));
        $this->renderLayout();
    }
 
    public function editAction()
    {
        $boxconfigId     = $this->getRequest()->getParam('id');
        $boxconfigModel  = Mage::getModel('boxconfig/boxconfig')->load($boxconfigId);
 
        if ($boxconfigModel->getId() || $boxconfigId == 0) {
 
            Mage::register('boxconfig_data', $boxconfigModel);
 
            $this->loadLayout();
            $this->_setActiveMenu('boxconfig/items');
           
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
           
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
           
            $this->_addContent($this->getLayout()->createBlock('boxconfig/adminhtml_boxconfig_edit'))
                 ->_addLeft($this->getLayout()->createBlock('boxconfig/adminhtml_boxconfig_edit_tabs'));
               
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('boxconfig')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }
   
    public function newAction()
    {
        $this->_forward('edit');
    }

    public function saveBoxconfigAction() {
        $item = Mage::getModel('boxconfig/boxconfig')
                ->getCollection()
                ->addAttributeToSelect('*')
                ->addFieldToFilter('customer_id', $this->getRequest()->getParam('id'))
                ->getFirstItem();

        $item->setCustomerId($customer_id)
                ->setImei($imei)
                ->setMacAddr($mac_addr)
                ->setComment($comment)
                ->setStatus($status)
                ->save();
        $this->_redirect('boxconfig/adminhtml_boxconfig/index');
        return ;
    }
   
    public function saveAction()
    {
        if ( $this->getRequest()->getPost() ) {
            try {
                $postData = $this->getRequest()->getPost();
                $boxconfigModel = Mage::getModel('boxconfig/boxconfig');
               
                $boxconfigModel->setId($this->getRequest()->getParam('id'))                 
                    ->setCustomerId($postData['customer_id'])
                    ->setImei($postData['imei'])
                    ->setMacAddr($postData['mac_addr'])
                    ->setComment($postData['comment'])
                    ->setStatus($postData['status'])
                    ->save();
                
               
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setBoxconfigData(false);
 
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setBoxconfigData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }
   
    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $boxconfigModel = Mage::getModel('boxconfig/boxconfig');
               
                $boxconfigModel->setId($this->getRequest()->getParam('id'))
                    ->delete();
                   
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
    /**
     * Product grid for AJAX request.
     * Sort and filter result for example.
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
               $this->getLayout()->createBlock('boxconfig/adminhtml_boxconfig_grid')->toHtml()
        );
    }
}