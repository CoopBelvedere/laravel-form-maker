<?php

namespace Belvedere\FormMaker\Models\Inputs\Search;

use Belvedere\FormMaker\Contracts\Inputs\Search\SearcherContract;
use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(SearcherContract::class, function ($app) {
            $searcher = $app->config->get('form-maker.nodes.inputs.search', new Searcher());
            if (is_string($searcher)) {
                return new $searcher();
            }
            return $searcher;
        });

        $this->app->alias(SearcherContract::class, 'form-maker.search');
    }
}