<?php

namespace App\Http\Middleware;

use App\Helpers\Constants;
use App\Traits\BaseResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PassportAuthMiddleware
{
    use BaseResponse;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('api')->check()){
            return $next($request);
        }

        return self::statusResponse(
            Constants::HTTP_CODE_401,
            Constants::HTTP_MESSAGE_401
        );
    }
}
