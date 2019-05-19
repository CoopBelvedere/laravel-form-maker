<?php

namespace Belvedere\FormMaker\Models\Inputs\Textarea;

use Belvedere\FormMaker\Contracts\Inputs\Textarea\TextareaerContract;
use Illuminate\Support\ServiceProvider;

class TextareaServiceProvider extends ServiceProvider
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

        $this->app->alias(TextareaerContract::class, 'form-maker.textarea');
    }
}