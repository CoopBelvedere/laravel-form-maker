<?php

namespace Belvedere\FormMaker\Models\Rankings;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Belvedere\FormMaker\Contracts\Models\Rankings\RankerContract;

class RankingServiceProvider extends ServiceProvider implements DeferrableProvider
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

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [RankerContract::class];
    }
}
