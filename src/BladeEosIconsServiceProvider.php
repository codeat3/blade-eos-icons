<?php

declare(strict_types=1);

namespace Codeat3\BladeEosIcons;

use BladeUI\Icons\Factory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;

final class BladeEosIconsServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config')->get('blade-eos-icons', []);

            $factory->add('codicon', array_merge(['path' => __DIR__.'/../resources/svg'], $config));
        });

    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/blade-eos-icons.php', 'blade-eos-icons');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-eos-icons'),
            ], 'blade-eos-icons');

            $this->publishes([
                __DIR__.'/../config/blade-eos-icons.php' => $this->app->configPath('blade-eos-icons.php'),
            ], 'blade-eos-icons-config');
        }
    }
}
