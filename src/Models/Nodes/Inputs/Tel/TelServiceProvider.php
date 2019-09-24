<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Tel;

use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Tel\TelerContract;
use Illuminate\{
    Contracts\Support\DeferrableProvider,
    Support\ServiceProvider
};

class TelServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(TelerContract::class, function ($app) {
            $teler = $app->config->get('form-maker.nodes.inputs.tel', new Teler());
            if (is_string($teler)) {
                return new $teler();
            }
            return $teler;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [TelerContract::class];
    }
}