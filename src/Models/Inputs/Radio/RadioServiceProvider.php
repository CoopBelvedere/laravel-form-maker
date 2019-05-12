<?php

namespace Belvedere\FormMaker\Models\Inputs\Radio;

use Belvedere\FormMaker\Contracts\Inputs\Radio\RadioerContract;

class RadioServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(RadioerContract::class, function ($app) {
            return $app->config->get('form-maker.nodes.inputs.radio', new Radioer());
        });

        $this->app->alias(RadioerContract::class, 'form-maker.radio');
    }
}