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
        $this->app->bind(ColorerContract::class, function ($app) {
            $colorer = $app->config->get('form-maker.nodes.inputs.color', new Colorer());
            if (is_string($colorer)) {
                return new $colorer();
            }
            return $colorer;
        });

        $this->app->alias(ColorerContract::class, 'form-maker.color');
    }
}