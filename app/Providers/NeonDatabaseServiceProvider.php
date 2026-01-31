<?php

namespace App\Providers;

use App\Database\NeonPostgresConnector;
use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Support\ServiceProvider;

class NeonDatabaseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Extend the connection factory to use our custom PostgresConnector
        $this->app->extend('db.factory', function (ConnectionFactory $factory, $app) {
            return new class($app) extends ConnectionFactory {
                public function createConnector(array $config)
                {
                    if (isset($config['driver']) && $config['driver'] === 'pgsql') {
                        return new NeonPostgresConnector;
                    }
                    
                    return parent::createConnector($config);
                }
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
