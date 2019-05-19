<?php

namespace Belvedere\FormMaker\Models\Inputs\Week;

use Belvedere\FormMaker\Contracts\Inputs\Week\WeekerContract;
use Illuminate\Support\ServiceProvider;

class WeekServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(WeekerContract::class, function ($app) {
            return $app->config->get('form-maker.nodes.inputs.week', new Weeker());
        });

        $this->app->alias(WeekerContract::class, 'form-maker.week');
    }
}