<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Select;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Select\SelecterContract;

class SelectServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(SelecterContract::class, function ($app) {
            $selecter = $app->config->get('form-maker.nodes.inputs.select', new Selecter());
            if (is_string($selecter)) {
                return new $selecter();
            }

            return $selecter;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [SelecterContract::class];
    }
}
