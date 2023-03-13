<?php

namespace App\Http\Middleware\API\v1;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use function PHPUnit\Framework\isFalse;

class ProtectedRouteAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {

            $user = JWTAuth::parseToken()->authenticate();
            //$access_token_header = explode(' ', $request->header('Authorization'))[1];

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['status' => 'Token is invalid'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['status' => 'Token is expired'], 401);
        } catch (\Exception $e) {
            return response()->json(['status' => 'Authorization token not found'], 401);
        }
        return $next($request);
    }
}
