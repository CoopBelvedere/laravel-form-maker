<?php

namespace Belvedere\FormMaker;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\ServiceProvider;

class FormMakerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishMigration();

        $this->publishConfig();

        Resource::withoutWrapping();
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
            __DIR__ . '/../database/migrations/create_form_maker_tables.php' => database_path('migrations/' . $timestamp . '_create_form_maker_tables.php'),
        ], 'form-migrations');

        $this->publishes([
            __DIR__ . '/../../../database/migrations/create_ranking_tables.php' => database_path('migrations/' . $timestamp . '_create_ranking_tables.php'),
        ], 'ranking-migrations');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    protected function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/form-maker.php' => config_path('form-maker.php'),
        ]);
    }
}
