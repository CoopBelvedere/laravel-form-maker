<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Email;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Email\EmailerContract;

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
