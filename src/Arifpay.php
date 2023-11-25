<?php

namespace Phpsdk;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . "/Validation.php";

use Phpsdk\Model\CheckoutModel;
use Phpsdk\Model\CheckoutItem;
use Phpsdk\Model\Beneficiary;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Arifpay
{
    const baseUrl = 'https://gateway.arifpay.org/api/sandbox/checkout/session';

    private $client;
    private $headers;
    private $apiKey;

    /**
     * @param string $apiKey A secret key provided
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client(['base_uri' => self::baseUrl]);
        $this->headers = [
            'Content-Type' => 'application/json',
            'x-arifpay-key' => $this->apiKey
        ];
    }

    public function initialize(CheckoutModel $checkoutModel)
    {
        try {
            Validator::validate($checkoutModel);
    
            foreach ($checkoutModel->getItems() as $item) {
                Validator::validateCheckoutItem($item);
            }
    
            $beneficiary = $checkoutModel->getBeneficiaries()[0];
            Validator::validateBeneficiary($beneficiary);
    
            $response = $this->client->post(self::baseUrl, [
                'headers' => $this->headers,
                'json' => $checkoutModel
            ]);
    
            if ($response->getStatusCode() === 200) {
                $responseData = json_decode($response->getBody(), true);
               return $response->getBody();

            } else {
                return 'Request failed with status: ' . $response->getStatusCode();
            }
        } catch (\InvalidArgumentException $e) {
            return 'Validation Error: ' . $e->getMessage();
        } catch (ClientException $e) {
            return 'Error occurred while fetching data: ' . $e->getMessage();
        }
    }
}