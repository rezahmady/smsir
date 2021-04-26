<?php

namespace Rezahmady\Smsir;

use Illuminate\Support\ServiceProvider;

class SmsirServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // Bootstrap code here.
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../configs/smsir.php', 'smsir');
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../configs/smsir.php' => config_path('smsir.php'),
            ], 'config');
        }
        $this->app->bind('smsir', function ($app) {
            return new SmsirClient(config('smsir.api-key'), config('smsir.secret-key'), config('smsir.line-number'), config('smsir.request-timeout'));
        });
    }
}
