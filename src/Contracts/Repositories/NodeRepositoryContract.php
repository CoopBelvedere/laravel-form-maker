<?php

namespace Belvedere\FormMaker\Contracts\Repositories;

use Belvedere\FormMaker\Models\Model;
use Illuminate\Support\LazyCollection;
use Belvedere\FormMaker\Models\Nodes\Node;

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
     * Delete all nodes of the parent model.
     *
     * @param \Belvedere\FormMaker\Models\Model $parent
     * @return mixed
     */
    public function delete(Model $parent);

    /**
     * Get the node with the specified key.
     *
     * @param \Belvedere\FormMaker\Models\Model $parent
     * @param mixed $nodeKey
     * @param array $columns
     * @return \Belvedere\FormMaker\Models\Nodes\Node|null
     */
    public function find(Model $parent, $nodeKey, array $columns): ?Node;

    /**
     * Get the first node in list.
     *
     * @param \Belvedere\FormMaker\Models\Model $parent
     * @param string|null $type
     * @return \Belvedere\FormMaker\Models\Nodes\Node|null
     */
    public function first(Model $parent, ?string $type = null): ?Node;

    /**
     * Get a new instance of a node model.
     *
     * @param \Belvedere\FormMaker\Models\Model $parent
     * @param string $type
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     */
    public function getInstanceOf(Model $parent, string $type): Node;
}
