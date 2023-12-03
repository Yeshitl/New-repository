<?php
namespace Phpsdk;

use Phpsdk\Model\Beneficiary;
use Phpsdk\Model\CheckoutModel;
use Phpsdk\Model\CheckoutItem;
use Phpsdk\Arifpay;

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/Model/CheckoutModel.php";
require_once __DIR__ . "/Model/CheckoutItem.php";
require_once __DIR__ . "/Arifpay.php";

$checkoutModel = new CheckoutModel();
$arifpay = new Arifpay('tZzd6Kd34xXfY7GNAi9eMjjLeaNXuxYR');

$checkoutModel->cancelUrl('https://example.com')
    ->phone('251944294981')
    ->email('natnae@arifpay.net')
    ->generateNonce()
    ->errorUrl('http://error.com')
    ->notifyUrl('https://gateway.arifpay.net/test/callback')
    ->successUrl('http://example.com')
    ->paymentMethods([''])
    ->expireDate('2025-02-01T03:45:27');


// Create an array of items
$items = [
    new CheckoutItem(
        'ሙ4ዝ',
        1,
        1,
        'https://4.imimg.com/data4/KK/KK/GLADMIN-/product-8789_bananas_golden-500x500.jpg',
        'Fresh Corner premium Banana.'
    ),
    new CheckoutItem(
        'ሙዝ',
        1,
        1,
        'https://4.imimg.com/data4/KK/KK/GLADMIN-/product-8789_bananas_golden-500x500.jpg',
        'Fresh Corner premium Banana.'
    )
];

// Set the items property of the checkout model
foreach ($items as $item) {
    $checkoutModel->addItems($item);
}

$beneficiaries = [
    new Beneficiary(
        '01320811436100',
        'AWINETAA',
        2.0
    ),

];

foreach ($beneficiaries as $beneficiary) {
    $checkoutModel->addBeneficiary($beneficiary);
}

$checkoutModel->lang = 'EN';

$result = $arifpay->initialize($checkoutModel);
echo $result;
?>