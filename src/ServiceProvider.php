<?php

namespace Enlightn\LaravelSecurityChecker;

use Enlightn\LaravelSecurityChecker\Console\SecurityCheckCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SecurityCheckCommand::class,
            ]);
        }
    }
}
