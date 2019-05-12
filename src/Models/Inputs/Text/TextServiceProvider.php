<?php

namespace Belvedere\FormMaker\Models\Inputs\Text;

use Belvedere\FormMaker\Contracts\Inputs\Text\TexterContract;

class TextServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(TexterContract::class, function ($app) {
            return $app->config->get('form-maker.nodes.inputs.text', new Texter());
        });

        $this->app->alias(TexterContract::class, 'form-maker.text');
    }
}