<?php

namespace Belvedere\FormMaker\Models\Rules;

use Belvedere\FormMaker\Contracts\Rules\RulerContract;
use Illuminate\Support\ServiceProvider;

class RuleServiceProvider extends ServiceProvider
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
}
