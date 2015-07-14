<?php 
namespace sngrl\SphinxSearch;

class SphinxSearchServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->app['sphinxsearch'] = $this->app->share(function ($app) {
            return new SphinxSearch;
        });
    }

    public function boot()
    {

        $this->publishes([
            __DIR__.'/../../../config/sphinxsearch.php' => config_path('sphinxsearch.php'),
        ]);
    }

}
