<?php
namespace phpsdk;

use Phpsdk\Model\Beneficiary;
use Phpsdk\Model\CheckoutItem;
use Phpsdk\Model\CheckoutModel;

require_once __DIR__ . "/Model/CheckoutModel.php";

class Validator
{
    public static function validateBeneficiary(Beneficiary $beneficiary)
    {
        if (!is_numeric($beneficiary->accountNumber)) {
            throw new \InvalidArgumentException('Invalid account number format. Please provide a numeric value for the account number.');
        }

        if (!is_string($beneficiary->bank)) {
            throw new \InvalidArgumentException('Invalid bank format. Please provide a string for the bank.');
        }

        if (!is_numeric($beneficiary->amount)) {
            throw new \InvalidArgumentException('Invalid amount format. Please provide a numeric value for the amount.');
        }
    }

    public static function validateCheckoutItem(CheckoutItem $checkoutItem)
    {
        if (!is_string($checkoutItem->name)) {
            throw new \InvalidArgumentException('Invalid name format. Please provide a string for the name.');
        }

        if (!is_numeric($checkoutItem->quantity)) {
            throw new \InvalidArgumentException('Invalid quantity format. Please provide a numeric value for the quantity.');
        }

        if (!is_numeric($checkoutItem->price)) {
            throw new \InvalidArgumentException('Invalid price format. Please provide a numeric value for the price.');
        }

        if (!is_string($checkoutItem->image)) {
            throw new \InvalidArgumentException('Invalid image format. Please provide a string for the image.');
        }

        if (!is_string($checkoutItem->description)) {
            throw new \InvalidArgumentException('Invalid description format. Please provide a string for the description.');
        }
    }

    public static function validate(CheckoutModel $checkoutModel)
    {
        try {
            // Validate cancelUrl
            $cancelUrl = $checkoutModel->getCancelUrl();
            if (!filter_var($cancelUrl, FILTER_VALIDATE_URL)) {
                throw new \InvalidArgumentException('Invalid cancelUrl format. Please provide a valid URL.');
            }

            // Validate phone
            $phone = $checkoutModel->getPhone();
            if (!is_numeric($phone)) {
                throw new \InvalidArgumentException('Invalid phone format. Please provide a numeric value for the phone number.');
            }

            // Validate email
            $email = $checkoutModel->getEmail();
            if (!preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/", $email)) {
                throw new \InvalidArgumentException('Invalid email format. Please provide a valid email address.');
            }

            // Validate nonce
            // $nonce = $checkoutModel->getNonce();
            // if (!is_string($nonce)) {
            //     throw new \InvalidArgumentException('Invalid nonce format. Please provide a string value for the nonce.');
            // }

            // Validate errorUrl
            $errorUrl = $checkoutModel->getErrorUrl();
            if (!filter_var($errorUrl, FILTER_VALIDATE_URL)) {
                throw new \InvalidArgumentException('Invalid errorUrl format. Please provide a valid URL.');
            }

            // Validate notifyUrl
            $notifyUrl = $checkoutModel->getNotifyUrl();
            if (!filter_var($notifyUrl, FILTER_VALIDATE_URL)) {
                throw new \InvalidArgumentException('Invalid notifyUrl format. Please provide a valid URL.');
            }

            // Validate successUrl
            $successUrl = $checkoutModel->getSuccessUrl();
            if (!filter_var($successUrl, FILTER_VALIDATE_URL)) {
                throw new \InvalidArgumentException('Invalid successUrl format. Please provide a valid URL.');
            }
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException($e->getMessage());
        }
    }

    /**
     * @param string $prefix Prefix for transaction reference token e.g. company initials.
     * @return string Generated token which contains $prefix, some random string
     *                and a timestamp.
     * @throws \Exception
     */
    public static function generateToken($prefix = 'cp')
    {
        return $prefix . '_' . bin2hex(random_bytes(5)) . '_' . date('d-m-y_h-i-s');
    }
}