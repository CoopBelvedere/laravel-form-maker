<?php

namespace Belvedere\FormMaker\Http\Resources\Nodes\Siblings;

use Belvedere\FormMaker\Contracts\Http\Resources\Nodes\Siblings\SiblingResourcerContract;
use Illuminate\{
    Contracts\Support\DeferrableProvider,
    Support\ServiceProvider
};

class SiblingResourceServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(SiblingResourcerContract::class, function ($app, $context) {
            $resource = $app->config->get('form-maker.resources.sibling', new SiblingResourcer($context['sibling']));
            if (is_string($resource)) {
                return new $resource($context['sibling']);
            }
            return $resource;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [SiblingResourcerContract::class];
    }
}