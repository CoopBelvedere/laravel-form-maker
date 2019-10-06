<?php

namespace Belvedere\FormMaker\Contracts\Traits\Nodes;

use Illuminate\Support\LazyCollection;
use Belvedere\FormMaker\Models\Nodes\Node;
use Belvedere\FormMaker\Contracts\Traits\Rankings\HasRankingsContract;

interface HasNodesContract extends HasRankingsContract
{
    /**
     * Add a node to the parent model.
     *
     * @param string $type
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function add(string $type): Node;

    /**
     * Add a node after another node.
     *
     * @param mixed $afterNodeKey
     * @param string $type
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function addAfter($afterNodeKey, string $type): Node;

    /**
     * Add a node at a specific rank in the ranking.
     *
     * @param int $rank
     * @param string $type
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function addAtRank(int $rank, string $type): Node;

    /**
     * Add a node before another node.
     *
     * @param mixed $beforeNodeKey
     * @param string $type
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function addBefore($beforeNodeKey, string $type): Node;

    /**
     * Get the node with the specified key.
     *
     * @param mixed $key
     * @return \Belvedere\FormMaker\Models\Nodes\Node|null
     */
    public function node($key): ?Node;

    /**
     * Get the nodes filtered by type or not and sorted by their position in the ranking.
     *
     * @param string|null $type
     * @return \Illuminate\Support\LazyCollection
     */
    public function nodes(?string $type = null): LazyCollection;
}
