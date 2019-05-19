<?php

namespace Belvedere\FormMaker\Models\Inputs\Range;

use Belvedere\FormMaker\Contracts\Inputs\Range\RangerContract;
use Illuminate\Support\ServiceProvider;

class RangeServiceProvider extends ServiceProvider
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

        $this->app->alias(RangerContract::class, 'form-maker.range');
    }
}