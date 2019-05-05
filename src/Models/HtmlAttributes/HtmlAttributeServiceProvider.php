<?php

namespace Belvedere\FormMaker\Models\HtmlAttributes;

use Belvedere\FormMaker\Contracts\HtmlAttributes\HtmlAttributerContract;
use Illuminate\Support\ServiceProvider;

class HtmlAttributeServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(HtmlAttributerContract::class, function ($app) {
            return $app->config->get('form-maker.html_attributes', new HtmlAttributer());
        });

        $this->app->alias(HtmlAttributerContract::class, 'form-maker.html_attributes');
    }
}
