<?php

namespace Belvedere\FormMaker\Models\HtmlAttributes;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Belvedere\FormMaker\Contracts\Models\HtmlAttributes\HtmlAttributerContract;

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
            $htmlAttributer = $app->config->get('form-maker.services.html_attributes', new HtmlAttributer());
            if (is_string($htmlAttributer)) {
                return new $htmlAttributer();
            }

            return $htmlAttributer;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [HtmlAttributerContract::class];
    }
}
