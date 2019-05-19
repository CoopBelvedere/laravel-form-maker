<?php

namespace Belvedere\FormMaker\Models\Inputs\Month;

use Belvedere\FormMaker\Contracts\Inputs\Month\MontherContract;
use Illuminate\Support\ServiceProvider;

class MonthServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(MontherContract::class, function ($app) {
            return $app->config->get('form-maker.nodes.inputs.month', new Monther());
        });

        $this->app->alias(MontherContract::class, 'form-maker.month');
    }
}