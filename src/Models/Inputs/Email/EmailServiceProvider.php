<?php

namespace Belvedere\FormMaker\Models\Inputs\Email;

use Belvedere\FormMaker\Contracts\Inputs\Email\EmailerContract;
use Illuminate\Support\ServiceProvider;

class EmailServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(EmailerContract::class, function ($app) {
            return $app->config->get('form-maker.nodes.inputs.email', new Emailer());
        });

        $this->app->alias(EmailerContract::class, 'form-maker.email');
    }
}