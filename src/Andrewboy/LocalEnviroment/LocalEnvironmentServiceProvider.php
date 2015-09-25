<?php namespace Andrewboy\LocalEnviroment;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Config;

class LocalEnvironmentServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (\App::isLocal()) {
            $this->registerServiceProviders();
            $this->registerFacadeAliases();
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Load local service providers
     */
    protected function registerServiceProviders()
    {
        foreach (Config::get('local.app.providers') as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Load additional Aliases
     */
    public function registerFacadeAliases()
    {
        $loader = AliasLoader::getInstance();
        foreach (Config::get('local.app.aliases') as $alias => $facade) {
            $loader->alias($alias, $facade);
        }
    }
}
