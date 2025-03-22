<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function isAuthenticated(): bool
    {
        return Auth::guard('sanctum')->check();
    }

    public static function getAuthenticatedUser()
    {
        return Auth::guard('sanctum')->user();
    }

    public static function unauthorizedResponse()
    {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized'
        ], 401);
    }
}
