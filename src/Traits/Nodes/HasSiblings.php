<?php

namespace Belvedere\FormMaker\Traits\Nodes;

use Belvedere\FormMaker\Contracts\Siblings\SiblingContract;
use Illuminate\Support\Collection;

trait HasSiblings
{
    /**
     * Get the sibling with the specified type property.
     * Alias of getNode
     *
     * @param string $type
     * @return \Belvedere\FormMaker\Contracts\Siblings\SiblingContract|null
     * @throws \Exception
     */
    public function getSibling(string $type): ?SiblingContract
    {
        return $this->getNode($type);
    }

    /**
     * Get the model siblings sorted by their position in the ranking.
     * Alias of getNodes
     *
     * @param string|null $type
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function siblings(?string $type = null): Collection
    {
        return $this->getNodes('siblings', $type);
    }
}