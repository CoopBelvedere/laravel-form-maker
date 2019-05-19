<?php

namespace Belvedere\FormMaker\Models\Inputs\Url;

use Belvedere\FormMaker\Contracts\Inputs\Url\UrlerContract;
use Illuminate\Support\ServiceProvider;

class UrlServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(UrlerContract::class, function ($app) {
            return $app->config->get('form-maker.nodes.inputs.url', new Urler());
        });

        $this->app->alias(UrlerContract::class, 'form-maker.url');
    }
}