<?php

namespace Belvedere\FormMaker\Contracts\Repositories;

use Belvedere\FormMaker\Models\{
    Model,
    Nodes\Node,
};
use Illuminate\Support\LazyCollection;

interface NodeRepositoryContract
{
    /**
     * Get the model nodes filtered by type or not.
     *
     * @param \Belvedere\FormMaker\Models\Model $parent
     * @param string|null $type
     * @return \Illuminate\Support\LazyCollection
     */
    public function all(Model $parent, ?string $type = null): LazyCollection;

    /**
     * Add a node to the parent model.
     *
     * @param \Belvedere\FormMaker\Models\Model $parent
     * @param string $type
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     */
    public function create(Model $parent, string $type): Node;

    /**
     * Get the node with the specified key.
     *
     * @param \Belvedere\FormMaker\Models\Model $parent
     * @param mixed $nodeKey
     * @param array $columns
     * @return \Belvedere\FormMaker\Models\Nodes\Node|null
     */
    public function find(Model $parent, $nodeKey, array $columns): ?Node;
}