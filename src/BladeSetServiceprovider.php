<?php

namespace Sineld\BladeSet;

use Blade;
use Illuminate\Support\ServiceProvider;

class BladeSetServiceProvider extends ServiceProvider
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
        $config = __DIR__ . '/../config/bladeset.php';
        $this->publishes([$config => config_path('bladeset.php')], 'config');
        $this->mergeConfigFrom($config, 'bladeset');
        $variables = $this->app['config']->get('bladeset.variables');

        foreach ($variables as $variable) {
            Blade::extend(function ($value) use ($variable) {
                return preg_replace("/@{$variable}\(['\"](.*?)['\"]\,(.*)\)/", '<?php $$1 =$2; ?>', $value);
            });
        }
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

}
