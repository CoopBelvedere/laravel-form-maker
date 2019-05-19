<?php

namespace Belvedere\FormMaker\Models\Inputs\Number;

use Belvedere\FormMaker\Contracts\Inputs\Number\NumberContract;
use Illuminate\Support\ServiceProvider;

class NumberServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(NumberContract::class, function ($app) {
            return $app->config->get('form-maker.nodes.inputs.number', new Number());
        });

        $this->app->alias(NumberContract::class, 'form-maker.number');
    }
}