<?php

namespace Belvedere\FormMaker\Contracts\Nodes;

use Belvedere\FormMaker\Contracts\Rankings\HasRankingsContract;
use Belvedere\FormMaker\Models\Nodes\Node;
use Illuminate\Support\Collection;

interface HasNodesContract extends HasRankingsContract
{
    /**
     * Add a node to the parent model.
     *
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function add(string $type, ?string $name = null): Node;

    /**
     * Add a node after another node.
     *
     * @param mixed $afterNodeId
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function addAfter($afterNodeId, string $type, ?string $name = null): Node;

    /**
     * Add a node at a specific rank in the ranking.
     *
     * @param int $rank
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function addAtRank(int $rank, string $type, ?string $name = null): Node;

    /**
     * Add a node before another node.
     *
     * @param mixed $beforeNodeId
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function addBefore($beforeNodeId, string $type, ?string $name = null): Node;

    /**
     * Get the node with the specified key.
     *
     * @param mixed $id
     * @return mixed
     */
    public function getNode($id): Node;

    /**
     * Get the model nodes filtered by type or not and sorted by their position in the ranking.
     *
     * @param string $table
     * @param string|null $type
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function getNodes(string $table, ?string $type = null): Collection;
}