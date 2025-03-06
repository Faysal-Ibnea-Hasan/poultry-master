<?php

namespace App\Interfaces;
interface AuthInterface
{
    public function otpRequest(array $data);

    public function verifyOtp(array $data);

    public function setupPin(string $pin,string $device_name,string $device_id);

    public function login(array $data);

    public function getCountryCode(string $region);

    public function getAllValidRegions();

    public function formatPhoneNumber(string $msisdn, string $region);
}