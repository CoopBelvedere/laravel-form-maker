<?php

namespace Belvedere\FormMaker\Traits\Nodes;

use Belvedere\FormMaker\Models\Nodes\Node;
use Belvedere\FormMaker\Contracts\Repositories\NodeRepositoryContract;
use Illuminate\Support\LazyCollection;

trait HasNodes
{
    /**
     * Add a node to the parent model.
     *
     * @param string $type
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function add(string $type): Node
    {
        $nodeRepository = resolve(NodeRepositoryContract::class);

        $node = $nodeRepository->create($this, $type);

        $this->addInRanking($node);

        return $node;
    }

    /**
     * Add a node after another node.
     *
     * @param mixed $afterNodeKey
     * @param string $type
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function addAfter($afterNodeKey, string $type): Node
    {
        $node = $this->add($type);

        $afterNode = $this->node($afterNodeKey);

        if ($afterNode) {
            $this->ranking->move($node)->after($afterNode);
        }

        return $node;
    }

    /**
     * Add a node at a specific rank in the ranking.
     *
     * @param int $rank
     * @param string $type
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function addAtRank(int $rank, string $type): Node
    {
        $node = $this->add($type);

        $this->ranking->move($node)->toRank($rank);

        return $node;
    }

    /**
     * Add a node before another node.
     *
     * @param mixed $beforeNodeKey
     * @param string $type
     * @return \Belvedere\FormMaker\Models\Nodes\Node
     * @throws \Exception
     */
    public function addBefore($beforeNodeKey, string $type): Node
    {
        $node = $this->add($type);

        $beforeNode = $this->node($beforeNodeKey);

        if ($beforeNode) {
            $this->ranking->move($node)->before($beforeNode);
        }

        return $node;
    }

    /**
     * Get the node with the specified key.
     *
     * @param mixed $key
     * @return \Belvedere\FormMaker\Models\Nodes\Node|null
     */
    public function node($key): ?Node
    {
        $nodeRepository = resolve(NodeRepositoryContract::class);

        return $nodeRepository->find($this, $key, ['id', 'name', 'value']);
    }

    /**
     * Get the nodes filtered by type or not and sorted by their position in the ranking.
     *
     * @param string|null $type
     * @return \Illuminate\Support\LazyCollection
     */
    public function nodes(?string $type = null): LazyCollection
    {
        $nodeRepository = resolve(NodeRepositoryContract::class);

        $nodes = $nodeRepository->all($this, $type);

        if ($nodes->isEmpty()) {
            return $nodes;
        }

        return $this->ranking->sortByRank($nodes);
    }
}
