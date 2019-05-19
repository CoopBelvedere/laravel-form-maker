<?php

namespace Belvedere\FormMaker\Models\Ranking;

use Belvedere\FormMaker\Contracts\Ranking\RankerContract;
use Illuminate\Support\ServiceProvider;

class RankingServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(RankerContract::class, function ($app) {
            return $app->config->get('form-maker.ranking', new Ranker());
        });

        $this->app->alias(RankerContract::class, 'form-maker.ranking');
    }
}
