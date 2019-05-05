<?php

namespace Belvedere\FormMaker\Contracts\Ranking;

interface RankerContract
{
    /**
     * Add an element in the rankings.
     * Return the rank of the new element.
     *
     * @param mixed $element
     * @return int
     * @throws \Exception
     */
    public function add($element): int;

    /**
     * Move the element first in the ranking.
     *
     * @return int
     * @throws \Exception
     */
    public function ahead(): int;

    /**
     * Move the element one rank down.
     * Return the new rank of the downgraded element.
     *
     * @return int
     * @throws \Exception
     */
    public function down(): int;

    /**
     * Get the model ranking.
     *
     * @return mixed
     */
    public function getEloquentRelation();

    /**
     * Check that the element is in the ranking.
     *
     * @param mixed $element
     * @return bool
     */
    public function inRanking($element): bool;

    /**
     * Move the element last in the ranking.
     * Return the rank of the last element.
     *
     * @return int
     * @throws \Exception
     */
    public function last(): int;

    /**
     * Set the element id that is to reorder.
     *
     * @param  mixed $element
     * @return self
     * @throws \Exception
     */
    public function move($element);

    /**
     * Return the rank of the element in the ranking.
     *
     * @param  mixed $element
     * @return int
     */
    public function rank($element): int;

    /**
     * Remove an item in the ranking.
     *
     * @param  mixed $element
     * @return bool
     */
    public function remove($element): bool;

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
     * Toggle two elements in the ranking.
     * Return the new rank of the first element.
     *
     * @param  mixed $firstElement
     * @param  mixed $lastElement
     * @return int
     */
    public function toggle($firstElement, $lastElement): int;

    /**
     * Move the element to a specific index.
     * Return the new index of the element.
     *
     * @param  int $index
     * @return int
     * @throws \Exception
     */
    public function toIndex(int $index): int;

    /**
     * Move the element to a specific rank.
     * Return the new rank of the element.
     *
     * @param  int $rank
     * @return int
     * @throws \Exception
     */
    public function toRank(int $rank): int;

    /**
     * Move the element one rank up.
     * Return the rank of the upgraded element.
     *
     * @return int
     * @throws \Exception
     */
    public function up(): int;
}