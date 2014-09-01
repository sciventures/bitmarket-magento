<?php

class Bitmarket_Gateway_Model_PaymentMethod extends Mage_Payment_Model_Method_Abstract
{
    protected $_code = 'Gateway';
 
    /**
     * Is this payment method a gateway (online auth/charge) ?
     */
    protected $_isGateway               = true;
 
    /**
     * Can authorize online?
     */
    protected $_canAuthorize            = true;
 
    /**
     * Can capture funds online?
     */
    protected $_canCapture              = false;
 
    /**
     * Can capture partial amounts online?
     */
    protected $_canCapturePartial       = false;
 
    /**
     * Can refund online?
     */
    protected $_canRefund               = false;
 
    /**
     * Can void transactions online?
     */
    protected $_canVoid                 = false;
 
    /**
     * Can use this payment method in administration panel?
     */
    protected $_canUseInternal          = true;
 
    /**
     * Can show this payment method as an option on checkout payment page?
     */
    protected $_canUseCheckout          = true;
 
    /**
     * Is this payment method suitable for multi-shipping checkout?
     */
    protected $_canUseForMultishipping  = true;
 
    /**
     * Can save credit card information for future processing?
     */
    protected $_canSaveCc = false;
	
	
    public function authorize(Varien_Object $payment, $amount) 
    {

      $token = Mage::getStoreConfig('payment/Gateway/token');
	
      if($token == null) return null;
      

      $order = $payment->getOrder();
      $currency = $order->getBaseCurrencyCode();
	  
	  $amount = sprintf("%.2f", $amount);
      
      //POST TO Bitmarket API
      $order = $payment->getOrder();
      $order->getId();

      $r = new HttpRequest("https://api.bitmarket.ph/invoice?orderid=$order", HttpRequest::METH_POST);
      $r->setOptions(array('header' => array('authorization' => "bitmarket-sec $token")));

      try {
        $body = $r->send()->getBody();
        $body = json_decode($body);
        if ($body != null) {
            $paylink = $body['paylink_url']."?iframe";
            $id = $body['id'];

        } else {
            Mage::log('Error creating Bitmarket.ph invoice', Zend_Log::CRIT);
            Mage::log("Response code: ". $r->getResponseCode(), Zend_Log::CRIT);
            Mage::throwException("Error creating Bitmarket.ph invoice. Please try again or use another payment option.");
        }

      } catch (HttpException $ex) {
        Mage::log('Error creating Bitmarket.ph invoice', Zend_Log::CRIT);
        Mage::log("HTTP Exception: ". $ex, Zend_Log::CRIT);
        Mage::throwException("Error creating Bitmarket.ph invoice. Please try again or use another payment option.");
        $paylink = "https://pay.bitmarket.ph/tryagain?iframe";
        $id = null;

      }
      

      $payment->setIsTransactionPending(true);
      Mage::getSingleton('customer/session')->($paylink);
      
      return $this;
    }

    
    public function getOrderPlaceRedirectUrl()
    {
      return Mage::getSingleton('customer/session')->getRedirectUrl();
    }
}
?>
