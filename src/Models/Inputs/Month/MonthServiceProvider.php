<?php

namespace Belvedere\FormMaker\Models\Inputs\Month;

use Belvedere\FormMaker\Contracts\Inputs\Month\MontherContract;
use Illuminate\Support\ServiceProvider;

class MonthServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(MontherContract::class, function ($app) {
            $monther = $app->config->get('form-maker.nodes.inputs.month', new Monther());
            if (is_string($monther)) {
                return new $monther();
            }
            return $monther;
        });

        $this->app->alias(MontherContract::class, 'form-maker.month');
    }
}