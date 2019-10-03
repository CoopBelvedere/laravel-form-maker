<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Textarea;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Textarea\TextareaerContract;

class TextareaServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(TextareaerContract::class, function ($app) {
            $textareaer = $app->config->get('form-maker.nodes.inputs.textarea', new Textareaer());
            if (is_string($textareaer)) {
                return new $textareaer();
            }

            return $textareaer;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [TextareaerContract::class];
    }
}
