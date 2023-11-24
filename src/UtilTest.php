<?php
namespace Phpsdk;

use Phpsdk\Model\Beneficiary;
use Phpsdk\Model\CheckoutModel;
use Phpsdk\Model\CheckoutItem; // Add the import statement for CheckoutItem
use Phpsdk\Arifpay;

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/Model/CheckoutModel.php"; // Update the path to the CheckoutModel file
require_once __DIR__ . "/Model/CheckoutItem.php"; // Add the path to the CheckoutItem file
require_once __DIR__ . "/Arifpay.php";

$checkoutModel = new CheckoutModel(); // Create an instance of CheckoutModel
$arifpay = new Arifpay('tZzd6Kd34xXfY7GNAi9eMjjLeaNXuxYR');
// Add the additional properties from the provided JSON data
$checkoutModel->cancelUrl('https://example.com')
    ->phone('251944294981')
    ->email('natnael@arifpay.net')
    ->generateNonce()
    ->errorUrl('http://error.com')
    ->notifyUrl('https://gateway.arifpay.net/test/callback')
    ->successUrl('http://example.com')
    ->paymentMethods(['TELEBIRR'])
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
//echo json_encode($checkoutModel)
$result = $arifpay->initialize($checkoutModel);
echo $result;

?>