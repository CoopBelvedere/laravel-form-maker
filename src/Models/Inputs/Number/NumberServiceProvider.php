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
        $this->app->bind(NumberContract::class, function ($app) {
            $number = $app->config->get('form-maker.nodes.inputs.number', new Number());
            if (is_string($number)) {
                return new $number();
            }
            return $number;
        });

        $this->app->alias(NumberContract::class, 'form-maker.number');
    }
}