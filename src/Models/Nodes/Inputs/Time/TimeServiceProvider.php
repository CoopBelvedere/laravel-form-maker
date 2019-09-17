<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Time;

use Belvedere\FormMaker\Contracts\Inputs\Time\TimerContract;
use Illuminate\{
    Contracts\Support\DeferrableProvider,
    Support\ServiceProvider
};

class TimeServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(TimerContract::class, function ($app) {
            $timer = $app->config->get('form-maker.nodes.inputs.time', new Timer());
            if (is_string($timer)) {
                return new $timer();
            }
            return $timer;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [TimerContract::class];
    }
}