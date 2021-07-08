<?php

namespace App\Providers;

use App\Services\InstanceManagement;
use Aws\Laravel\AwsFacade as AWS;
use Illuminate\Support\ServiceProvider;

class ManagementProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(InstanceManagement::class, function () {
            return new InstanceManagement(AWS::createClient('rds'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
