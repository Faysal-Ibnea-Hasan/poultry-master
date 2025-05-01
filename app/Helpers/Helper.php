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

    public static function variableFriendly(string $value): string
    {
        return preg_replace('/[^a-z0-9_]/', '',
            str_replace(' ', '_',
                strtolower($value)
            )
        );
    }
}
