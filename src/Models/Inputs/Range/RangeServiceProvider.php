<?php

namespace Belvedere\FormMaker\Models\Inputs\Range;

use Belvedere\FormMaker\Contracts\Inputs\Range\RangerContract;

class RangeServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(RangerContract::class, function ($app) {
            return $app->config->get('form-maker.nodes.inputs.range', new Ranger());
        });

        $this->app->alias(RangerContract::class, 'form-maker.range');
    }
}