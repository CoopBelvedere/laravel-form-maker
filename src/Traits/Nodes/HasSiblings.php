<?php

namespace Belvedere\FormMaker\Traits\Nodes;

use Belvedere\FormMaker\{
    Contracts\Repositories\NodeRepositoryContract,
    Models\Nodes\Siblings\Sibling
};
use Illuminate\Support\LazyCollection;

trait HasSiblings
{
    /**
     * Add a sibling to the parent model.
     *
     * @param string $type
     * @param string|null $text
     * @return \Belvedere\FormMaker\Models\Nodes\Siblings\Sibling|null
     */
    public function addSibling(string $type, ?string $text = null): ?Sibling
    {
        if (!array_key_exists($type, config('form-maker.nodes.siblings'))) {
            return null;
        }

        $nodeRepository = resolve(NodeRepositoryContract::class);

        $sibling = $nodeRepository->create($this, $type);

        if ($text) {
            $sibling->withText($text)->save();
        }

        $this->addInRanking($sibling);

        return $sibling;
    }

    /**
     * Get the sibling with the specified id.
     *
     * @param mixed $id
     * @return \Belvedere\FormMaker\Models\Nodes\Siblings\Sibling|null
     */
    public function sibling($id): ?Sibling
    {
        $nodeRepository = resolve(NodeRepositoryContract::class);

        $sibling = $nodeRepository->find($this, $id, ['id']);

        return array_key_exists($sibling->type, config('form-maker.nodes.siblings'))
            ? $sibling : null;
    }

    /**
     * Get the siblings filtered by type or not and sorted by their position in the ranking.
     *
     * @param string|null $type
     * @return \Illuminate\Support\LazyCollection
     */
    public function siblings(?string $type = null): LazyCollection
    {
        $nodeRepository = resolve(NodeRepositoryContract::class);

        $siblings = $nodeRepository->all($this, $type);

        if ($siblings->isEmpty()) {
            return $siblings;
        }

        return $this->ranking->sortByRank($siblings);
    }
}
