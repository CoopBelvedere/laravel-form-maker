<?php

namespace Belvedere\FormMaker\Contracts\Traits;

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
     * @return \Belvedere\FormMaker\Models\Model
     * @throws \Exception
     */
    public function add(string $type, ?string $name = null): Node;

    /**
     * Add a node after another node.
     *
     * @param string $afterNodeKey
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Model
     * @throws \Exception
     */
    public function addAfter(string $afterNodeKey, string $type, ?string $name = null): Node;

    /**
     * Add a node at a specific rank in the ranking.
     *
     * @param int $rank
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Model
     * @throws \Exception
     */
    public function addAtRank(int $rank, string $type, ?string $name = null): Node;

    /**
     * Add a node before another node.
     *
     * @param string $beforeNodeKey
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Model
     * @throws \Exception
     */
    public function addBefore(string $beforeNodeKey, string $type, ?string $name = null): Node;

    /**
     * Get the node with the specified key.
     *
     * @param string $nodeKey
     * @return mixed
     */
    public function getNode(string $nodeKey): Node;

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