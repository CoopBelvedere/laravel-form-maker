<?php

namespace Belvedere\FormMaker\Contracts\Nodes;

use Belvedere\FormMaker\Contracts\Siblings\SiblingContract;
use Illuminate\Support\Collection;

interface HasSiblingsContract extends WithNodesContract
{
    /**
     * Get the sibling with the specified type property.
     * Alias of getNode
     *
     * @param string $type
     * @return \Belvedere\FormMaker\Contracts\Siblings\SiblingContract|null
     * @throws \Exception
     */
    public function getSibling(string $type): ?SiblingContract;

    /**
     * Get the model siblings sorted by their position in the ranking.
     * Alias of getNodes
     *
     * @param string|null $type
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function siblings(?string $type = null): Collection;
}