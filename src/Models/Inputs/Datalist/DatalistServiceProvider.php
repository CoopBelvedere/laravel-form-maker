<?php

namespace Belvedere\FormMaker\Models\Inputs\Datalist;

use Belvedere\FormMaker\Contracts\Inputs\Datalist\DatalisterContract;

class DatalistServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(DatalisterContract::class, function ($app) {
            return $app->config->get('form-maker.nodes.inputs.datalist', new Datalister());
        });

        $this->app->alias(DatalisterContract::class, 'form-maker.datalist');
    }
}