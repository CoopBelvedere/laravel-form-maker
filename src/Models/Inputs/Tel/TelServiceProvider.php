<?php

namespace Belvedere\FormMaker\Models\Inputs\Tel;

use Belvedere\FormMaker\Contracts\Inputs\Tel\TelerContract;

class TelServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(TelerContract::class, function ($app) {
            return $app->config->get('form-maker.nodes.inputs.tel', new Teler());
        });

        $this->app->alias(TelerContract::class, 'form-maker.tel');
    }
}