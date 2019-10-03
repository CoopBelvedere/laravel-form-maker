<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Week;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Week\WeekerContract;

class WeekServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(WeekerContract::class, function ($app) {
            $weeker = $app->config->get('form-maker.nodes.inputs.week', new Weeker());
            if (is_string($weeker)) {
                return new $weeker();
            }

            return $weeker;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [WeekerContract::class];
    }
}
