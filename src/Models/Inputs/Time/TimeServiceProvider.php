<?php

namespace Belvedere\FormMaker\Models\Inputs\Time;

use Belvedere\FormMaker\Contracts\Inputs\Time\TimerContract;

class TimeServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(TimerContract::class, function ($app) {
            return $app->config->get('form-maker.nodes.inputs.time', new Timer());
        });

        $this->app->alias(TimerContract::class, 'form-maker.time');
    }
}