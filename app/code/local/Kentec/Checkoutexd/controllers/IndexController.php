<?php
class Kentec_Checkoutexd_IndexController extends Mage_Core_Controller_Front_Action {

	public function indexAction() {

		// $ccModel = Mage::getModel('checkoutexd/creditcard');
		// 	echo 'load model..... ok <br>';
		// 	$ccModel->setCustomerId('1')
		// 		->setName('thisname')
		// 		->setType('AE')
		// 		->setNumber('thisisnumfdsbera')
		// 		->setVerifyNumber('thisisverifynumbera')
		// 		->setComment('thisiscommenta')
		// 		->setStatus(0)
		// 		->save();
		// 	echo 'saved....<br>';
			$collection = Mage::getModel('checkoutexd/creditcard')->getCollection()->addAttributeToSelect('*')->addAttributeToSort('date', 'DESC');;
			foreach($collection as $item) {
				echo 'creditcard info: <br>';
				echo 'id: '.$item->getId().'<br>';
				echo 'customer id: '.$item->getCustomerId().'<br>';
				echo 'name: '.$item->getName().'<br>';
				echo 'type: '.$item->getType().'<br>';
			}

			
	}


}	 