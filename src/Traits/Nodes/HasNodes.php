<?php

namespace Belvedere\FormMaker\Traits\Nodes;

use Belvedere\FormMaker\Models\Nodes\Node;
use Illuminate\Support\Collection;

trait HasNodes
{
    /**
     * Add a node to the parent model.
     *
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Model
     * @throws \Exception
     */
    public function add(string $type, ?string $name = null): Node
    {
        return new Node();
    }

    /**
     * Add a node after another node.
     *
     * @param string $afterNodeKey
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Model
     * @throws \Exception
     */
    public function addAfter(string $afterNodeKey, string $type, ?string $name = null): Node
    {
        return new Node();
    }

    /**
     * Add a node at a specific rank in the ranking.
     *
     * @param int $rank
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Model
     * @throws \Exception
     */
    public function addAtRank(int $rank, string $type, ?string $name = null): Node
    {
        return new Node();
    }

    /**
     * Add a node before another node.
     *
     * @param string $beforeNodeKey
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Model
     * @throws \Exception
     */
    public function addBefore(string $beforeNodeKey, string $type, ?string $name = null): Node
    {
        return new Node();
    }

    /**
     * Get the node with the specified key.
     *
     * @param string $nodeKey
     * @return mixed
     */
    public function getNode(string $nodeKey): Node
    {
        return new Node();
    }

    /**
     * Get the model nodes filtered by type or not and sorted by their position in the ranking.
     *
     * @param string $table
     * @param string|null $type
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function getNodes(string $table, ?string $type = null): Collection
    {
        $nodes = $this->with('nodable')->get();

        dd($nodes);
//        if (is_null($type)) {
//            $nodes = $this->nodesQueryBuilder($type)->get();
//        }
//
//        if ($nodes->isEmpty()) {
//            return $nodes;
//        }
//
//        return $this->getRanking($table)->sortByRank($nodes);
    }
}