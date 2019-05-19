<?php

namespace Belvedere\FormMaker\Models\Inputs\Option;

use Belvedere\FormMaker\Contracts\Inputs\Option\OptionerContract;
use Illuminate\Support\ServiceProvider;

class OptionServiceProvider extends ServiceProvider
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

        $this->app->alias(OptionerContract::class, 'form-maker.option');
    }
}