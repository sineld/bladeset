<?php

namespace Sineld\BladeSet;

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
        $configPath = __DIR__ . '/../config/bladeset.php';
        $this->publishes([$configPath => config_path('bladeset.php')], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/bladeset.php';
        $this->mergeConfigFrom($configPath, 'bladeset');
        $variables = $this->app['config']->get('bladeset.variables');
        $blade     = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();

        foreach ($variables as $variable) {

            $blade->extend(function ($value, $compiler) use ($variable) {
                $value = preg_replace("/@{$variable}\(['\"](.*?)['\"]\,(.*)\)/", '<?php $$1 =$2; ?>', $value);
                return $value;
            });
        }
    }

}
