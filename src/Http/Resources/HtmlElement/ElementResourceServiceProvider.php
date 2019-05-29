<?php

namespace Belvedere\FormMaker\Http\Resources\Input;

use Belvedere\FormMaker\Contracts\Resources\SiblingResourcerContract;
use Belvedere\FormMaker\Http\Resources\HtmlElement\ElementResourcer;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ElementResourceServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(SiblingResourcerContract::class, function ($app, $context) {
            $resource = $app->config->get('form-maker.resources.html_element', new ElementResourcer($context['element']));
            if (is_string($resource)) {
                return new $resource($context['element']);
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