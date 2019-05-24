<?php

namespace Belvedere\FormMaker\Http\Resources\Input;

use Belvedere\FormMaker\Contracts\Resources\InputResourcerContract;
use Belvedere\FormMaker\Http\Resources\InputResourcer;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

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
            $resource = $app->config->get('form-maker.resources.inputs', new InputResourcer($context['input']));
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