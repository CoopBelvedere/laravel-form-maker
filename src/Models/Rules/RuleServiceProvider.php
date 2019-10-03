<?php

namespace Belvedere\FormMaker\Models\Rules;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Belvedere\FormMaker\Contracts\Models\Rules\RulerContract;

class RuleServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(RulerContract::class, function ($app) {
            $ruler = $app->config->get('form-maker.services.rules', new Ruler());
            if (is_string($ruler)) {
                return new $ruler();
            }

            return $ruler;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [RulerContract::class];
    }
}
