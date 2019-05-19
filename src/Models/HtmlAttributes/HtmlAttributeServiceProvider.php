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
            $htmlAttributer = $app->config->get('form-maker.services.html_attributes', new HtmlAttributer());
            if (is_string($htmlAttributer)) {
                return new $htmlAttributer();
            }
            return $htmlAttributer;
        });

        $this->app->alias(HtmlAttributerContract::class, 'form-maker.html_attributes');
    }
}
