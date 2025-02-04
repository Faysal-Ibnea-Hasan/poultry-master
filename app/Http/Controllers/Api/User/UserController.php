<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\AuthInterface;
use App\Services\BulkSmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            return response()->json($validator->errors(), 400);
        }
        $success = $this->authRepo->login($request->all());
        if ($success) {
            return $success;
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Invalid login details'
            ]);
        }
    }

    public function otpRequest(Request $request)
    {
        $success = $this->authRepo->otpRequest($request->all());
        if ($success) {
            return $success;
        } else {
            return response()->json([
                'status' => false,
                'message' => 'OTP request failed'
            ], 500);
        }
    }

    public function otpVerify(Request $request)
    {
        $success = $this->authRepo->verifyOtp($request->all());
        if ($success) {
            return $success;
        } else {
            return response()->json([
                'status' => false,
                'message' => 'OTP request failed'
            ], 500);
        }
    }

    public function pinSetup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pin' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = $this->authRepo->setupPin($request->pin);
        if ($user) {
            return $user;
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Pin setup failed'
            ], 500);
        }
    }

}
