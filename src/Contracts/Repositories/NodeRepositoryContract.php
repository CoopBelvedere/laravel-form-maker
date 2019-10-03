<?php

namespace Belvedere\FormMaker\Contracts\Repositories;

use Illuminate\Support\Collection;
use Belvedere\FormMaker\Models\Model;
use Belvedere\FormMaker\Models\Nodes\Node;

interface NodeRepositoryContract
{
    /**
     * Get the model nodes filtered by type or not.
     *
     * @param \Belvedere\FormMaker\Models\Model $parent
     * @param string|null $type
     * @return \Illuminate\Support\Collection
     */
    public function all(Model $parent, ?string $type = null): Collection;

    /**
     * Add a node to the parent model.
     *
     * @param \Belvedere\FormMaker\Models\Model $parent
     * @param string $type
     * @param array $attributes
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     */
    public function create(Model $parent, string $type, array $attributes = []): Node;

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
}
