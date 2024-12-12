
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

class ApiPeruServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('apiperu', function ($app) {
            return Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.apiperu.token'),
                'Accept' => 'application/json',
            ])->baseUrl(config('services.apiperu.base_url'));
        });
    }

    public function boot()
    {
    }
}
