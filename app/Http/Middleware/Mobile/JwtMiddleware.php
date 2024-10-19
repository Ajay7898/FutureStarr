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
use Auth;

class JwtMiddleware extends BaseMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // echo "JwtMiddleware::handle \n";
        $token  = $request->header('authorization');
        $token  = trim(str_replace("bearer", "", $token));
        $token  = trim(str_replace("Bearer", "", $token));
        // dd(JWTAuth::authenticate($token));
        
        try {

            // $user = 
            $user = JWTAuth::parseToken($token)->authenticate();
            if (!$user || $user->api_token != $token){
                return response()->json(['status' => 'error', 'status_code' => Res::HTTP_UNAUTHORIZED, 'message' => 'Unauthorized Access!'], Res::HTTP_UNAUTHORIZED);
            }
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                $message = 'Token is Invalid';
            } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                $message = 'Token is Expired';
            } else {
                $message = 'Authorization Token not found';
            }

            return response()->json(['status' => 'error', 'status_code' => Res::HTTP_UNAUTHORIZED, 'message' => $message], Res::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
