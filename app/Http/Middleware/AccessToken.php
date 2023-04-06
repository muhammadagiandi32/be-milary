<?php

namespace App\Http\Middleware;

use App\Models\AccessToken as ModelsAccessToken;
use Closure;
// use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// use Throwable;
use Illuminate\Database\QueryException;
use NunoMaduro\Collision\Adapters\Laravel\ExceptionHandler;

class AccessToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = ModelsAccessToken::where('token', $request->header('X-API-KEY'))->first();

        if (!$request->header('X-API-KEY')) {
            return response()->json([
                'metadata' => [
                    'path' => '/',
                    'http_status_code' => 'Forbidden',
                    'errors' => [
                        'code' => 403,
                        'message' => 'Unauthorized Access. You are not authorized to access this resource.'
                    ],
                    'timestamp' => now()->timestamp
                ]
            ]);
        } elseif (!$token) {
            return response()->json([
                'metadata' => [
                    'path' => '/',
                    'http_status_code' => 'Forbidden',
                    'errors' => [
                        'code' => 403,
                        'message' => 'Unauthorized Access. You are not authorized to access this resource.'
                    ],
                    'timestamp' => now()->timestamp
                ]
            ]);
        }
        return $next($request);
    }
}
