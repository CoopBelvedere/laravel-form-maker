<?php

namespace Chess\FormMaker;

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
        ], 'migrations');
    }
}
