<?php

namespace Belvedere\FormMaker\Models\Inputs\Password;

use Belvedere\FormMaker\Contracts\Inputs\Password\PassworderContract;
use Illuminate\{
    Contracts\Support\DeferrableProvider,
    Support\ServiceProvider
};

class PasswordServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(PassworderContract::class, function ($app) {
            $passworder = $app->config->get('form-maker.nodes.inputs.password', new Passworder());
            if (is_string($passworder)) {
                return new $passworder();
            }
            return $passworder;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [PassworderContract::class];
    }
}