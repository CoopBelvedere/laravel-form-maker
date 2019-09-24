<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Option;

use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Option\OptionerContract;
use Illuminate\{
    Contracts\Support\DeferrableProvider,
    Support\ServiceProvider
};

class OptionServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(OptionerContract::class, function ($app) {
            $optioner = $app->config->get('form-maker.nodes.inputs.option', new Optioner());
            if (is_string($optioner)) {
                return new $optioner();
            }
            return $optioner;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [OptionerContract::class];
    }
}