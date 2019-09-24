<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Date;

use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Date\DaterContract;
use Illuminate\{
    Contracts\Support\DeferrableProvider,
    Support\ServiceProvider
};

class DateServiceProvider extends ServiceProvider implements DeferrableProvider
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
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [DaterContract::class];
    }
}