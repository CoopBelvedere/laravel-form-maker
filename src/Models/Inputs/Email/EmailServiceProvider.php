<?php

namespace Belvedere\FormMaker\Models\Inputs\Email;

use Belvedere\FormMaker\Contracts\Inputs\Email\EmailerContract;
use Illuminate\{
    Contracts\Support\DeferrableProvider,
    Support\ServiceProvider
};

class EmailServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(EmailerContract::class, function ($app) {
            $emailer = $app->config->get('form-maker.nodes.inputs.email', new Emailer());
            if (is_string($emailer)) {
                return new $emailer();
            }
            return $emailer;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [EmailerContract::class];
    }
}