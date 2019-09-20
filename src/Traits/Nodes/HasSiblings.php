<?php

namespace Belvedere\FormMaker\Traits\Nodes;

use Belvedere\FormMaker\{
    Contracts\Repositories\NodeRepositoryContract,
    Models\Nodes\Siblings\Sibling
};

trait HasSiblings
{
    /**
     * Add a node to the parent model.
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
}
