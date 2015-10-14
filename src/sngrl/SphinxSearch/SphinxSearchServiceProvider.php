<?php 
namespace sngrl\SphinxSearch;

use Illuminate\Support\ServiceProvider;

class SphinxSearchServiceProvider extends ServiceProvider
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
            ## Original
            #__DIR__.'../../../../config/sphinxsearch.php' => config_path('sphinxsearch.php'),

            ## https://github.com/sngrl/sphinxsearch/issues/3
            __DIR__.'/../../../config/sphinxsearch.php' => config_path('sphinxsearch.php'),
        ]);
    }

}