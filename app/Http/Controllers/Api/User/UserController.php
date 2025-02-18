<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\AuthInterface;
use App\Services\BulkSmsService;
use Illuminate\Http\Request;
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
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
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
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 200);
        }

        return $this->authRepo->setupPin($request->pin);
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
}
