<?php

namespace emericklaw\SQLAnywhere;

use Illuminate\Support\ServiceProvider;


class SQLAnywhereServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $factory = $this->app['db'];
        $factory->extend('sqlanywhere', function ($config) {
            if (!isset($config['prefix'])) {
                $config['prefix'] = '';
            }

            $connector =  new SQLAnywhereConnector();
            $pdo = $connector->connect($config);
            return new SQLAnywhereConnection($pdo, $config['database'], $config['prefix'], $config);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
