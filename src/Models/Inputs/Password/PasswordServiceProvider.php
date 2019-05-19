<?php

namespace Belvedere\FormMaker\Models\Inputs\Password;

use Belvedere\FormMaker\Contracts\Inputs\Password\PassworderContract;
use Illuminate\Support\ServiceProvider;

class PasswordServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(PassworderContract::class, function ($app) {
            return $app->config->get('form-maker.nodes.inputs.password', new Passworder());
        });

        $this->app->alias(PassworderContract::class, 'form-maker.password');
    }
}