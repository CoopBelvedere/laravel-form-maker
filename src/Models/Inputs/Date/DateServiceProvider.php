<?php

namespace Belvedere\FormMaker\Models\Inputs\Date;

use Belvedere\FormMaker\Contracts\Inputs\Date\DaterContract;
use Illuminate\Support\ServiceProvider;

class DateServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(DaterContract::class, function ($app) {
            $dater = $app->config->get('form-maker.nodes.inputs.date', new Dater());
            if (is_string($dater)) {
                return new $dater();
            }
            return $dater;
        });

        $this->app->alias(DaterContract::class, 'form-maker.date');
    }
}