<?php

namespace Belvedere\FormMaker\Models\Inputs\Color;

use Belvedere\FormMaker\Contracts\Inputs\Color\ColorerContract;
use Illuminate\Support\ServiceProvider;

class ColorServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(ColorerContract::class, function ($app) {
            return $app->config->get('form-maker.nodes.inputs.color', new Colorer());
        });

        $this->app->alias(ColorerContract::class, 'form-maker.color');
    }
}