<?php

namespace Belvedere\FormMaker\Traits\Nodes;

use Belvedere\FormMaker\Contracts\Repositories\NodeRepositoryContract;
use Belvedere\FormMaker\Models\Nodes\Node;

trait HasSiblings
{
    /**
     * Add a node to the parent model.
     *
     * @param string $type
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function addSibling(string $type): Node
    {
        // TODO: add a validation to make sure type is for sibling component
        $nodeRepository = resolve(NodeRepositoryContract::class);

        $node = $nodeRepository->create($this, $type);

        $this->addInRanking($node);

        return $node;
    }
}