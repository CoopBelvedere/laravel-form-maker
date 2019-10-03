<?php

namespace Belvedere\FormMaker\Http\Resources\Nodes\Siblings\Label;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Belvedere\FormMaker\Contracts\Http\Resources\Nodes\Siblings\LabelResourcerContract;

class LabelResourceServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(LabelResourcerContract::class, function ($app, $context) {
            $resource = $app->config->get('form-maker.resources.label', new LabelResourcer($context['label']));
            if (is_string($resource)) {
                return new $resource($context['label']);
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
        return [LabelResourcerContract::class];
    }
}
