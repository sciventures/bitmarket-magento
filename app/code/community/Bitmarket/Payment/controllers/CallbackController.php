<?php

class Bitmarket_Payment_CallbackController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
        try {

            $request = json_decode(file_get_contents('php://input'));
            if ($request) {
                $invoiceId = $request->invoice_id;
            } else {
                Mage::throwException('Invoice ID missing');
            }

            $orderId = $_GET['order_id'];
            $order = Mage::getModel('sales/order')->load($orderId);

            if ($order) {
                $api = Mage::helper('bitmarket/api');
                $invoice = $api->getInvoice($invoiceId);

                if ($invoice->status_id == '3') {
                    $order
                        ->getPayment()
                        ->setTransactionId($invoiceId)
                        ->registerCaptureNotification($invoice->amount);
                    $order->save();
                } else {
                    Mage::throwException('Invoice not paid');
                }
            } else {
                Mage::throwException("Order $orderId not found");
            }

        } catch (Exception $e) {
            Mage::logException($e);
            $this->getResponse()->setHeader('HTTP/1.0', '400', true);
        }

    }

}
