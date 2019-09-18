<?php

namespace Belvedere\FormMaker\Traits\Rankings;

use Belvedere\FormMaker\{
    Contracts\Rankings\RankerContract,
    Models\Model
};
use Illuminate\Database\Eloquent\Relations\MorphOne;

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
        if (is_null($this->ranking)) {
            $this->createRanking($node);
        }

        $this->ranking->add($node);
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

        $ranking->ranks = [];

        $this->ranking()->save($ranking);

        $this->load('ranking');
    }

    /**
     * Get the model rankings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function ranking(): MorphOne
    {
        return $this->rankingProvider->getEloquentRelation($this);
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