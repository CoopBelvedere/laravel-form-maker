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
        $this->app->bind(UrlerContract::class, function ($app) {
            $urler = $app->config->get('form-maker.nodes.inputs.url', new Urler());
            if (is_string($urler)) {
                return new $urler();
            }
            return $urler;
        });

        $this->app->alias(UrlerContract::class, 'form-maker.url');
    }
}