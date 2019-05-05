<?php

namespace Belvedere\FormMaker\Models\Ranking;

use Belvedere\FormMaker\Contracts\Ranking\RankerContract;
use Illuminate\Support\ServiceProvider;

class RankingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishMigration();
    }

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

    /**
     * Publish Form Maker migrations
     *
     * @return void
     */
    protected function publishMigration(): void
    {
        $timestamp = date('Y_m_d_His', time());

        $this->publishes([
            __DIR__ . '/../../../database/migrations/create_ranking_tables.php' => database_path('migrations/' . $timestamp . '_create_ranking_tables.php'),
        ], 'ranking-migrations');
    }
}
