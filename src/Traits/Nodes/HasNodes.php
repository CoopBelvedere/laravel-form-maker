<?php

namespace Belvedere\FormMaker\Traits\Nodes;

use Belvedere\FormMaker\Contracts\Repositories\NodeRepositoryContract;
use Belvedere\FormMaker\Models\Nodes\Node;

trait HasNodes
{
    /**
     * Add a node to the parent model.
     *
     * @param string $type
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function add(string $type): Node
    {
        $nodeRepository = resolve(NodeRepositoryContract::class);

        $node = $nodeRepository->create($this, $type);

        $this->addInRanking($node);

        return $node;
    }
}