<?php

namespace Belvedere\FormMaker\Models\Inputs\Select;

use Belvedere\FormMaker\Contracts\Inputs\Select\SelecterContract;
use Illuminate\Support\ServiceProvider;

class SelectServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(SelecterContract::class, function ($app) {
            $selecter = $app->config->get('form-maker.nodes.inputs.select', new Selecter());
            if (is_string($selecter)) {
                return new $selecter();
            }
            return $selecter;
        });

        $this->app->alias(SelecterContract::class, 'form-maker.select');
    }
}