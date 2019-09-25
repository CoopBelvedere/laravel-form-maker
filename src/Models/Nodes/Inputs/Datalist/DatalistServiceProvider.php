<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Datalist;

use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Datalist\DatalisterContract;
use Illuminate\{
    Contracts\Support\DeferrableProvider,
    Support\ServiceProvider,
};

class DatalistServiceProvider extends ServiceProvider implements DeferrableProvider
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
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [DatalisterContract::class];
    }
}