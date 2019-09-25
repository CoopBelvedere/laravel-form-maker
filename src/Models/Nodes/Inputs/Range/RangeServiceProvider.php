<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Range;

use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Range\RangerContract;
use Illuminate\{
    Contracts\Support\DeferrableProvider,
    Support\ServiceProvider
};

class RangeServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(RangerContract::class, function ($app) {
            $ranger = $app->config->get('form-maker.nodes.inputs.range', new Ranger());
            if (is_string($ranger)) {
                return new $ranger();
            }
            return $ranger;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [RangerContract::class];
    }
}