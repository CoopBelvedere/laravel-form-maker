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
        $this->app->bind(RankerContract::class, function ($app) {
            $ranker = $app->config->get('form-maker.ranking', new Ranker());
            if (is_string($ranker)) {
                return new $ranker();
            }
            return $ranker;
        });
    }
}
