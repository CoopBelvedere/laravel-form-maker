<?php

namespace Belvedere\FormMaker\Traits\Nodes;

use Belvedere\FormMaker\Contracts\HtmlElements\ElementContract;
use Illuminate\Support\Collection;

trait HasHtmlElements
{
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
        return $this->getNodes('html_elements', $type);
    }
}