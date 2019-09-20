<?php

namespace Belvedere\FormMaker\Contracts\Nodes\Siblings;

use Belvedere\FormMaker\{
    Contracts\Rankings\HasRankingsContract,
    Models\Nodes\Siblings\Sibling
};

interface HasSiblingsContract extends HasRankingsContract
{
    /**
     * Add a node to the parent model.
     *
     * @param string $type
     * @param string|null $text
     * @return \Belvedere\FormMaker\Models\Nodes\Siblings\Sibling|null
     */
    public function addSibling(string $type, ?string $text = null): ?Sibling;
}