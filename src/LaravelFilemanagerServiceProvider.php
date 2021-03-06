<?php

namespace Unisharp\Laravelfilemanager;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelFilemanagerServiceProvider.
 */
class LaravelFilemanagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Config::get('lfm.use_package_routes')) {
            include __DIR__ . '/routes.php';
        }

        $this->loadTranslationsFrom(__DIR__.'/lang', 'laravel-filemanager');

        $this->loadMigrationsFrom(__DIR__.'/migrations/2017_10_09_055144_create_files_table.php');

        $this->loadViewsFrom(__DIR__.'/views', 'laravel-filemanager');

        $this->publishes([
            __DIR__ . '/config/lfm.php' => base_path('config/lfm.php'),
        ], 'lfm_config');

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/laravel-filemanager'),
        ], 'lfm_public');

        $this->publishes([
            __DIR__.'/views'  => base_path('resources/views/vendor/laravel-filemanager'),
        ], 'lfm_view');

        $this->publishes([
            __DIR__.'/Handlers/LfmConfigHandler.php' => base_path('app/Handlers/LfmConfigHandler.php'),
        ], 'lfm_handler');

        $this->publishes([
            __DIR__.'/migrations' => database_path('migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/models/File.php' => base_path('app/Models/File.php'),
        ], 'model');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('laravel-filemanager', function () {
            return true;
        });
    }
}
