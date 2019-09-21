<?php

namespace Belvedere\FormMaker\Contracts\Rankings;

use Illuminate\Database\Eloquent\Relations\MorphOne;

interface RankerContract
{
    /**
     * Add an node in the rankings.
     * Return the rank of the new node.
     *
     * @param mixed $node
     * @return int
     * @throws \Exception
     */
    public function add($node): int;

    /**
     * Move the node after another node in the ranking.
     *
     * @param mixed $afterNode
     * @return int
     * @throws \Exception
     */
    public function after($afterNode): int;

    /**
     * Move the node first in the ranking.
     *
     * @return int
     * @throws \Exception
     */
    public function ahead(): int;

    /**
     * Move the node before another node in the ranking.
     *
     * @param mixed $beforeNode
     * @return int
     * @throws \Exception
     */
    public function before($beforeNode): int;

    /**
     * Move the node one rank down.
     * Return the new rank of the downgraded node.
     *
     * @return int
     * @throws \Exception
     */
    public function down(): int;

    /**
     * Get the model eloquent relation to the ranking.
     *
     * @param mixed $rankable
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function getEloquentRelation($rankable): MorphOne;

    /**
     * Check that the node is in the ranking.
     *
     * @param mixed $node
     * @return bool
     */
    public function inRanking($node): bool;

    /**
     * Move the node last in the ranking.
     * Return the rank of the last node.
     *
     * @return int
     * @throws \Exception
     */
    public function last(): int;

    /**
     * Set the node id that is to reorder.
     *
     * @param  mixed $node
     * @return self
     * @throws \Exception
     */
    public function move($node): RankerContract;

    /**
     * Return the rank of the node in the ranking.
     *
     * @param  mixed $node
     * @return int
     */
    public function rank($node): int;

    /**
     * Remove an item in the ranking.
     *
     * @param  mixed $node
     * @return bool
     */
    public function remove($node): bool;

    /**
     * Reverse the ranks in the ranking.
     *
     * @return void
     */
    public function reverse(): void;

    /**
     * Shuffle the ranks in the ranking.
     *
     * @return void
     */
    public function shuffle(): void;

    /**
     * Order the list according to the items position in the ranking.
     *
     * @param \Illuminate\Support\Collection|\Illuminate\Support\LazyCollection $nodes
     * @return \Illuminate\Support\Collection|\Illuminate\Support\LazyCollection
     */
    public function sortByRank($nodes);

    /**
     * Toggle two nodes in the ranking.
     * Return the new rank of the first node.
     *
     * @param  \Illuminate\Database\Eloquent\Model $firstNode
     * @param  \Illuminate\Database\Eloquent\Model $lastNode
     * @return int
     */
    public function toggle($firstNode, $lastNode): int;

    /**
     * Move the node to a specific index.
     * Return the new index of the node.
     *
     * @param  int $index
     * @return int
     * @throws \Exception
     */
    public function toIndex(int $index): int;

    /**
     * Move the node to a specific rank.
     * Return the new rank of the node.
     *
     * @param  int $rank
     * @return int
     * @throws \Exception
     */
    public function toRank(int $rank): int;

    /**
     * Move the node one rank up.
     * Return the rank of the upgraded node.
     *
     * @return int
     * @throws \Exception
     */
    public function up(): int;
}