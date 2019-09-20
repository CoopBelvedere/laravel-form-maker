<?php

namespace Belvedere\FormMaker\Models\Rankings;

use Belvedere\FormMaker\Contracts\Rankings\RankerContract;
use Illuminate\{Database\Eloquent\Model as Eloquent,
    Database\Eloquent\Relations\MorphMany,
    Database\Eloquent\Relations\MorphOne,
    Support\Collection,
    Support\Facades\Log};

class Ranker extends Eloquent implements RankerContract
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'ranks' => 'array',
    ];

    /**
     * The current node id to reorder.
     *
     * @var mixed
     */
    protected $nodeId;

    /**
     * Ranker constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('form-maker.database.rankings_table', 'rankings');

        $this->ranks = []; // set default value
    }

    /**
     * Set the ranks.
     *
     * @param  array $ranks
     * @return void
     */
    public function setRanksAttribute(array $ranks): void
    {
        $this->attributes['ranks'] = json_encode($ranks);
    }

    // RANKS METHODS
    // ==============================================================

    /**
     * Add an node in the rankings.
     * Return the rank of the new node.
     *
     * @param mixed $node
     * @return int
     * @throws \Exception
     */
    public function add($node): int
    {
        $rank = $this->rank($node);

        if ($rank === -1) {
            $ranks = $this->ranks;
            $ranks[] = $this->getNodeId($node);
            $this->commit($ranks);

            return count($ranks);
        }

        return $rank;
    }

    /**
     * Move the node after another node in the ranking.
     * 
     * @param mixed $afterNode
     * @return int
     * @throws \Exception
     */
    public function after($afterNode): int 
    {
        $rank = $this->rank($afterNode);

        if ($rank > -1) {
            $rank = $this->toRank($rank + 1);
        }

        return $rank;
    }

    /**
     * Move the node first in the ranking.
     *
     * @return int
     * @throws \Exception
     */
    public function ahead(): int
    {
        if ($this->hasNodeId()) {
            if ($this->nodeId !== head($this->ranks)) {
                $ranks = $this->ranks;
                $ranks = array_diff($ranks, [$this->nodeId]);
                $this->commit(array_merge([$this->nodeId], $ranks));
            }

            return 1;
        }
    }

    /**
     * Move the node before another node in the ranking.
     *
     * @param mixed $beforeNode
     * @return int
     * @throws \Exception
     */
    public function before($beforeNode): int
    {
        $rank = $this->rank($beforeNode);

        if ($rank > -1) {
            $rank = $this->toRank($rank - 1);
        }

        return $rank;
    }
    
    /**
     * Save the ranks list in the ranking.
     *
     * @param array $ranks
     * @return void
     */
    protected function commit(array $ranks): void
    {
        $this->ranks = $ranks;

        $this->save();
    }

    /**
     * Move the node one rank down.
     * Return the new rank of the downgraded node.
     *
     * @return int
     * @throws \Exception
     */
    public function down(): int
    {
        if ($this->hasNodeId()) {
            if ($this->nodeId !== last($this->ranks)) {
                $key = array_search($this->nodeId, $this->ranks);
                return $this->toggle($this->nodeId, $this->ranks[$key + 1]);
            }

            return count($this->ranks);
        }
    }

    /**
     * Get the model eloquent relation to the ranking.
     *
     * @param mixed $rankable
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function getEloquentRelation($rankable): MorphOne
    {
        return $rankable->morphOne($this, 'rankable');
    }

    /**
     * Get the ranking primary key from the node.
     *
     * @param mixed $node
     * @return mixed
     */
    protected function getNodeId($node)
    {
        if (is_object($node) && method_exists($node, 'getKey')) {
            return $node->getKey();
        }

        return $node;
    }

    /**
     * Check that the nodeId attribute is set.
     *
     * @return bool
     * @throws \Exception
     */
    protected function hasNodeId(): bool
    {
        if ($this->nodeId) {
            return true;
        }

        throw new \Exception('You must set the node with the move method before using this function. See documentation.');
    }

    /**
     * Check that the node is in the ranking.
     *
     * @param mixed $node
     * @return bool
     */
    public function inRanking($node): bool
    {
        $elementId = $this->getNodeId($node);

        return in_array($elementId, $this->ranks);
    }

    /**
     * Move the node last in the ranking.
     * Return the rank of the last node.
     *
     * @return int
     * @throws \Exception
     */
    public function last(): int
    {
        if ($this->hasNodeId()) {
            if ($this->nodeId !== last($this->ranks)) {
                $ranks = $this->ranks;
                $ranks = array_diff($ranks, [$this->nodeId]);
                $this->commit(array_merge($ranks, [$this->nodeId]));
            }

            return count($this->ranks);
        }
    }

    /**
     * Set the node id that is to reorder.
     *
     * @param  mixed $node
     * @return self
     * @throws \Exception
     */
    public function move($node): RankerContract
    {
        if ($this->inRanking($node)) {
            $this->setNodeId($node);

            return $this;
        }

        throw new \Exception('The node is not in the rankings.');
    }

    /**
     * Move the node to a specific index.
     * Return the new index of the node.
     *
     * @param  int $index
     * @return int
     * @throws \Exception
     */
    protected function moveTo(int $index): int
    {
        if ($this->hasNodeId()) {
            $ranks = $this->ranks;
            $ranks = array_diff($ranks, [$this->nodeId]);
            array_splice($ranks, $index, 0, $this->nodeId);
            $this->commit($ranks);

            return $index;
        }
    }

    /**
     * Return the rank of the node in the ranking.
     *
     * @param  mixed $node
     * @return int
     */
    public function rank($node): int
    {
        if ($this->inRanking($node)) {
            return array_search($this->getNodeId($node), $this->ranks) + 1;
        }

        return -1;
    }

    /**
     * Remove an item in the ranking.
     *
     * @param  mixed $node
     * @return bool
     */
    public function remove($node): bool
    {
        if ($this->inRanking($node)) {
            $ranks = $this->ranks;
            $this->commit(
                array_values(
                    array_diff($ranks, [$this->getNodeId($node)])
                )
            );
        }

        return true;
    }

    /**
     * Reverse the ranks in the ranking.
     *
     * @return void
     */
    public function reverse(): void
    {
        $ranks = $this->ranks;

        $this->commit(array_values(collect($ranks)->reverse()->all()));
    }

    /**
     * Set the node id that is to reorder.
     *
     * @param mixed $node
     * @return void
     * @throws \Exception
     */
    protected function setNodeId($node): void
    {
        $elementId = $this->getNodeId($node);

        $this->nodeId = $elementId;
    }

    /**
     * Shuffle the ranks in the ranking.
     *
     * @return void
     */
    public function shuffle(): void
    {
        $ranks = $this->ranks;

        $this->commit(collect($ranks)->shuffle()->all());
    }

    /**
     * Order the list according to the items position in the ranking.
     *
     * @param Collection $nodes
     * @return Collection
     */
    public function sortByRank(Collection $nodes): Collection
    {
        if (count($nodes) === count($this->ranks)) {
            $sortedList = array_pad([], count($nodes), false);

            foreach ($nodes as $node)
            {
                $sortedList[array_search($this->getNodeId($node), $this->ranks)] = $node;
            }

            return collect($sortedList);
        }

        Log::warning('The number of items in the collection and the number of ids stored in ranking don\'t match for ranking id : ' . $this->getKey());

        return $nodes;
    }

    /**
     * Toggle two nodes in the ranking.
     * Return the new rank of the first node.
     *
     * @param  \Illuminate\Database\Eloquent\Model $firstNode
     * @param  \Illuminate\Database\Eloquent\Model $lastNode
     * @return int
     */
    public function toggle($firstNode, $lastNode): int
    {
        $firstNode = $this->getNodeId($firstNode);
        $lastNode = $this->getNodeId($lastNode);

        if ($firstNode !== $lastNode && $this->inRanking($firstNode) && $this->inRanking($lastNode)) {
            $firstKey = array_search($firstNode, $this->ranks);
            $lastKey = array_search($lastNode, $this->ranks);
            $ranks = $this->ranks;
            [$ranks[$firstKey], $ranks[$lastKey]] = [$ranks[$lastKey], $ranks[$firstKey]];
            $this->commit($ranks);
        }

        return $this->rank($firstNode);
    }

    /**
     * Move the node to a specific index.
     * Return the new index of the node.
     *
     * @param  int $index
     * @return int
     * @throws \Exception
     */
    public function toIndex(int $index): int
    {
        if ($index < 0) {
            $index = 0;
        }

        if ($index >= count($this->ranks)) {
            $index = count($this->ranks) - 1;
        }

        return $this->moveTo($index);
    }

    /**
     * Move the node to a specific rank.
     * Return the new rank of the node.
     *
     * @param  int $rank
     * @return int
     * @throws \Exception
     */
    public function toRank(int $rank): int
    {
        if ($rank < 1) {
            $rank = 1;
        }

        if ($rank > count($this->ranks)) {
            $rank = count($this->ranks);
        }

        $this->moveTo($rank - 1);

        return $rank;
    }

    /**
     * Move the node one rank up.
     * Return the rank of the upgraded node.
     *
     * @return int
     * @throws \Exception
     */
    public function up(): int
    {
        if ($this->hasNodeId()) {
            if ($this->rank($this->nodeId) > 1) {
                $key = array_search($this->nodeId, $this->ranks);
                return $this->toggle($this->nodeId, $this->ranks[$key - 1]);
            }

            return 1;
        }
    }
}
