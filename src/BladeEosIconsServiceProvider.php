<?php

declare(strict_types=1);

namespace Codeat3\BladeEosIcons;

use BladeUI\Icons\Factory;
use Illuminate\Support\ServiceProvider;

final class BladeEosIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->callAfterResolving(Factory::class, function (Factory $factory) {
            $factory->add('eos-icons', [
                'path' => __DIR__.'/../resources/svg',
                'prefix' => 'eos',
            ]);
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-eos-icons'),
            ], 'blade-eos-icons');
        }
    }
}
