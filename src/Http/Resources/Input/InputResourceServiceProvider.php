<?php

namespace Belvedere\FormMaker\Http\Resources\Input;

use Belvedere\FormMaker\Contracts\Resources\InputResourcerContract;
use Belvedere\FormMaker\Http\Resources\InputResourcer;
use Carbon\Laravel\ServiceProvider;

class InputResourceServiceProvider extends ServiceProvider
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
}