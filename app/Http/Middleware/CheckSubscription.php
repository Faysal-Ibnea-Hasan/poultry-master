<?php

namespace App\Http\Middleware;

use App\Models\Subscriber;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('sanctum')->user();

        $subscriber = Subscriber::where('user_id', $user->id)->first();
        if (!$subscriber) {
            return response()->json(['message' => 'You don\'t have access to this page'], Response::HTTP_FORBIDDEN);
        }
        if ($subscriber->is_active == 0) {
            return response()->json(['message' => 'Your subscription is inactive! Please renew or active your plan.'], Response::HTTP_FORBIDDEN);
        }
        $subscription_is_valid = $subscriber->end_date > now() || $subscriber->subscription?->type == 'lifetime';
        if ($subscription_is_valid) {
            return $next($request);
        } else {
            return response()->json(['message' => 'Your subscription has expired! Please renew or active your plan.'], Response::HTTP_FORBIDDEN);
        }
    }
}
