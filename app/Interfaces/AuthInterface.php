<?php

namespace App\Interfaces;
interface AuthInterface
{
    public function otpRequest(array $data);
    public function verifyOtp(array $data);
    public function setupPin(string $pin);
    public function login(array $data);
}