<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAccountStatus
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('sanctum')->user();
        if (auth('sanctum')->check()) {
            if ($user->is_banned) {
                return response([
                    'status' => false,
                    'message' => 'Your account is banned'
                ]);
            }
        }
        return $next($request);

    }
}
