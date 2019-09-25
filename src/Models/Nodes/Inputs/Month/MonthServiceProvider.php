<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Month;

use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Month\MontherContract;
use Illuminate\{
    Contracts\Support\DeferrableProvider,
    Support\ServiceProvider
};

class MonthServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(MontherContract::class, function ($app) {
            $monther = $app->config->get('form-maker.nodes.inputs.month', new Monther());
            if (is_string($monther)) {
                return new $monther();
            }
            return $monther;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [MontherContract::class];
    }
}