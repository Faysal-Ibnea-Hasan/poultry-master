<?php

namespace App\Repositories;

use App\Interfaces\AuthInterface;
use App\Models\CompanyAndChick;
use App\Models\User;
use App\Services\BulkSmsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthInterface
{
    protected $bulkSmsService;

    public function __construct(BulkSmsService $bulkSmsService)
    {
        $this->bulkSmsService = $bulkSmsService;
    }

    public function otpRequest(array $data)
    {
        if ($this->checkIfUserExists($data['msisdn'])) {
            return response()->json([
                'status' => true,
                'message' => 'User already exists'
            ], 200);
        }

        $otp = rand(100000, 999999);

        $user = User::create([
            'phone' => $data['msisdn'],
            'otp' => $otp
        ]);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create user'
            ], 500);
        }

        if ($this->bulkSmsService->sendSms($data['msisdn'], $otp)) {
            return response()->json([
                'status' => true,
                'message' => 'OTP sent successfully'
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to send OTP'
        ], 500);
    }

    public function verifyOtp(array $data)
    {
        if (empty($data['consent']) || empty($data['msisdn'])) {
            return response()->json([
                'status' => false,
                'message' => 'Phone number and consent are required'
            ], 400);
        }

        $user = User::where('phone', $data['msisdn'])
            ->where('otp', $data['consent'])
            ->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Consent does not match'
            ], 401);
        }

        // Generate Sanctum token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Optionally, reset OTP after successful verification
        $user->update(['otp' => null]);

        return response()->json([
            'status' => true,
            'message' => 'OTP verified successfully',
            'token' => $token,
            'msisdn' => $user->phone
        ], 200);
    }

    public function setupPin(string $pin)
    {
        // Get the authenticated user
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized. Invalid token.'
            ], 401);
        }

        // Hash and store the PIN
        $user->update([
            'password' => Hash::make($pin)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'PIN set successfully'
        ], 200);
    }

    public function login(array $data)
    {
        $user = User::where('phone', $data['msisdn'])->first();

        if (!$user || !Hash::check($data['pin'], $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Generate new token after login
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token,
            'msisdn' => $user->phone
        ], 200);
    }


    private function checkIfUserExists(string $msisdn): bool
    {
        return User::where('phone', $msisdn)->exists();
    }


}
