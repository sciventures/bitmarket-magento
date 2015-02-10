<?php

class Bitmarket_Payment_Model_Method_Bitcoin extends Mage_Payment_Model_Method_Abstract
{

    protected $_code = 'bitmarket';
    protected $_isGateway = true;
    protected $_canAuthorize = true;
    protected $_canUseInternal = false;
    protected $_canManagerRecurringProfiles = false;


    public function authorize(Varien_Object $payment, $amount)
    {
        $api = Mage::helper('bitmarket/api');
        $invoice = $api->createInvoice($payment, $amount);
        $paylink = $api->getPaylink($invoice->id);
        $payment->setIsTransactionPending(true);
        Mage::getSingleton('customer/session')->setRedirectUrl($paylink);

        return $this;
    }

    public function getOrderPlaceRedirectUrl()
    {
        return Mage::getSingleton('customer/session')->getRedirectUrl();
    }

}
