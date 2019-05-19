<?php

namespace Belvedere\FormMaker\Models\Inputs\Time;

use Belvedere\FormMaker\Contracts\Inputs\Time\TimerContract;
use Illuminate\Support\ServiceProvider;

class TimeServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(TimerContract::class, function ($app) {
            $timer = $app->config->get('form-maker.nodes.inputs.time', new Timer());
            if (is_string($timer)) {
                return new $timer();
            }
            return $timer;
        });

        $this->app->alias(TimerContract::class, 'form-maker.time');
    }
}