<?php

namespace Belvedere\FormMaker\Traits\Nodes;

use Belvedere\FormMaker\Models\Nodes\Node;
use Belvedere\FormMaker\Repositories\NodeRepository;

trait HasInputs
{
    /**
     * Add a node to the parent model.
     *
     * @param string $type
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function addInput(string $type): Node
    {
        // TODO: add a validation to make sure type is for input component
        $repository = new NodeRepository();

        $node = $repository->create($this, $type);

        $this->addInRanking($node);

        return $node;
    }
}