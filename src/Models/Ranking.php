<?php

namespace Chess\FormMaker\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Ranking extends Eloquent
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rankings';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'ranks' => 'array',
    ];

    /**
     * The current element to reorder.
     */
    protected $element = false;

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
     * Add an element in the rankings.
     * Return the rank of the new element.
     *
     * @param  \Illuminate\Database\Eloquent\Model $element
     * @return int
     */
    public function add($element): int
    {
        $elementId = $element->getKey();

        $rank = $this->rank($elementId);

        if ($rank === -1) {
            $ranks = $this->ranks;
            $ranks[] = $elementId;
            $this->commit($ranks);

            return count($ranks);
        }

        return $rank;
    }

    /**
     * Move the element first in the ranking.
     *
     * @return int
     * @throws \Exception
     */
    public function ahead(): int
    {
        if ($this->hasElement()) {
            if ($this->element !== head($this->ranks)) {
                $ranks = $this->ranks;
                $ranks = array_diff($ranks, [$this->element]);
                $this->commit(array_merge([$this->element], $ranks));
            }

            return 1;
        }
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
     * Move the element one rank down.
     * Return the new rank of the downgraded element.
     *
     * @return int
     * @throws \Exception
     */
    public function down(): int
    {
        if ($this->hasElement()) {
            if ($this->element !== last($this->ranks)) {
                $key = array_search($this->element, $this->ranks);
                return $this->toggle($this->element, $this->ranks[$key + 1]);
            }

            return count($this->ranks);
        }
    }

    /**
     * Check that the element attribute is set.
     *
     * @return bool
     * @throws \Exception
     */
    protected function hasElement(): bool
    {
        if ($this->element) {
            return true;
        }

        throw new \Exception('You must set the element with the move method before using this function. See documentation.');
    }

    /**
     * Move the element last in the ranking.
     * Return the rank of the last element.
     *
     * @return int
     * @throws \Exception
     */
    public function last(): int
    {
        if ($this->hasElement()) {
            if ($this->element !== last($this->ranks)) {
                $ranks = $this->ranks;
                $ranks = array_diff($ranks, [$this->element]);
                $this->commit(array_merge($ranks, [$this->element]));
            }

            return count($this->ranks);
        }
    }

    /**
     * Set the element id that is to reorder.
     *
     * @param  \Illuminate\Database\Eloquent\Model $element
     * @return self
     * @throws \Exception
     */
    public function move($element): self
    {
        $elementId = $element->getKey();

        if (in_array($elementId, $this->ranks)) {
            $this->element = $elementId;
            return $this;
        }

        throw new \Exception('The element is not in the rankings.');
    }

    /**
     * Move the element to a specific index.
     * Return the new index of the element.
     *
     * @param  int $index
     * @return int
     * @throws \Exception
     */
    protected function moveTo(int $index): int
    {
        if ($this->hasElement()) {
            $ranks = $this->ranks;
            $ranks = array_diff($ranks, [$this->element]);
            array_splice($ranks, $index, 0, $this->element);
            $this->commit($ranks);

            return $index;
        }
    }

    /**
     * Return the rank of the element in the ranking.
     *
     * @param  \Illuminate\Database\Eloquent\Model $element
     * @return int
     */
    public function rank($element): int
    {
        $elementId = $element->getKey();

        if (in_array($elementId, $this->ranks)) {
            return array_search($elementId, $this->ranks) + 1;
        }

        return -1;
    }

    /**
     * Remove an item in the ranking.
     *
     * @param  \Illuminate\Database\Eloquent\Model $element
     * @return bool
     */
    public function remove($element): bool
    {
        $elementId = $element->getKey();

        if (in_array($elementId, $this->ranks)) {
            $ranks = $this->ranks;
            $this->commit(array_values(array_diff($ranks, [$elementId])));
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
     * Move the element to a specific rank.
     * Return the new rank of the element.
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
     * Toggle two elements in the ranking.
     * Return the new rank of the first element.
     *
     * @param  \Illuminate\Database\Eloquent\Model $firstElement
     * @param  \Illuminate\Database\Eloquent\Model $lastElement
     * @return int
     */
    public function toggle($firstElement, $lastElement): int
    {
        $firstElement = $firstElement->getKey();
        $lastElement = $lastElement->getKey();

        if ($firstElement !== $lastElement && in_array($firstElement, $this->ranks) && in_array($lastElement, $this->ranks)) {
            $firstKey = array_search($firstElement, $this->ranks);
            $lastKey = array_search($lastElement, $this->ranks);
            $ranks = $this->ranks;
            [$ranks[$firstKey], $ranks[$lastKey]] = [$ranks[$lastKey], $ranks[$firstKey]];
            $this->commit($ranks);
        }

        return $this->rank($firstElement);
    }

    /**
     * Move the element to a specific index.
     * Return the new index of the element.
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
     * Move the element one rank up.
     * Return the rank of the upgraded element.
     *
     * @return int
     * @throws \Exception
     */
    public function up(): int
    {
        if ($this->hasElement()) {
            if ($this->rank($this->element) > 1) {
                $key = array_search($this->element, $this->ranks);
                return $this->toggle($this->element, $this->ranks[$key - 1]);
            }

            return 1;
        }
    }
}
