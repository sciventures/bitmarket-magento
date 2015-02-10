<?php

class Bitmarket_Payment_Helper_Api extends Mage_Core_Helper_Abstract
{

    private $authHeader;
    private $callbackUrl;
    private $redirectUrl;
    private $invoiceEndpoint;
    private $paylinkEndpoint;
    private $payUrl;


    public function __construct()
    {
        $bitmarket = Mage::getConfig()->getNode('default/payment/bitmarket');
        $this->authHeader = str_replace('{api_token}', Mage::getStoreConfig('payment/bitmarket/api_token'), $bitmarket->auth_header);
        $this->callbackUrl = Mage::getUrl($bitmarket->callback_path);
        $this->redirectUrl = Mage::getUrl($bitmarket->redirect_path);
        $this->invoiceEndpoint = $bitmarket->invoice_endpoint;
        $this->paylinkEndpoint = $bitmarket->paylink_endpoint;
        $this->payUrl = $bitmarket->pay_url;
    }

    public function createInvoice(Varien_Object $payment, $amount)
    {
        $payload = json_encode(
            array(
                "amount" => sprintf('%.2f', $amount),
                "callback" => str_replace('{order_id}', $payment->getOrder()->getId(), $this->callbackUrl),
                "redirectURL" => $this->redirectUrl
            )
        );
        $ch = $this->prepareCall($this->invoiceEndpoint, true, $payload);

        return $this->makeCall($ch);
    }

    public function getInvoice($invoiceId)
    {
        $ch = $this->prepareCall($this->invoiceEndpoint . '/' . $invoiceId);

        return $this->makeCall($ch);
    }

    public function getPaylink($invoiceId)
    {
        $ch = $this->prepareCall(str_replace('{invoice_id}', $invoiceId, $this->paylinkEndpoint));

        return str_replace('{paylink_code}', $this->makeCall($ch)->code, $this->payUrl);
    }


    private function prepareCall($endpoint, $post = false, $payload = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($this->authHeader));
        if ($post) curl_setopt($ch, CURLOPT_POST, $post);
        if ($payload) curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        return $ch;
    }

    private function makeCall($ch)
    {
        $response = curl_exec($ch);
        $error = curl_error($ch);
        if ($error) {
            Mage::throwException($error);
        }
        curl_close($ch);

        $result = json_decode($response);
        $error = json_last_error();
        if ($error != JSON_ERROR_NONE) {
            Mage::throwException("JSON error $error");
        }
        if (isset($result->error)) {
            Mage::throwException($result->error);
        }

        return $result;
    }

}
