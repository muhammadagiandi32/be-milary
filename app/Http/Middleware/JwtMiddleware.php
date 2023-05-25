<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $header = $request->header('X-AUTH-TOKEN');
        // try {
        //     $user = JWTAuth::parseToken()->authenticate();
        //     // JWTAuth::validate()
        // } catch (Exception $e) {
        //     if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
        //         return response()->json(['status' => 'Token is Invalid']);
        //     } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
        //         return response()->json(['status' => 'Token is Expired']);
        //     } else {
        //         return response()->json(['status' => 'Authorization Token not found']);
        //     }
        // }
        try {
            //code...
            $token = new Token($header);
            JWTAuth::decode($token);
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->route('/');
        }
        return $next($request);
    }
}
