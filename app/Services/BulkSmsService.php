<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BulkSmsService
{
    protected $apiKey;
    protected $senderId;
    protected $apiUrl;

    public function __construct()
    {
        $this->apiKey = env('BULKSMSBD_API_KEY');
        $this->senderId = env('BULKSMSBD_SENDER_ID');
        $this->apiUrl = 'https://bulksmsbd.net/api/smsapi';
    }

    public function sendSms($phone, $message)
    {
        $response = Http::get($this->apiUrl, [
            'api_key' => $this->apiKey,
            'senderid' => $this->senderId,
            'number' => $phone,
            'message' => 'Your Poultry Master OTP Code is: ' . $message,
        ]);

        return $response->json();
    }
}
