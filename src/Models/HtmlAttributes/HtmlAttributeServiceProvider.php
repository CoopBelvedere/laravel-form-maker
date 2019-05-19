<?php

namespace Belvedere\FormMaker\Models\HtmlAttributes;

use Belvedere\FormMaker\Contracts\HtmlAttributes\HtmlAttributerContract;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class HtmlAttributeServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(HtmlAttributerContract::class, function ($app) {
            return $app->config->get('form-maker.services.html_attributes', new HtmlAttributer());
        });

        $this->app->alias(HtmlAttributerContract::class, 'form-maker.html_attributes');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [config('form-maker.services.html_attributes', new HtmlAttributer())];
    }
}
