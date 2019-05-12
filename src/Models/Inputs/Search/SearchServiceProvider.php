<?php

namespace Belvedere\FormMaker\Models\Inputs\Search;

use Belvedere\FormMaker\Contracts\Inputs\Search\SearcherContract;

class SearchServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(SearcherContract::class, function ($app) {
            return $app->config->get('form-maker.nodes.inputs.search', new Searcher());
        });

        $this->app->alias(SearcherContract::class, 'form-maker.search');
    }
}