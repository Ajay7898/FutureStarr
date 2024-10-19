<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    protected $namespace = 'App\\Http\\Controllers';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            // Route::prefix('api')
            //     ->middleware('api')
            //     ->namespace($this->namespace)
            //     ->group(base_path('routes/api.php'));

            //     // dd($this->namespace);
            // Route::middleware('web')
            //     ->namespace($this->namespace)
            //     ->group(base_path('routes/web.php'));

            $this->mapApiRoutes();


            $this->mapWebRoutes();


        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }



    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/admin/routes.php');
            require base_path('routes/buyer-dashboard/routes.php');
            require base_path('routes/seller-dashboard/routes.php');
            require base_path('routes/talents/routes.php');
            require base_path('routes/social-buzz/routes.php');
            require base_path('routes/blogs/routes.php');
            require base_path('routes/footer-pages/routes.php');
            require base_path('routes/talent-search/routes.php');
            require base_path('routes/contact-us/routes.php');
            require base_path('routes/forgot-password/routes.php');
            require base_path('routes/custom-login/routes.php');
            require base_path('routes/web.php');
        });        
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
