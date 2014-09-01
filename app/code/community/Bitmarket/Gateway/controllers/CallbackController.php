<?php

class Bitmarket_Gateway_CallbackController extends Mage_Core_Controller_Front_Action
{        

    public function indexAction() {
		$order = $_GET['orderid'];
		$confirmation = $_POST['confirmation'];
		$id = $_POST['id'];
		$amount = $_POST['amount'];

		if (/*check if coming from bitmarket server*/ true) {
	      	$order = Mage::getModel('sales/order')->load($order);
			if ($order == 0) return;
	        
			if ($confirmation > 0) {
		        $payment = $order->getPayment();
		        $payment->setTransactionId($id)
		          ->setPreparedMessage("Paid with Bitcoin via Bitmarket.ph Ref no: $id.")
		          ->setShouldCloseParentTransaction(true)
		          ->setIsTransactionClosed(0);
        
				$payment->registerCaptureNotification($amount);
		        $order->save();
			}
			echo "{success:true}";
		} else {
			echo "{success:false}";
		}
    }
}
