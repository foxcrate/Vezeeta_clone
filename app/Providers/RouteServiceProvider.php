<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    /* admin namespace */
    protected $Adminnamespace = 'App\Http\Controllers\backEnd';

    protected $Dashbordnamespace = 'App\Http\Controllers\backEnd\Dashbord';


    public const ADMIN = 'adminPanel/homepage';
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        // admin route map //
        $this->mapAdminRoutes();

        // dashbord route map //
        $this->mapDashbordRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }
    // admin routes //
    protected function mapAdminRoutes()
    {
        Route::namespace($this->Adminnamespace)
        ->group(base_path('routes/admin/admin.php'));
    }

    // dashbord routes //
    protected function mapDashbordRoutes()
    {
        Route::namespace($this->Dashbordnamespace)
        ->group(base_path('routes/admin/dashbord.php'));
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
