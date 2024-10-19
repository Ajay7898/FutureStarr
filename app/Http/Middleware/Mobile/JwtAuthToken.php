<?php

namespace App\Http\Middleware\Mobile;

use Closure;
use JWTAuth;
use Request;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Response;
use App\User;
use \Illuminate\Http\Response as Res;

class JwtAuthToken extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $apiKey = trim($request->header('FS-API-KEY'));
        try {
            if ($apiKey != 'futurestarr'){
                return response()->json(['status' => 'error', 'status_code' => Res::HTTP_UNAUTHORIZED, 'message' => 'Unauthorized Access!'], Res::HTTP_UNAUTHORIZED);
            }
        } catch (Exception $e) {
            $message = 'API Key not found';
            return response()->json(['status' => 'error', 'status_code' => Res::HTTP_UNAUTHORIZED, 'message' => $message], Res::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
