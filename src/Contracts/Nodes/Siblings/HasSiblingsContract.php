<?php

namespace Belvedere\FormMaker\Contracts\Nodes\Siblings;

use Belvedere\FormMaker\{
    Contracts\Rankings\HasRankingsContract,
    Models\Nodes\Siblings\Sibling
};
use Illuminate\Support\LazyCollection;

interface HasSiblingsContract extends HasRankingsContract
{
    /**
     * Add a sibling to the parent model.
     *
     * @param string $type
     * @param string|null $text
     * @return \Belvedere\FormMaker\Models\Nodes\Siblings\Sibling|null
     */
    public function addSibling(string $type, ?string $text = null): ?Sibling;

    /**
     * Get the sibling with the specified id.
     *
     * @param mixed $id
     * @return \Belvedere\FormMaker\Models\Nodes\Siblings\Sibling|null
     */
    public function sibling($id): ?Sibling;

    /**
     * Get the siblings filtered by type or not and sorted by their position in the ranking.
     *
     * @param string|null $type
     * @return \Illuminate\Support\LazyCollection|null
     */
    public function siblings(?string $type = null): ?LazyCollection;
}