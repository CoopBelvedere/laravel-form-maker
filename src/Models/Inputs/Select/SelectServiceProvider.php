<?php

namespace Belvedere\FormMaker\Models\Inputs\Select;

use Belvedere\FormMaker\Contracts\Inputs\Select\SelecterContract;

class SelectServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(SelecterContract::class, function ($app) {
            return $app->config->get('form-maker.nodes.inputs.select', new Selecter());
        });

        $this->app->alias(SelecterContract::class, 'form-maker.select');
    }
}