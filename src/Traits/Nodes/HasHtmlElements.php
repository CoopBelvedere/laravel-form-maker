<?php

namespace Belvedere\FormMaker\Traits\Nodes;

use Belvedere\FormMaker\Contracts\HtmlElements\ElementContract;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

trait HasHtmlElements
{
    /**
     * Get the model elements.
     *
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    protected function getAllHtmlElements(): Collection
    {
        $elements = collect([]);

        foreach (DB::table(config('form-maker.database.html_elements_table', 'html_elements'))
                     ->select('type')
                     ->distinct()
                     ->cursor() as $element)
        {
            $subset = $this->nodesQueryBuilder($element->type)->get();
            $elements = $elements->merge($subset);
        }

        return $elements;
    }

    /**
     * Get the element with the specified type property.
     * Alias of getNode
     *
     * @param string $type
     * @return \Belvedere\FormMaker\Contracts\HtmlElements\ElementContract|null
     * @throws \Exception
     */
    public function getHtmlElement(string $type): ?ElementContract
    {
        return $this->getNode($type);
    }

    /**
     * Get the model html elements sorted by their position in the ranking.
     *
     * @param string|null $type
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function htmlElements(?string $type = null): Collection
    {
        if (is_null($type)) {
            $elements = $this->getAllHtmlElements();
        } else {
            $elements = $this->nodesQueryBuilder($type)->get();
        }

        return $this->ranking->sort($elements);
    }
}