<?php

namespace Belvedere\FormMaker\Models\Inputs\Option;

use Belvedere\FormMaker\Contracts\Inputs\Option\OptionerContract;

class OptionServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(OptionerContract::class, function ($app) {
            return $app->config->get('form-maker.nodes.inputs.option', new Optioner());
        });

        $this->app->alias(OptionerContract::class, 'form-maker.option');
    }
}