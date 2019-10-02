<?php

namespace Belvedere\FormMaker;

use Illuminate\{
    Http\Resources\Json\Resource,
    Support\ServiceProvider
};

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
        $this->publishes([
            __DIR__ . '/../database/migrations/create_form_maker_tables.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_form_maker_tables.php'),
        ], 'form-maker-migrations');
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
