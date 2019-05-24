<?php

namespace Belvedere\FormMaker\Models\Inputs\Text;

use Belvedere\FormMaker\Contracts\Inputs\Text\TexterContract;
use Illuminate\Support\ServiceProvider;

class TextServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(TexterContract::class, function ($app) {
            $texter = $app->config->get('form-maker.nodes.inputs.text', new Texter());
            if (is_string($texter)) {
                return new $texter();
            }
            return $texter;
        });

        $this->app->alias(TexterContract::class, 'form-maker.text');
    }
}