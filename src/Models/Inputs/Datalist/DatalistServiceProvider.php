<?php

namespace Belvedere\FormMaker\Models\Inputs\Datalist;

use Belvedere\FormMaker\Contracts\Inputs\Datalist\DatalisterContract;
use Illuminate\Support\ServiceProvider;

class DatalistServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(DatalisterContract::class, function ($app) {
            $datalister = $app->config->get('form-maker.nodes.inputs.datalist', new Datalister());
            if (is_string($datalister)) {
                return new $datalister();
            }
            return $datalister;
        });

        $this->app->alias(DatalisterContract::class, 'form-maker.datalist');
    }
}