<?php

namespace Belvedere\FormMaker\Contracts\Repositories;

use Belvedere\FormMaker\Models\Model;
use Belvedere\FormMaker\Models\Nodes\Node;

interface NodeRepositoryContract
{
    /**
     * Add a node to the parent model.
     *
     * @param \Belvedere\FormMaker\Models\Model $parent
     * @param string $type
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function create(Model $parent, string $type): Node;
}