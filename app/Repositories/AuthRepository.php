<?php

namespace App\Repositories;

use App\Interfaces\AuthInterface;
use App\Models\User;
use App\Services\BulkSmsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

class AuthRepository implements AuthInterface
{
    protected $bulkSmsService;

    public function __construct(BulkSmsService $bulkSmsService)
    {
        $this->bulkSmsService = $bulkSmsService;
    }

    public function otpRequest(array $data)
    {

        $otp = rand(1000, 9999);

        DB::beginTransaction();
        try {
            $country_code = $this->getCountryCode($data['region']);
            $formatted_number = $this->formatPhoneNumber($data['msisdn'], $data['region']);
            if ($data['isForget'] == 1) {
                if ($this->checkIfUserExists($formatted_number)) {
                    $user = User::where('phone', $formatted_number)->first();
                    $user->otp = $otp;
                    $user->save();
                    if (!$this->bulkSmsService->sendSms($data['msisdn'], $otp)) {
                        throw new \Exception('Failed to send OTP');
                    }
                    DB::commit();
                    return response()->json([
                        'status' => true,
                        'message' => 'OTP has been sent successfully for Forget Password',
                        'msisdn' => $user->phone,
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'User is not a registered user!',
                    ]);
                }
            }
            if ($this->checkIfUserExists($formatted_number)) {
                return response()->json([
                    'status' => false,
                    'message' => 'User already exists'
                ], 200);
            }
            if ($this->checkIfRequestExists($formatted_number)) {
                $user = User::where('phone', $formatted_number)->first();
                $user->otp = $otp;
                $user->save();
                if (!$this->bulkSmsService->sendSms($data['msisdn'], $otp)) {
                    throw new \Exception('Failed to send OTP');
                }
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'OTP has been sent successfully for Registration',
                    'msisdn' => $user->phone,
                ]);
            }
            $user = User::create([
                'phone' => $formatted_number,
                'country_code' => $country_code,
                'otp' => $otp
            ]);

            if (!$this->bulkSmsService->sendSms($data['msisdn'], $otp)) {
                throw new \Exception('Failed to send OTP');
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'OTP has been sent successfully',
                'msisdn' => $user->phone,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 200);
        }
    }

    public function verifyOtp(array $data)
    {
        $user = User::where('phone', $data['msisdn'])
            ->where('otp', $data['consent'])
            ->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP'
            ], 200);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        $user->update(['otp' => null]);

        return response()->json([
            'status' => true,
            'message' => 'OTP verified successfully',
            'token' => $token,
            'msisdn' => $user->phone
        ], 200);
    }

    public function setupPin(string $pin, string $device_name, string $device_id, bool $isForget)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized. Invalid token.'
            ], 401);
        }
        if ($isForget == 1) {
            $isOldUser = $user->where('device_id', $device_id)->where('device_name', $device_name)->first();
            if ($isOldUser) {
                $isOldUser->password = Hash::make($pin);
                $isOldUser->save();
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'This account is not for this device!'
                ]);
            }
        }

        $user->update([
            'password' => Hash::make($pin),
            'device_name' => $device_name,
            'device_id' => $device_id
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
            ], 200);
        }
        if ($user->device_id !== $data['device_id'] || $user->device_id == null) {
            return response()->json([
                'status' => false,
                'message' => 'You can\'t login with this device'
            ], 200);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token,
            'user_name' => $user->name,
            'msisdn' => $user->phone
        ], 200);
    }

    private function checkIfUserExists(string $msisdn): bool
    {
        return User::where('phone', $msisdn)
            ->whereNotNull('password')
            ->exists();
    }

    private function checkIfRequestExists(string $msisdn): bool
    {
        return User::where('phone', $msisdn)
            ->whereNull('password')
            ->whereNotNull('otp')
            ->exists();
    }


    public function getCountryCode(string $region)
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        $region = strtoupper($region);
        return $phoneUtil->getCountryCodeForRegion($region);
    }

    public function getAllValidRegions()
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        return $phoneUtil->getSupportedRegions(); // Returns an array of country codes
    }

    public function formatPhoneNumber(string $msisdn, string $region)
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        $parsedNumber = $phoneUtil->parse($msisdn, $region);
        return $phoneUtil->format($parsedNumber, PhoneNumberFormat::E164);
    }

}
