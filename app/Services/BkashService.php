<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BkashService
{
    private $baseUrl, $token, $username, $password, $app_key, $app_secret_key, $callback_url;

    public function __construct()
    {
        $this->baseUrl = 'https://tokenized.sandbox.bka.sh/v1.2.0-beta/tokenized';
        $this->username = '01770618567';
        $this->password = 'D7DaC<*E*eG';
        $this->app_key = '0vWQuCRGiUX7EPVjQDr0EUAYtc';
        $this->app_secret_key = 'jcUNPBgbcqEDedNKdvE4G1cAK7D3hCjmJccNPZZBq96QIxxwAMEx';
        $this->callback_url = env('APP_URL');
        $this->token = $this->getToken();
    }

//    public function getToken()
//    {
//        $response = Http::withHeaders([
//            'username' => $this->username,
//            'password' => $this->password,
//            'Content-Type' => 'application/json',
//            'Accept' => 'application/json',
//        ])->post("$this->baseUrl/checkout/token/grant", [
//            'app_key' => $this->app_key,
//            'app_secret' => $this->app_secret_key,
//        ]);
//
//        return $response->json(); // Return JSON response
//    }
    public function getToken()
    {
        $response = Http::withHeaders([
            'username' => $this->username,
            'password' => $this->password,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post("$this->baseUrl/checkout/token/grant", [
            'app_key' => $this->app_key,
            'app_secret' => $this->app_secret_key,
        ]);

        $data = $response->json();
        if (isset($data['id_token'])) {
            $this->token = $data['id_token']; // Store token in class variable
            return $this->token;
        }

        throw new \Exception('bKash Token Generation Failed: ' . json_encode($data));
    }
    public function createPayment($amount, $invoice)
    {
        $token = $this->getToken(); // Ensure token is fetched
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'authorization' => $token, // Ensure proper format
            'x-app-key' => $this->app_key,
        ])
            ->post("$this->baseUrl/checkout/create", [
                'mode' => '0011', // 0011 = Checkout, 0012 = Tokenized Payment
                'payerReference' => $invoice,
                'amount' => $amount,
                'currency' => 'BDT',
                'intent' => 'sale',
                'merchantInvoiceNumber' => $invoice,
                'callbackURL' => $this->callback_url . '/api/subscription/payment-success',
            ]);

        return $response->json(); // Decode the JSON response
    }

//    public function createPayment($amount, $invoice)
//    {
//        $response = Http::withHeaders([
//                'Content-Type' => 'application/json',
//                'Accept' => 'application/json',
//                'Authorization'=> $this->token['id_token'],
//                'X-App-Key' => $this->app_key,
//            ])
//            ->post("$this->baseUrl/tokenized/checkout/create", [
//                'mode' => '0011', // 0011 = Checkout, 0012 = Tokenized Payment
//                'payerReference' => $invoice,
//                'amount' => $amount,
//                'currency' => 'BDT',
//                'intent' => 'sale',
//                'merchantInvoiceNumber' => $invoice,
//                'callbackURL' => $this->callback_url . '/api/subscription/payment-success',
//            ]);
//
//        return $response->json(); // Decode the JSON response
//    }


    public function executePayment($paymentID)
    {
        $token = $this->getToken(); // Ensure you are using the latest token

        return Http::withHeaders([
            'Accept' => 'application/json',
            'authorization' =>  $token,
            'x-app-key' => $this->app_key,
        ])->post("$this->baseUrl/checkout/execute", [
            'paymentID' => $paymentID
        ])->json();
    }

}