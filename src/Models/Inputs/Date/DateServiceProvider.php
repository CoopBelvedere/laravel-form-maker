<?php

namespace Belvedere\FormMaker\Models\Inputs\Date;

use Belvedere\FormMaker\Contracts\Inputs\Date\DaterContract;

class DateServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(DaterContract::class, function ($app) {
            return $app->config->get('form-maker.nodes.inputs.date', new Dater());
        });

        $this->app->alias(DaterContract::class, 'form-maker.date');
    }
}