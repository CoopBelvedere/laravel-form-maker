<?php

namespace Belvedere\FormMaker\Models;

use Belvedere\FormMaker\Contracts\Nodes\WithNodesContract;
use Belvedere\FormMaker\Contracts\Rankings\HasRankingsContract;
use Belvedere\FormMaker\Listeners\DeleteRelatedModels;
use Belvedere\FormMaker\Traits\HasRankings;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

abstract class ModelWithNodes extends Model implements HasRankingsContract, WithNodesContract
{
    use HasRankings;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'deleting' => DeleteRelatedModels::class,
    ];

    /**
     * Add a node to the parent model.
     *
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Model
     * @throws \Exception
     */
    public function add(string $type, ?string $name = null): Model
    {
        $node = $this->resolve($type);

        $node->type = $type;

        if ($name) {
            $node->withHtmlAttributes(['name' => $name]);
        }

        $this->nodesQueryBuilder($type)->save($node);

        $this->addInRanking($node);

        return $node;
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
    public function addAfter(string $afterNodeKey, string $type, ?string $name = null): Model
    {
        $node = $this->add($type, $name);

        $afterNode = $this->getNode($afterNodeKey);

        if ($afterNode && $this->ranking->inRanking($afterNode)) {
            $this->ranking->move($node)->toRank($afterNode->rank + 1);
        }

        return $node;
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
    public function addAtRank(int $rank, string $type, ?string $name = null): Model
    {
        $node = $this->add($type, $name);

        $this->ranking->move($node)->toRank($rank);

        return $node;
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
    public function addBefore(string $beforeNodeKey, string $type, ?string $name = null): Model
    {
        $node = $this->add($type, $name);

        $beforeNode = $this->getNode($beforeNodeKey);

        if ($beforeNode && $this->ranking->inRanking($beforeNode)) {
            $this->ranking->move($node)->toRank($beforeNode->rank - 1);
        }

        return $node;
    }

    /**
     * Get all the model nodes.
     *
     * @param string $table
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    protected function getAllNodes(string $table): Collection
    {
        $nodes = collect([]);

        foreach (DB::table(config(sprintf('form-maker.database.%s_table', $table), $table))
                     ->select('type')
                     ->distinct()
                     ->cursor() as $element)
        {
            $subset = $this->nodesQueryBuilder($element->type)->get();
            $nodes = $nodes->merge($subset);
        }

        return $nodes;
    }

    /**
     * Get the node with the specified key.
     *
     * @param string $nodeKey
     * @return mixed
     */
    abstract protected function getNode(string $nodeKey);

    /**
     * Get the model nodes filtered by type or not and sorted by their position in the ranking.
     *
     * @param string $table
     * @param string|null $type
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    protected function getNodes(string $table, ?string $type = null): Collection
    {
        if (is_null($type)) {
            $nodes = $this->getAllNodes($table);
        } else {
            $nodes = $this->nodesQueryBuilder($type)->get();
        }

        return $this->ranking->sortByRank($nodes);
    }

    /**
     * Get the model nodes query builder.
     *
     * @param mixed $node
     * @return mixed
     */
    abstract protected function nodesQueryBuilder($node);

    /**
     * Resolve the node out of the service container.
     *
     * @param string $node
     * @return \Belvedere\FormMaker\Models\Model
     */
    protected function resolve(string $node): Model
    {
        return resolve(sprintf('form-maker.%s', $node));
    }
}