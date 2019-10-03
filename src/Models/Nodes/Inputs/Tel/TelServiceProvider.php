<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Tel;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Tel\TelerContract;

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
