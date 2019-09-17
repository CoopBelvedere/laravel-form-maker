<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Number;

use Belvedere\FormMaker\Contracts\Inputs\Number\NumberContract;
use Illuminate\{
    Contracts\Support\DeferrableProvider,
    Support\ServiceProvider
};

class NumberServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(NumberContract::class, function ($app) {
            $number = $app->config->get('form-maker.nodes.inputs.number', new Number());
            if (is_string($number)) {
                return new $number();
            }
            return $number;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [NumberContract::class];
    }
}