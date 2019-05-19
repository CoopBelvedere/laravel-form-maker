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
        $this->app->bind(WeekerContract::class, function ($app) {
            $weeker = $app->config->get('form-maker.nodes.inputs.week', new Weeker());
            if (is_string($weeker)) {
                return new $weeker();
            }
            return $weeker;
        });

        $this->app->alias(WeekerContract::class, 'form-maker.week');
    }
}