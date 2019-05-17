<?php
/**
 * Developed by Alireza Hamedashki.
 * Email: a.hamedashki@gmail.com
 * Mobile: +98 938 900 4559
 * Date: 5/14/19
 * Time: 11:26 PM
 */

namespace Adlino\Charter724;

use Illuminate\Support\ServiceProvider;

class Charter724ServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishConfig();

        $this->publishMigrations();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Charter724', function () { return new Charter724; });
        $this->registerCommands();

        $this->mergeConfigFrom(
            __DIR__ . '/Config/charter724.php', 'charter724'
        );
    }

    /**
     * Publish config file.
     */
    private function publishConfig()
    {
        $this->publishes([__DIR__ . '/Config/charter724.php' => config_path('charter724.php')], 'config');
    }

    /**
     * Publish migration file.
     */
    private function publishMigrations()
    {
        $this->publishes([__DIR__ . '/Migrations' => database_path('migrations')], 'migrations');
    }

    /**
     * TODO:
     * Some Description About This
     */
    private function registerCommands()
    {
        $this->commands([
            \Adlino\Charter724\Console\GenerateAccessToken::class,
        ]);

        $this->commands([
            \Adlino\Charter724\Console\StoreAirports::class,
        ]);
    }
}