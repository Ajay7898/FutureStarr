<?php
namespace App\Http\Middleware\Mobile;

use App\Article;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use \Illuminate\Http\Response as Res;

class BuyerMiddleware
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->getUser()->role_id != "3") {
              return response()->json(['status' => 'error', 'status_code' => Res::HTTP_UNAUTHORIZED, 'message' => 'Unauthorized Access!'], Res::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}