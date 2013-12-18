<?php
	class Kentec_Garagesale_GaragesaleController extends Mage_Adminhtml_Controller_action
{
 
    public function indexAction() {
     //    $this->loadLayout();
     //    $block = $this->getLayout()
	    //     ->createBlock('core/text', 'example-block')
	    //     ->setText('$saleitem');

	    // $this->_addContent($block);
     //    $this->renderLayout();

    	$this->_title($this->__('Garagesale'))->_title($this->__('Kentec Garagesale'));
        $this->loadLayout();
        $this->_setActiveMenu('garagesale/garagesale');
        $this->_addContent($this->getLayout()->createBlock('garagesale/adminhtml_garagesale'));
        $this->renderLayout();
    }

    public function deleteAction() {

        $ids = $this->getRequest()->getParam('entity_id');
        if(  $ids != NULL ) {
            try {
                $model = Mage::getModel('garagesale/garagesaleitempost');
                
                foreach($ids as $id)
                    $model->setId($id)->delete();
                      
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function newAction() {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('garagesale/adminhtml_form_edit'))
             ->_addLeft($this->getLayout()->createBlock('garagesale/adminhtml_form_edit_tabs'));
        $this->renderLayout();
    }

    public function editAction()
    {
        $garagesaleId     = $this->getRequest()->getParam('entity_id');
        $garagesaleModel  = Mage::getModel('garagesale/garagesaleitempost')->load($garagesaleId);
 
        if ($garagesaleModel->getId() || $garagesaleId == 0) {
 
            Mage::register('garagesale_data', $garagesaleModel);
 
            $this->loadLayout();
            $this->_setActiveMenu('garagesale/items');
           
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
           
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
           
            $this->_addContent($this->getLayout()->createBlock('garagesale/adminhtml_form_edit'))
             ->_addLeft($this->getLayout()->createBlock('garagesale/adminhtml_form_edit_tabs'));
            
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('garagesale')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function saveAction() {
        if ( $this->getRequest()->getPost() ) {
            try {
                $postData = $this->getRequest()->getPost();
                $garagesaleModel = Mage::getModel('garagesale/garagesaleitempost');
               
                $garagesaleModel->setId($this->getRequest()->getParam('id'))
                    ->setTitle($postData['title'])
                    ->setContent($postData['content'])
                    ->setDate(now())
                    ->setImage($postData['image'])
                    ->save();
               
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setGaragesaleData(false);
 
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setGaragesaleData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }
}