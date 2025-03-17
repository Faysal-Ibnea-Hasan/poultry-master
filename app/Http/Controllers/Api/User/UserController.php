<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserDetailsResource;
use App\Interfaces\AuthInterface;
use App\Services\BulkSmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    protected $bulkSmsService;

    public function __construct(BulkSmsService $bulkSmsService, protected AuthInterface $authRepo)
    {
        $this->bulkSmsService = $bulkSmsService;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'msisdn' => 'required|max:15',
            'pin' => 'required|string',
            'device_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
            ], 200);
        }

        return $this->authRepo->login($request->all());
    }

    public function otpRequest(Request $request)
    {
        $valid_regions = $this->authRepo->getAllValidRegions();
        $validator = Validator::make($request->all(), [
            'msisdn' => ['required'], // AUTO detects country code
            'region' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($valid_regions) {
                    if (!in_array(strtoupper($value), $valid_regions)) {
                        $fail("The selected $attribute is invalid.");
                    }
                },
            ], // Allow all valid regions
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 200);
        }

        // Check OTP resend cooldown
        $cacheKey = 'otp_resend_' . $request->msisdn;
        if (Cache::has($cacheKey)) {
            return response()->json([
                'status' => false,
                'message' => 'You can request OTP again after 4 minutes.'
            ], 429);
        }

        // Set cooldown period (4 minutes)
        Cache::put($cacheKey, true, now()->addMinutes(4));

        return $this->authRepo->otpRequest($request->all());
    }


    public function otpVerify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'msisdn' => 'required|max:15',
            'consent' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 200);
        }

        return $this->authRepo->verifyOtp($request->all());
    }

    public function pinSetup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pin' => 'required|string',
            'device_name' => 'required|string',
            'device_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 200);
        }

        return $this->authRepo->setupPin($request->pin, $request->device_name, $request->device_id);
    }

    public function getValidRegions()
    {
        return $this->authRepo->getAllValidRegions();
    }

    public function getCountryCode(Request $request)
    {
        $valid_regions = $this->authRepo->getAllValidRegions();
        $validator = Validator::make($request->all(), [
            'region' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($valid_regions) {
                    if (!in_array(strtoupper($value), $valid_regions)) {
                        $fail("The selected $attribute is invalid.");
                    }
                },
            ], // Allow all valid regions
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 200);
        }
        return response()->json([
            'status' => true,
            'country_code' => $this->authRepo->getCountryCode($request->region)
        ], 200);
    }

    public function updateProfile(Request $request)
    {
        $user = auth::user();
        if ($request->isMethod('get')) {
            return response()->json([
                'status' => true,
                'message' => 'User data fetched successfully.',
                'data' => new UserDetailsResource($user)
            ]);
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'address' => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => []
            ], 422);
        }

        // Updating user profile
        $user->update($request->only(['name', 'email', 'address']));

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully',
            'data' => []
        ], 200);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            // Revoke current access token
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status' => true,
                'message' => 'User logged out successfully.',
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'You are not logged in.',
        ], 401);
    }


}
