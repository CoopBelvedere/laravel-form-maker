<?php

namespace Belvedere\FormMaker\Contracts\Repositories;

use Belvedere\FormMaker\Models\{
    Model,
    Nodes\Node,
};
use Illuminate\Support\Collection;

interface NodeRepositoryContract
{
    /**
     * Get the model nodes filtered by type or not and sorted by their position in the ranking.
     *
     * @param \Belvedere\FormMaker\Models\Model $parent
     * @param string|null $type
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function all(Model $parent, ?string $type = null): Collection;

    /**
     * Add a node to the parent model.
     *
     * @param \Belvedere\FormMaker\Models\Model $parent
     * @param string $type
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function create(Model $parent, string $type): Node;

    /**
     * Get the node with the specified key.
     *
     * @param \Belvedere\FormMaker\Models\Model $model
     * @param mixed $nodeKey
     * @param array $columns
     * @return \Belvedere\FormMaker\Models\Nodes\Node|null
     */
    public function find(Model $model, $nodeKey, array $columns): ?Node;
}