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
     * The current element id to reorder.
     *
     * @var mixed
     */
    protected $elementId;

    /**
     * Ranker constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('form-maker.database.rankings_table', 'rankings');
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
     * Add an element in the rankings.
     * Return the rank of the new element.
     *
     * @param mixed $element
     * @return int
     * @throws \Exception
     */
    public function add($element): int
    {
        $rank = $this->rank($element);

        if ($rank === -1) {
            $ranks = $this->ranks;
            $ranks[] = $this->getElementId($element);
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
        if ($this->hasElementId()) {
            if ($this->elementId !== head($this->ranks)) {
                $ranks = $this->ranks;
                $ranks = array_diff($ranks, [$this->elementId]);
                $this->commit(array_merge([$this->elementId], $ranks));
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
        if ($this->hasElementId()) {
            if ($this->elementId !== last($this->ranks)) {
                $key = array_search($this->elementId, $this->ranks);
                return $this->toggle($this->elementId, $this->ranks[$key + 1]);
            }

            return count($this->ranks);
        }
    }

    /**
     * Get the ranking primary key from the element.
     *
     * @param mixed $element
     * @return mixed
     */
    protected function getElementId($element)
    {
        if (is_object($element) && method_exists($element, 'getKey')) {
            return $element->getKey();
        }

        return $element;
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
     * Check that the elementId attribute is set.
     *
     * @return bool
     * @throws \Exception
     */
    protected function hasElementId(): bool
    {
        if ($this->elementId) {
            return true;
        }

        throw new \Exception('You must set the element with the move method before using this function. See documentation.');
    }

    /**
     * Check that the element is in the ranking.
     *
     * @param mixed $element
     * @return bool
     */
    public function inRanking($element): bool
    {
        $elementId = $this->getElementId($element);

        return in_array($elementId, $this->ranks);
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
        if ($this->hasElementId()) {
            if ($this->elementId !== last($this->ranks)) {
                $ranks = $this->ranks;
                $ranks = array_diff($ranks, [$this->elementId]);
                $this->commit(array_merge($ranks, [$this->elementId]));
            }

            return count($this->ranks);
        }
    }

    /**
     * Set the element id that is to reorder.
     *
     * @param  mixed $element
     * @return self
     * @throws \Exception
     */
    public function move($element): RankerContract
    {
        if ($this->inRanking($element)) {
            $this->setElementId($element);

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
        if ($this->hasElementId()) {
            $ranks = $this->ranks;
            $ranks = array_diff($ranks, [$this->elementId]);
            array_splice($ranks, $index, 0, $this->elementId);
            $this->commit($ranks);

            return $index;
        }
    }

    /**
     * Return the rank of the element in the ranking.
     *
     * @param  mixed $element
     * @return int
     */
    public function rank($element): int
    {
        if ($this->inRanking($element)) {
            return array_search($this->getElementId($element), $this->ranks) + 1;
        }

        return -1;
    }

    /**
     * Remove an item in the ranking.
     *
     * @param  mixed $element
     * @return bool
     */
    public function remove($element): bool
    {
        if ($this->inRanking($element)) {
            $ranks = $this->ranks;
            $this->commit(
                array_values(
                    array_diff($ranks, [$this->getElementId($element)])
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
     * Set the element id that is to reorder.
     *
     * @param mixed $element
     * @return void
     * @throws \Exception
     */
    protected function setElementId($element): void
    {
        $elementId = $this->getElementId($element);

        $this->elementId = $elementId;
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
     * @param Collection $elements
     * @return Collection
     */
    public function sortByRank(Collection $elements): Collection
    {
        if (count($elements) === count($this->ranks)) {
            $sortedList = array_pad([], count($elements), false);

            foreach ($elements as $element)
            {
                $sortedList[array_search($this->getElementId($element), $this->ranks)] = $element;
            }

            return collect($sortedList);
        }

        Log::warning('The number of items in the collection and the number of ids stored in ranking don\'t match for ranking id : ' . $this->getKey());

        return $elements;
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
        $firstElement = $this->getElementId($firstElement);
        $lastElement = $this->getElementId($lastElement);

        if ($firstElement !== $lastElement && $this->inRanking($firstElement) && $this->inRanking($lastElement)) {
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
     * Move the element one rank up.
     * Return the rank of the upgraded element.
     *
     * @return int
     * @throws \Exception
     */
    public function up(): int
    {
        if ($this->hasElementId()) {
            if ($this->rank($this->elementId) > 1) {
                $key = array_search($this->elementId, $this->ranks);
                return $this->toggle($this->elementId, $this->ranks[$key - 1]);
            }

            return 1;
        }
    }
}
