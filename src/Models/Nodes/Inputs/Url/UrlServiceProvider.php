<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Url;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Url\UrlerContract;

class UrlServiceProvider extends ServiceProvider implements DeferrableProvider
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
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [UrlerContract::class];
    }
}
