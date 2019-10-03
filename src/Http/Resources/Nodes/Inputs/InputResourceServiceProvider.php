<?php

namespace Belvedere\FormMaker\Http\Resources\Nodes\Inputs;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Belvedere\FormMaker\Contracts\Http\Resources\Nodes\Inputs\InputResourcerContract;

class InputResourceServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(InputResourcerContract::class, function ($app, $context) {
            $resource = $app->config->get('form-maker.resources.input', new InputResourcer($context['input']));
            if (is_string($resource)) {
                return new $resource($context['input']);
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
        return [InputResourcerContract::class];
    }
}
