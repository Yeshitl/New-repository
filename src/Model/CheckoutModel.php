<?php
namespace Phpsdk\Model;

//use Phpsdk\Beneficiary;
//use Phpsdk\CheckoutItem;

/**
 * The CheckoutModel class is an object representation of JSON form data
 * that will be posted to Arifpay API.
 */
require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/Beneficiary.php";
require_once __DIR__ . "/CheckoutItem.php";

class CheckoutModel
{
    
    public $cancelUrl;
    public $nonce;
    public $phone;
    public $email;
    public $errorUrl;
    public $notifyUrl;
    public $successUrl;
    public $paymentMethods = [];
    public $expireDate;
    public $items = [];
    public $beneficiaries = [];
    public $lang;

    // private $orderId;
    // private $redirectUrl;

    // public function setOrderId($orderId)
    // {
    //     $this->orderId = $orderId;
    // }
    // public function setRedirectUrl($redirectUrl)
    // {
    //     $this->redirectUrl = $redirectUrl;
    // }



    public function getCancelUrl()
    {
        return $this->cancelUrl;
    }

    public function cancelUrl($cancelUrl)
    {
        $this->cancelUrl = $cancelUrl;
        return $this;
    }

    public function generateNonce()
    {
        $this->nonce = uniqid();
        return $this;
    }
    
    public function getNonce()
    {
        return $this->nonce;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function phone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function email($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getErrorUrl()
    {
        return $this->errorUrl;
    }

    public function errorUrl($errorUrl)
    {
        $this->errorUrl = $errorUrl;
        return $this;
    }

    public function getNotifyUrl()
    {
        return $this->notifyUrl;
    }

    public function notifyUrl($notifyUrl)
    {
        $this->notifyUrl = $notifyUrl;
        return $this;
    }

    public function getSuccessUrl()
    {
        return $this->successUrl;
    }

    public function successUrl($successUrl)
    {
        $this->successUrl = $successUrl;
        return $this;
    }

    public function paymentMethods($paymentMethods)
    {
        if (is_array($paymentMethods)) {
            foreach ($paymentMethods as $method) {
                if (!is_string($method)) {
                    throw new InvalidArgumentException('All payment methods should be strings.');
                }
            }
        } else {
            throw new InvalidArgumentException('Payment methods should be an array.');
        }

        $this->paymentMethods = $paymentMethods;
        return $this;
    }
    public function getExpireDate()
    {
        return $this->expireDate;
    }

    public function expireDate($expireDate)
    {
        $this->expireDate = $expireDate;
        return $this;
    }

    public function getBeneficiaries()
    {
        return $this->beneficiaries;
    }

    public function addBeneficiary(Beneficiary $beneficiary)
    {
        $this->beneficiaries[] = $beneficiary;
        return $this;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function addItems(CheckoutItem $items)
    {
        $this->items[] = $items;
        return $this;
    }



    /**
     * @return array    An associative array that contains post data
     *                  as a key-value pair.
     */
    public function getAsKeyValue()
    {
        $data = array();

        $data['cancelUrl'] = $this->cancelUrl;
        $data['phone'] = $this->phone;
        $data['email'] = $this->email;
        $data['nonce'] = $this->generateNonce();
        $data['errorUrl'] = $this->errorUrl;
        $data['notifyUrl'] = $this->notifyUrl;
        $data['successUrl'] = $this->successUrl;
        $data['paymentMethods'] = $this->paymentMethods;
        $data['expireDate'] = $this->expireDate;
        $data['items'] = $this->items;
        $data['beneficiaries'] = $this->beneficiaries;
        $data['lang'] = $this->lang;

        return $data;
    }
}
