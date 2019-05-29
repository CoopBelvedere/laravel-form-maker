<?php

namespace Belvedere\FormMaker\Traits;

use Belvedere\FormMaker\Contracts\Rankings\RankerContract;
use Belvedere\FormMaker\Models\Model;

trait HasRankings
{
    /**
     * The current implementation of the RankingContract
     *
     * @var mixed
     */
    protected $rankingProvider;

    /**
     * Add a node in the ranking
     *
     * @param \Belvedere\FormMaker\Models\Model $node
     * @return void
     * @throws \Exception
     */
    protected function addInRanking(Model $node): void
    {
        if (is_null($this->rankings)) {
            $this->createRanking($node);
        }

        $this->rankings()->ofType($node->getTable())->first()->add($node);
    }

    /**
     * Create a ranking
     *
     * @param \Belvedere\FormMaker\Models\Model $node
     * @return void
     */
    protected function createRanking(Model $node): void
    {
        $ranking = resolve(RankerContract::class);

        $ranking->node_type = $node->getTable();

        $ranking->ranks = [];

        $this->rankings()->save($ranking);

        $this->load('rankings');
    }

    /**
     * Get the model rankings.
     *
     * @return mixed
     */
    public function rankings()
    {
        return $this->rankingProvider->getEloquentRelation($this);
    }

    /**
     * Scope a query to only include rankings of a given type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('node_type', $type);
    }

    /**
     * Set the ranking provider used by the model.
     *
     * @return void
     */
    public function setRankingProvider(): void
    {
        $this->rankingProvider = resolve(RankerContract::class);
    }
}